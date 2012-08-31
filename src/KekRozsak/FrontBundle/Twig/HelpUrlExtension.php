<?php

namespace KekRozsak\FrontBundle\Twig;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

/**
 * Description of HelpUrlExtension
 *
 * @author Gergely Polonkai
 *
 * @DI\Service
 * @DI\Tag("twig.extension")
 */
class HelpUrlExtension extends \Twig_Extension
{
    /**
     * @var Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    private $container;

    /**
     * @DI\InjectParams({
     *     "container" = @DI\Inject("service_container")
     * })
     */
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function getGlobals() {
        parent::getGlobals();

        $request = $this->container->get('request');
        $router = $this->container->get('router');

        $currentRoute = $request->get('_route');
        $m = array();
        $helpRoutes = array($currentRoute . 'Help');
        $helpUrl = null;

        if (preg_match('/^([^_]+)_([a-z]+)/', $currentRoute, $m)) {
            $helpRoutes[] = $m[1] . '_' . $m[2] . 'Help';
        }

        foreach ($helpRoutes as $helpRoute) {
            try {
                $helpUrl = $router->generate($helpRoute);
            } catch (RouteNotFoundException $e) {
                $helpUrl = null;
            }
            if ($helpUrl !== null) {
                break;
            }
        }

        return array(
            'helpUrl' => $helpUrl,
        );
    }

    public function getName()
    {
        return 'HelpUrl';
    }
}
