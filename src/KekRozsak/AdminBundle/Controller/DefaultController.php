<?php

namespace KekRozsak\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use JMS\DiExtraBundle\Annotation as DI;

use KekRozsak\FrontBundle\Entity\Group;
use KekRozsak\SecurityBundle\Entity\User;

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
        $objectIdentity = new ObjectIdentity(User::ACL_OID, 'KekRozsak\\SecurityBundle\\Entity\\User');

        if (!$this->securityContext->isGranted('OWNER', $objectIdentity)) {
            throw new AccessDeniedException('Ehhez a művelethez nincs jogosultságod.');
        }

        $users = $this
                ->getDoctrine()
                ->getManager()
                ->createQuery('SELECT u FROM KekRozsakSecurityBundle:User u WHERE u.acceptedBy IS NULL')
                ->getResult()
            ;
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            if (is_numeric($userid = $request->get('userid'))) {
                if (($user = $this->getDoctrine()->getRepository('KekRozsakSecurityBundle:User')->findOneById($userid)) != null) {
                    $activeUser = $this->$securityContext->getToken()->getUser();
                    $user->setAcceptedBy($activeUser);
                    $em = $this->getDoctrine()->getManager();
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
        $objectIdentity = new ObjectIdentity(Group::ACL_OID, 'KekRozsak\\FrontBundle\\Entity\\Group');
	$groupRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:Group');

        if (!$this->securityContext->isGranted('OWNER', $objectIdentity)) {
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
                            || $this->securityContext->isGranted('OWNER', $objectIdentity)
                    ) {
                        $membershipRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:UserGroupMembership');
                        $membershipObject = $membershipRepo->findOneBy(array('user' => $aUser, 'group' => $aGroup));
                        if ($membershipObject) {
                            $membershipObject->setMembershipAcceptedAt(new \DateTime('now'));
                            $membershipObject->setMembershipAcceptedBy($user);

                            $em = $this->getDoctrine()->getManager();
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
     * @Route("/csoport-jelentkezok/elutasitas.html", name="KekRozsakAdminBundle_groupJoinDecline")
     * @Template()
     */
    public function groupJoinDeclineAction()
    {
        // TODO: A reason must be written to decline a join request!
        return array(
        );
    }
}
