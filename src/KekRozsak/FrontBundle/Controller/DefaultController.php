<?php

namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function articleAction($articleSlug)
    {
        return $this->render('KekRozsakFrontBundle:Default:article.html.twig', array());
    }
}
