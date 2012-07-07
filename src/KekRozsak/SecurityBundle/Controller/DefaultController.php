<?php

namespace KekRozsak\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

use KekRozsak\FrontBundle\Entity\User;
use KekRozsak\FrontBundle\Form\Type\UserType;

class DefaultController extends Controller
{
	public function loginAction()
	{
		$request = $this->getRequest();
		$session = $request->getSession();

		if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR))
		{
			$error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
		}
		else
		{
			$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
			$session->remove(SecurityContext::AUTHENTICATION_ERROR);
		}

		return $this->render('KekRozsakSecurityBundle:Default:login.html.twig', array(
			'last_username' => $session->get(SecurityContext::LAST_USERNAME),
			'error'         => $error,
		));
	}

	public function registrationAction(Request $request)
	{
		$user = $this->get('security.context')->getToken()->getUser();
		if ($user instanceof UserInterface)
		{
			return $this->redirect($this->generateUrl('KekRozsakFrontBundle_homepage'));
		}
		$user = new User();
		$form = $this->createForm(new UserType(true), $user);

		if ($request->getMethod() == 'POST')
		{
			$form->bindRequest($request);
			if ($form->isValid(array('registration')))
			{
				$user->setPassword($this->get('security.encoder_factory')->getEncoder($user)->encodePassword($user->getPassword(), $user->getSalt()));
				$roleRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:Role');
				$regRole = $roleRepo->findOneByName('ROLE_REGISTERED');
				$user->addRole($regRole);
				$user->setRegisteredAt(new \DateTime('now'));
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($user);
				$em->flush();

				return $this->redirect($this->generateUrl('KekRozsakSecurityBundle_reg_success'));
			}
		}

		return $this->render('KekRozsakSecurityBundle:Default:registration.html.twig', array(
			'form' => $form->createView(),
		));
	}

	public function registrationSuccessAction()
	{
		return $this->render('KekRozsakSecurityBundle:Default:registration_success.html.twig', array());
	}
}
