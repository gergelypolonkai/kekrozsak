<?php
namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/blog")
 */
class BlogController extends Controller
{
    /**
     * @Route("/", name="KekRozsakFrontBundle_blogList")
     * @Template()
     */
    public function listAction()
    {
        $query = $this
                    ->getDoctrine()
                    ->getManager()
                    ->createQuery('
                        SELECT
                            p
                        FROM
                            KekRozsakFrontBundle:BlogPost p
                        LEFT JOIN
                            p.group g
                        LEFT JOIN
                            g.members m
                        WHERE
                            (
                                (
                                    p.group IS NULL
                                    OR m.user = :user
                                )
                                AND p.published = true
                            )
                            OR p.createdBy = :user
                    ');
        $query->
            setParameter(
                    'user',
                    $this
                        ->get('security.context')
                        ->getToken()
                        ->getUser()
                        ->getId()
                );
        $blogPosts = $query->getResult();

        return array(
            'posts' => $blogPosts,
        );
    }
}
