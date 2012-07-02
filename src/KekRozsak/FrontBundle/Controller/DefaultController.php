<?php

namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	public function homepageAction()
	{
		$mainPageArticle = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:Article')->findOneBy(array('main_page' => 1), true, array('created_at', 'DESC'), 1);
		if (!$mainPageArticle)
			throw $this->createNotFoundException('A keresett cikk nem létezik!');

		return $this->forward('KekRozsakFrontBundle:Default:article', array('articleSlug' => $mainPageArticle->getSlug()));
	}

	public function articleAction($articleSlug)
	{
		$article = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:Article')->findOneBySlug($articleSlug);

		if (!$article)
			throw $this->createNotFoundException('A keresett cikk nem létezik!');

		return $this->render('KekRozsakFrontBundle:Default:article.html.twig', array(
			'article' => $article
		));
	}

	public function forumMainAction()
	{
		return $this->forward('KekRozsakFrontBundle:Default:homepage');	
	}
}
