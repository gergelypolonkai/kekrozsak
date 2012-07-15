<?php

namespace KekRozsak\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/admin")
 */
class DefaultController extends Controller
{
	/**
	 * @Route("/manage_regs", name="KekRozsakAdminBundle_manage_regs")
	 * @Template()
	 */
	public function manageRegsAction()
	{
		$users = $this->getDoctrine()->getEntityManager()->createQuery('SELECT u FROM KekRozsakSecurityBundle:User u WHERE u.acceptedBy IS NULL')->getResult();

		return array(
			'users' => $users,
		);
	}
}
