<?php

namespace KekRozsak\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;

use KekRozsak\SecurityBundle\Entity\User;
use KekRozsak\SecurityBundle\Form\Type\UserType;
use KekRozsak\FrontBundle\Entity\UserData;

class DefaultController extends Controller
{
    /**
     * @Route("/belepes.html", name="KekRozsakSecurityBundle_login")
     * @Template()
     */
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        );
    }

    /**
     * @Route("/belepes.do", name="KekRozsakSecurityBundle_login_check")
     */
    public function loginCheckAction()
    {
        // The security layer will intercept this request. This method will never be called.
    }

    /**
     * @Route("/kilepes.do", name="KekRozsakSecurityBundle_logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request. This method will never be called.
    }

    /**
     * @Route("/jelentkezes.html", name="KekRozsakSecurityBundle_registration")
     * @Template()
     */
    public function registrationAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        if ($user instanceof UserInterface) {
            return $this->redirect($this->generateUrl('KekRozsakFrontBundle_homepage'));
        }

        $user = new User();
        $form = $this->createForm(new UserType(true), $user);
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid(array('registration'))) {
                $roleRepo = $this->getDoctrine()->getRepository('KekRozsakSecurityBundle:Role');
                $defaultRoles = $roleRepo->findByDefault(true);

                $user->setRegisteredAt(new \DateTime('now'));
                $user->setPassword(
                        $this
                            ->get('security.encoder_factory')
                            ->getEncoder($user)
                            ->encodePassword(
                                    $user->getPassword(),
                                    $user->getSalt()
                                )
                    );

                /* Add default Roles */
                foreach ($defaultRoles as $role) {
                    $user->addRole($role);
                }

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($user);
                $em->flush();

                $userData = new UserData();
                $user->setUserData($userData);
                $em->persist($user);
                $em->persist($userData);
                $em->flush();

                $message = \Swift_Message::newInstance()
                        ->setSubject('Új jelentkező')
                        // TODO: Make the next two config parameters!
                        ->setFrom('info@blueroses.hu')
                        ->setTo('jelentkezes@blueroses.hu')
                        ->setBody(
                                $this->renderView(
                                        'KekRozsakSecurityBundle:Email:new_registration.txt.twig',
                                        array('user' => $user)
                                    )
                            );
                $this->get('mailer')->send($message);

                return $this->redirect(
                        $this->generateUrl(
                                'KekRozsakSecurityBundle_reg_success'
                            )
                    );
            }
        }

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/most-varj.html", name="KekRozsakSecurityBundle_reg_success")
     * @Template()
     */
    public function regSuccessAction()
    {
        return array(
        );
    }

    /**
     * @Route("/profil/{id}/ajax-felhasznalo-info.{_format}", name="KekRozsakSecurityBundle_ajaxUserdata", requirements={"_format": "html"})
     * @Method({"GET"})
     * @Template()
     * @ParamConverter("user")
     */
    public function ajaxUserdataAction(User $user)
    {
        $userOid = new ObjectIdentity(User::ACL_OID, get_class($user));
        return array(
            'oid'  => $userOid,
            'user' => $user,
        );
    }
}
