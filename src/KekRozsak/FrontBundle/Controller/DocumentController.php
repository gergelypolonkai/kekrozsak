<?php

namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use KekRozsak\FrontBundle\Entity\Document;
use KekRozsak\FrontBundle\Form\Type\DocumentType;
use KekRozsak\FrontBundle\Extensions\Slugifier;

class DocumentController extends Controller
{
	/**
	 * @Route("/dokumentum/{documentSlug}", name="KekRozsakFrontBundle_documentView")
	 * @Template()
	 */
	public function viewAction($documentSlug)
	{
		$docRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:Document');
		if (!($document = $docRepo->findOneBySlug($documentSlug)))
			throw $this->createNotFoundException('A kért dokumentum nem létezik!');

		return array(
			'document' => $document,
		);
	}

	/**
	 * @Route("/dokumentumok/uj/{groupSlug}", name="KekRozsakFrontBundle_documentCreate", defaults={"groupslug"=""})
	 * @Template()
	 */
	public function createAction($groupSlug = '')
	{
		$groupRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:Group');
		$group = $groupRepo->findOneBySlug($groupSlug);
		/* TODO: make group fully optional */

		$document = new Document();
		$document->setSlug('n-a');
		$form = $this->createForm(new DocumentType(), $document);
		$request = $this->getRequest();

		if ($request->getMethod() == 'POST')
		{
			$form->bindRequest($request);

			if ($form->isValid())
			{
				$slugifier = new Slugifier();
				$document->setSlug($slugifier->slugify($document->getTitle()));
				$document->setCreatedAt(new \DateTime('now'));
				$document->setCreatedBy($this->get('security.context')->getToken()->getUser());

				if ($group)
				{
					$group->addDocument($document);
					$document->addGroup($group);
				}

				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($document);
				$em->flush();

				/* TODO: return to group list if groupSlug is empty! */
				return $this->redirect($this->generateUrl('KekRozsakFrontBundle_groupDocuments', array('groupSlug' => $group->getSlug())));
			}
		}

		return array(
			'defaultGroup' => $groupSlug,
			'form'         => $form->createView(),
		);
	}

	/**
	 * @Route("/dokumentum/{documentSlug}/szerkesztes", name="KekRozsakFrontBundle_documentEdit")
	 * @Template()
	 */
	public function editAction($documentSlug)
	{
		$documentRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:Document');
		if (!($document = $documentRepo->findOneBySlug($documentSlug)))
			throw $this->createNotFoundException('A kért dokumentum nem létezik!');
		$form = $this->createForm(new DocumentType(), $document);
		$request = $this->getRequest();

		if ($request->getMethod() == 'POST')
		{
			$form->bindRequest($request);
			if ($form->isValid())
			{
				$slugifier = new Slugifier();
				$document->setSlug($slugifier->slugify($document->getTitle()));
				// TODO: add updatedAt, updatedBy, updateReason, etc.

				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($document);
				$em->flush();

				return $this->redirect($this->generateUrl('KekRozsakFrontBundle_documentView', array('documentSlug' => $document->getSlug())));
			}
		}

		return array(
			'document' => $document,
			'form'     => $form->createView(),
		);
	}
}
