<?php

namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use KekRozsak\FrontBundle\Entity\UserGroupMembership;
use KekRozsak\FrontBundle\Entity\Group;

use KekRozsak\FrontBundle\Form\Type\GroupType;

use KekRozsak\FrontBundle\Extensions\Slugifier;

class GroupController extends Controller
{
    /**
     * @Route("/csoportok", name="KekRozsakFrontBundle_groupList")
     * @Template()
     */
    public function listAction()
    {
        $groupRepo = $this
                        ->getDoctrine()
                        ->getRepository('KekRozsakFrontBundle:Group');
        $groups = $groupRepo->findAll(array('name' => 'ASC'));

        return array(
            'groups' => $groups,
        );
    }

    /**
     * @Route("/csoport/{slug}", name="KekRozsakFrontBundle_groupView")
     * @Template()
     * @ParamConverter("group")
     */
    public function viewAction(Group $group)
    {
        return array(
            'group' => $group,
        );
    }

    /**
     * @Route("/csoport/{slug}/tagok", name="KekRozsakFrontBundle_groupMembers")
     * @Template()
     * @ParamConverter("group")
     */
    public function membersAction(Group $group)
    {
        return array(
            'group' => $group,
        );
    }

    /**
     * @Route("/csoport/{slug}/dokumentumok", name="KekRozsakFrontBundle_groupDocuments")
     * @Template()
     * @ParamConverter("group")
     */
    public function documentsAction(Group $group)
    {
        return array(
            'group' => $group,
        );
    }

    /**
     * @Route("/csoport/{slug}/belepes", name="KekRozsakFrontBundle_groupJoin")
     * @Template()
     * @ParamConverter("group")
     */
    public function joinAction(Group $group)
    {
        $user = $this->get('security.context')->getToken()->getUser();

        if ($group->isMember($user)) {
            return $this->redirect($this->generateUrl('KekRozsakFrontBundle_groupView', array('slug' => $group->getSlug())));
        }

        if ($group->isRequested($user)) {
            return array(
                'isRequested'  => true,
                'needApproval' => false,
                'group'        => $group,
            );
        }

        $membership = new UserGroupMembership($user, $group);
        $membership->setUser($user);
        $membership->setGroup($group);
        $membership->setMembershipRequestedAt(new \DateTime('now'));
        if ($group->isOpen()) {
            $membership->setMembershipAcceptedAt(new \DateTime('now'));
        }

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($membership);
        $em->flush();

        if ($group->isOpen()) {
            return $this->redirect($this->generateUrl('KekRozsakFrontBundle_groupView', array('slug' => $group->getSlug())));
        } else {
            $message = \Swift_Message::newInstance()
                        ->setSubject('Új jelentkező a csoportodban (' . $group->getName() . '): ' . $user->getDisplayName())
                        // TODO: Make this a config parameter!
                        ->setFrom('info@blueroses.hu')
                        ->setTo($group->getLeader()->getEmail())
                        ->setBody($this->renderView('KekRozsakFrontBundle:Email:groupJoinRequest.txt.twig', array('user' => $user, 'group' => $group)));
            $this->get('mailer')->send($message);

            return array(
                'isRequested'  => false,
                'needApproval' => true,
                'group'        => $group,
            );
        }
    }

    /**
     * @Route("/csoportok/uj", name="KekRozsakFrontBundle_groupCreate")
     * @Template()
     */
    public function createAction()
    {
        $group = new Group();
        $form = $this->createForm(new GroupType(), $group);
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $slugifier = new Slugifier();
                $user = $this->get('security.context')->getToken()->getUser();

                $group->setCreatedBy($user);
                $group->setSlug($slugifier->slugify($group->getName()));
                $group->setCreatedAt(new \DateTime('now'));
                $group->setOpen(true);

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($group);
                $em->flush();

                $membership = new UserGroupMembership($user, $group);
                $em->persist($membership);
                $em->flush();

                return $this->redirect(
                        $this->generateUrl('KekRozsakFrontBundle_groupList')
                    );
            }
        }

        return array(
            'form' => $form->createView(),
        );
    }
}
