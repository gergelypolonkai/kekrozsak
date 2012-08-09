<?php

namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use KekRozsak\FrontBundle\Entity\Article;

class ArticleController extends Controller
{
	/**
	 * @Route("/cikk/{slug}", name="KekRozsakFrontBundle_articleView")
	 * @Template()
	 * @ParamConverter("article")
	 *
	 * @param KekRozsak\FrontBundle\Entity\Article $article
	 */
	public function viewAction(Article $article)
	{
		if ((!is_object($this->_securityContext->getToken()) || !is_object($this->_securityContext->getToken()->getUser())) && !$article->isPublic())
			throw new AccessDeniedException('A cikk megtekintéséhez be kell jelentkezned!');

		return array(
			'article' => $article,
		);
	}
}
