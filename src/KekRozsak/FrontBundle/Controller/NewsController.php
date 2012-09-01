<?php

namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Description of NewsController
 *
 * @author polesz
 *
 * @Route("/hirek")
 */
class NewsController extends Controller
{
    /**
     * @return array
     *
     * @Route("/oldalso-lista.html", name="KekRozsakFrontBundle_newsSideList", options={"expose": true})
     * @Template()
     */
    public function sideListAction()
    {
        $newsRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:News');
        $searchCriteria = array(
            'draft' => false,
        );
        if (
                !is_object($this->get('security.context')->getToken())
                || !is_object($this->get('security.context')->getToken()->getUser())
        ) {
            $searchCriteria['public'] = true;
        }

        $news = $newsRepo->findBy($searchCriteria, array('sticky' => 'DESC', 'createdAt' => 'DESC'), 4);

        return array(
            'recentNews' => $news,
        );
    }
}
