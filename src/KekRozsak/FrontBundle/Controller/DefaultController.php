<?php

namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use KekRozsak\FrontBundle\Entity\Article;

use KekRozsak\SecurityBundle\Form\Type\UserType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="KekRozsakFrontBundle_homepage")
     */
    public function homepageAction()
    {
        $mainPageArticle = $this
                ->getDoctrine()
                ->getRepository('KekRozsakFrontBundle:Article')
                ->findOneBy(
                        array('mainPage' => true),
                        true,
                        array('createdAt', 'DESC'),
                        1
                    );
        if (!$mainPageArticle) {
            throw $this->createNotFoundException('A keresett cikk nem létezik!');
        }

        return $this->forward('KekRozsakFrontBundle:Article:view', array('slug' => $mainPageArticle->getSlug()));
    }

    /**
     * @Route("/profil.html", name="KekRozsakFrontBundle_profile_edit")
     * @Template("KekRozsakFrontBundle:Default:userprofile.html.twig")
     */
    public function profileEditAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();

        $oldPassword = $user->getPassword();
        $form = $this->createForm(new UserType(), $user);
        $saveSuccess = false;
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                if ($user->getPassword() == '') {
                    $user->setPassword($oldPassword);
                } else {
                    $user->setPassword($this->get('security.encoder_factory')->getEncoder($user)->encodePassword($user->getPassword(), $user->getSalt()));
                }

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($user);
                $em->flush();
            }
        }

        return array(
            'form'        => $form->createView(),
            'saveSuccess' => $saveSuccess,
        );
    }
}
