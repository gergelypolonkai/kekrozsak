<?php

namespace KekRozsak\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function manageRegsAction($name)
    {
        return $this->render('KekRozsakAdminBundle:Default:manage_regs.html.twig');
    }
}
