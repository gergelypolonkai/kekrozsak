<?php

namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use KekRozsak\FrontBundle\Entity\Article;

class ArticleController extends Controller
{
    /**
     * @param KekRozsak\FrontBundle\Entity\Article $article
     *
     * @Route("/cikk/{slug}.html", name="KekRozsakFrontBundle_articleView")
     * @Template()
     * @ParamConverter("article")
     */
    public function viewAction(Article $article)
    {
        $scontext = $this->get('security.context');
        if (
            (
                !is_object($scontext->getToken())
                || !is_object($scontext->getToken()->getUser())
            )
            && !$article->isPublic()
        ) {
            throw new AccessDeniedException('A cikk megtekintéséhez be kell jelentkezned!');
        }

        return array(
            'article' => $article,
        );
    }
}
