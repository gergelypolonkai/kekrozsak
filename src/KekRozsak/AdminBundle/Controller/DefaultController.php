<?php

namespace KekRozsak\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin")
 */
class DefaultController extends Controller
{
	/**
	 * @Route("/jelentkezok", name="KekRozsakAdminBundle_manage_reg")
	 */
	public function manageRegsAction()
	{
		$users = $this->getDoctrine()->getEntityManager()->createQuery('SELECT u FROM KekRozsakFrontBundle:User u WHERE u.acceptedBy IS NULL')->getResult();

		return $this->render('KekRozsakAdminBundle:Default:manage_regs.html.twig', array (
			'users' => $users,
		));
	}
}
