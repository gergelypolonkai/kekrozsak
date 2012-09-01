<?php
namespace KekRozsak\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use JMS\DiExtraBundle\Annotation as DI;

use KekRozsak\FrontBundle\Entity\News;

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
     * @var Symfony\Component\Security\Acl\Domain\ObjectIdentity $objectIdentity
     */

    public function __construct()
    {
        $this->objectIdentity = new ObjectIdentity(self::OBJECT_ID, self::OBJECT_FQCN);
    }

    /**
     * @Route("/hirek/", name="KekRozsakAdminBundle_newsList")
     * @Template
     */
    public function listAction()
    {
        if ($this->securityContext->isGranted('OWNER', $this->objectIdentity) === false) {
            throw new AccessDeniedException('Nincs jogosultságod a hírszerkesztéshez!');
        }
        $news = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:News')->findAll();

        return array(
            'news' => $news,
        );
    }

    /**
     * @Route("/hirek/{slug}/szerkesztes.html", name="KekRozsakAdminBundle_newsEdit")
     * @Template
     * @ParamConverter("news")
     */
    public function editAction(News $news)
    {
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
