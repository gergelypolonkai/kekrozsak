<?php

namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use KekRozsak\FrontBundle\Entity\Document;
use KekRozsak\FrontBundle\Form\Type\DocumentType;
use KekRozsak\FrontBundle\Extensions\Slugifier;

class DocumentController extends Controller
{
	/**
	 * @Route("/dokumentum/{slug}", name="KekRozsakFrontBundle_documentView")
	 * @Template()
	 * @ParamConverter("document")
	 */
	public function viewAction(Document $document)
	{
		return array(
			'document' => $document,
		);
	}

	/**
	 * @Route("/dokumentumok/uj/", name="KekRozsakFrontBundle_documentCreate")
	 * @Template()
	 */
	public function createAction()
	{
		$document = new Document();
		$document->setSlug('n-a');
		$form = $this->createForm(new DocumentType(), $document);
		$request = $this->getRequest();

		if ($request->getMethod() == 'POST')
		{
			$form->bindRequest($request);

			if ($form->isValid())
			{
				/* TODO: move these lines into life cycle events */
				$slugifier = new Slugifier();
				$document->setSlug($slugifier->slugify($document->getTitle()));
				$document->setCreatedAt(new \DateTime('now'));
				$document->setCreatedBy($this->get('security.context')->getToken()->getUser());

				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($document);
				$em->flush();

				return $this->redirect($this->generateUrl('KekRozsakFrontBundle_documentView', array('slug' => $document->getSlug())));
			}
		}

		return array(
			'form'         => $form->createView(),
		);
	}

	/**
	 * @Route("/dokumentum/{slug}/szerkesztes", name="KekRozsakFrontBundle_documentEdit")
	 * @Template()
	 * @ParamConverter("document")
	 */
	public function editAction(Document $document)
	{
		$form = $this->createForm(new DocumentType(), $document);
		$request = $this->getRequest();

		if ($request->getMethod() == 'POST')
		{
			$form->bindRequest($request);
			if ($form->isValid())
			{
				/* TODO: move these lines into life cycle events */
				$slugifier = new Slugifier();
				$document->setSlug($slugifier->slugify($document->getTitle()));
				// TODO: add updatedAt, updatedBy, updateReason, etc.

				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($document);
				$em->flush();

				return $this->redirect($this->generateUrl('KekRozsakFrontBundle_documentView', array('slug' => $document->getSlug())));
			}
		}

		return array(
			'document' => $document,
			'form'     => $form->createView(),
		);
	}
}
