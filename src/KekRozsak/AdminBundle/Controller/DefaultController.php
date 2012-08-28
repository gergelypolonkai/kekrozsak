<?php

namespace KekRozsak\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @Route("/admin")
 */
class DefaultController extends Controller
{
    /**
     * @var Symfony\Component\Security\Core\SecurityContext $securityContext
     *
     * @DI\Inject("security.context")
     */
    private $securityContext;

    /**
     * @Route("/regisztraltak.html", name="KekRozsakAdminBundle_manage_regs")
     * @Template()
     */
    public function manageRegsAction()
    {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Ehhez a művelethez nincs jogosultságod.');
        }
        $users = $this->getDoctrine()->getEntityManager()->createQuery('SELECT u FROM KekRozsakSecurityBundle:User u WHERE u.acceptedBy IS NULL')->getResult();
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            if (is_numeric($userid = $request->get('userid'))) {
                if (($user = $this->getDoctrine()->getRepository('KekRozsakSecurityBundle:User')->findOneById($userid)) != null) {
                    $activeUser = $this->get('security.context')->getToken()->getUser();
                    $user->setAcceptedBy($activeUser);
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($user);
                    $em->flush();

                    return $this->redirect($this->generateUrl('KekRozsakAdminBundle_manage_regs'));
                }
            }
        }

        return array(
            'users' => $users,
        );
    }

    /**
     * @Route("/csoport-jelentkezok.html", name="KekRozsakAdminBundle_groupJoinRequests")
     * @Template()
     */
    public function groupJoinRequestsAction()
    {
        $user = $this->securityContext->getToken()->getUser();
        $request = $this->getRequest();

        $groupRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:Group');
        if ($this->securityContext->isGranted('ROLE_ADMIN') === false) {
            $myGroups = $groupRepo->findByLeader($user);
        } else {
            $myGroups = $groupRepo->findAll();
        }

        if ($request->getMethod() == 'POST') {
            if ($request->request->has('group') && $request->request->has('user')) {
                $userRepo = $this->getDoctrine()->getRepository('KekRozsakSecurityBundle:User');
                $aUser = $userRepo->findOneById($request->request->get('user'));
                $aGroup = $groupRepo->findOneById($request->request->get('group'));
                if ($aUser && $aGroup) {
                    if (
                            ($aGroup->getLeader() == $user)
                            || $this->securityContext->isGranted('ROLE_ADMIN')
                    ) {
                        $membershipRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:UserGroupMembership');
                        $membershipObject = $membershipRepo->findOneBy(array('user' => $aUser, 'group' => $aGroup));
                        if ($membershipObject) {
                            $membershipObject->setMembershipAcceptedAt(new \DateTime('now'));
                            $membershipObject->setMembershipAcceptedBy($user);

                            $em = $this->getDoctrine()->getEntityManager();
                            $em->persist($membershipObject);
                            $em->flush();

                            return $this->redirect($this->generateUrl('KekRozsakAdminBundle_groupJoinRequests'));
                        }
                    } else {
                        throw new AccessDeniedException('Csak a csoport vezetője hagyhatja jóvá a jelentkezéseket!');
                    }
                }
            }
        }

        return array(
            'groups' => $myGroups,
        );
    }

    /**
     * @Route("/csoport_jelentkezok/elutasit", name="KekRozsakAdminBundle_groupJoinDecline")
     * @Template()
     */
    public function groupJoinDeclineAction()
    {
        // TODO: A reason must be written to decline a join request!
        return array(
        );
    }
}
