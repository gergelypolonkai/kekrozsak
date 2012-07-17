<?php

namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DocumentController extends Controller
{
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
