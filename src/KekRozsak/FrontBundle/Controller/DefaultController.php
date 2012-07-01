<?php

namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	public function articleAction($articleSlug)
	{
		$article = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:Article')->findOneBySlug($articleSlug);

		return $this->render('KekRozsakFrontBundle:Default:article.html.twig', array(
			'article' => $article
		));
	}
}
