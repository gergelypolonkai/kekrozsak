<?php

namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Description of NewsController
 *
 * @author polesz
 */
class NewsController extends Controller
{
    /**
     * @Route("/newsSideList.html", name="KekRozsakFrontBundle_newsSideList", options={"expose": true})
     * @Template()
     */
    public function sideListAction()
    {
        $newsRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:News');
        $searchCriteria = array();
        if (
                !is_object($this->get('security.context')->getToken())
                || !is_object($this->get('security.context')->getToken()->getUser())
        ) {
			$searchCriteria['public'] = true;
        }

        $news = $newsRepo->findBy($searchCriteria, array('createdAt' => 'DESC'), 4);
        
        return array(
            'news' => $news,
        );
    }
}
