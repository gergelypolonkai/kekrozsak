<?php

namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use KekRozsak\FrontBundle\Entity\UserGroupMembership;
use KekRozsak\FrontBundle\Entity\UserData;

use KekRozsak\SecurityBundle\Form\Type\UserType;

class DefaultController extends Controller
{
	/**
	 * @Route("/", name="KekRozsakFrontBundle_homepage")
	 */
	public function homepageAction()
	{
		$mainPageArticle = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:Article')->findOneBy(array('mainPage' => true), true, array('createdAt', 'DESC'), 1);
		if (!$mainPageArticle)
			throw $this->createNotFoundException('A keresett cikk nem létezik!');

		return $this->forward('KekRozsakFrontBundle:Default:article', array('articleSlug' => $mainPageArticle->getSlug()));
	}

	/**
	 * @Route("/cikk/{articleSlug}", name="KekRozsakFrontBundle_article")
	 * @Template()
	 *
	 * @param string $articleSlug
	 */
	public function articleAction($articleSlug)
	{
		$article = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:Article')->findOneBySlug($articleSlug);

		if (!$article)
			throw $this->createNotFoundException('A keresett cikk nem létezik!');

		return array(
			'article' => $article,
		);
	}

	/**
	 * @Route("/profil", name="KekRozsakFrontBundle_profile_edit")
	 * @Template("KekRozsakFrontBundle:Default:userprofile.html.twig")
	 */
	public function profileEditAction()
	{
		$user = $this->get('security.context')->getToken()->getUser();

		$oldPassword = $user->getPassword();
		$form = $this->createForm(new UserType(), $user);
		$saveSuccess = false;
		$request = $this->getRequest();

		if ($request->getMethod() == 'POST')
		{
			$form->bindRequest($request);
			if ($form->isValid())
			{
				if ($this->getPassword() == '')
					$user->setPassword($oldPassword);
				else
					$user->setPassword($this->get('security.encoder_factory')->getEncoder($user)->encodePassword($user->getPassword(), $user->getSalt()));

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

	/**
	 * @Route("/csoportok", name="KekRozsakFrontBundle_groupList")
	 * @Template()
	 */
	public function groupListAction()
	{
		$groupRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:Group');
		$groups = $groupRepo->findAll(array('name' => 'DESC'));
		return array(
			'groups' => $groups,
		);
	}

	/**
	 * @Route("/csoport/{groupSlug}", name="KekRozsakFrontBundle_groupView")
	 * @Template()
	 */
	public function groupViewAction($groupSlug)
	{
		$groupRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:Group');
		if (!($group = $groupRepo->findOneBySlug($groupSlug)))
			throw $this->createNotFoundException('A kért csoport nem létezik!');

		return array(
			'group' => $group,
		);
	}

	/**
	 * @Route("/csoport/{groupSlug}/tagok", name="KekRozsakFrontBundle_groupMembers")
	 * @Template()
	 */
	public function groupMembersAction($groupSlug)
	{
		$groupRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:Group');
		if (!($group = $groupRepo->findOneBySlug($groupSlug)))
			throw $this->createNotFoundException('A kért csoport nem létezik!');

		return array(
			'group' => $group,
		);
	}

	/**
	 * @Route("/csoport/{groupSlug}/dokumentumok", name="KekRozsakFrontBundle_groupDocuments")
	 * @Template()
	 */
	public function groupDocumentsAction($groupSlug)
	{
		$groupRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:Group');
		if (!($group = $groupRepo->findOneBySlug($groupSlug)))
			throw $this->createNotFoundException('A kért csoport nem létezik!');

		return array(
			'group' => $group,
		);
	}

	/**
	 * @Route("/csoport/{groupSlug}/belepes", name="KekRozsakFrontBundle_groupJoin")
	 * @Template()
	 */
	public function groupJoinAction($groupSlug)
	{
		$user = $this->get('security.context')->getToken()->getUser();
		$groupRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:Group');
		if (!($group = $groupRepo->findOneBySlug($groupSlug)))
			throw $this->createNotFoundException('A kért csoport nem létezik!');

		if ($group->isMember($user))
		{
			return $this->redirect($this->generateUrl('KekRozsakFrontBundle_groupView', array($groupSlug => $group->getSlug())));
		}

		if ($group->isRequested($user))
		{
			return array(
				'isRequested'  => true,
				'needApproval' => false,
				'group'        => $group,
			);
		}

		$membership = new UserGroupMembership();
		$membership->setUser($user);
		$membership->setGroup($group);
		$membership->setMembershipRequestedAt(new \DateTime('now'));
		if ($group->isOpen())
		{
			$membership->setMembershipAcceptedAt(new \DateTime('now'));
		}

		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($membership);
		$em->flush();

		if ($group->isOpen())
		{
			return $this->redirect($this->generateUrl('KekRozsakFrontBundle_groupView', array($groupSlug => $group->getSlug())));
		}
		else
		{
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
	 * @Route("/dokumentum/{documentSlug}", name="KekRozsakFrontBundle_documentView")
	 * @Template()
	 */
	public function documentViewAction($documentSlug)
	{
		$docRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:Document');
		if (!($document = $docRepo->findOneBySlug($documentSlug)))
			throw $this->createNotFoundException('A kért dokumentum nem létezik!');

		return array(
			'document' => $document,
		);
	}
}
