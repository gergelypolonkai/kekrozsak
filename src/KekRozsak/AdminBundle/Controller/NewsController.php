<?php
namespace KekRozsak\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @Route("/admin")
 */
class NewsController extends Controller
{
    /**
     * The ACL object ID for the News class
     *
     * @const string OBJECT_ID
     */
    const OBJECT_ID = 'newsClass';

    /**
     * The FQCN of the News class
     *
     * @const string OBJECT_FQCN
     */
    const OBJECT_FQCN = 'KekRozsak\\FrontBundle\\Entity\\News';

    /**
     * @var Symfony\Component\Security\Core\SecurityContext $securityContext
     *
     * @DI\Inject("security.context")
     */
    private $securityContext;

    /**
     * @Route("/hirek/", name="KekRozsakAdminBundle_newsList")
     * @Template
     */
    public function listAction()
    {
        $objectIdentity = new ObjectIdentity(self::OBJECT_ID, self::OBJECT_FQCN);
        if ($this->securityContext->isGranted('OWNER', $objectIdentity) === false) {
            throw new AccessDeniedException('Nincs jogosultságod a hírszerkesztéshez!');
        }
        $news = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:News')->findAll();

        return array(
            'news' => $news,
        );
    }

    /**
     * @Route("/sugo/hirek", name="KekRozsakAdminBundle_newsListHelp")
     * @Template
     */
    public function listHelpAction()
    {
        return array();
    }
}
