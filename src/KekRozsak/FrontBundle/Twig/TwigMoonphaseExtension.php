<?php
namespace KekRozsak\FrontBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service
 * @DI\Tag("twig.extension")
 *
 */
class TwigMoonphaseExtension extends \Twig_Extension
{
    const SYNODIC = 29.53058867;
    const SECPERDAY = 86400.0;

    private $container;

    /**
     * @DI\InjectParams({
     *     "container" = @DI\Inject("service_container")
     * })
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getGlobals()
    {
        $globals = parent::getGlobals();

        $gds = new \DateTime('now');

        $baseDate = new \DateTime();
        $baseDate->setTimezone(new \DateTimeZone('UTC'));
        $baseDate->setDate(2005, 4, 8);
        $baseDate->setTime(8, 48, 0);

        $diff = abs($gds->getTimestamp() - $baseDate->getTimestamp());
        $origPhasePercent = $diff / (self::SYNODIC * self::SECPERDAY);
        $phasePercent = fmod(($origPhasePercent) * 100.0, 100.0);
        if ($phasePercent < 0) {
            $phasePercent += 100;
        }
        $phase = round($phasePercent * 0.279);
        $realPercent = (50.0 - abs($phasePercent - 50.0)) * 2.0;

        $globals['moonphase'] = array(
            'phaseNum' => $phase,
            'percent'  => $realPercent,
        );

        return $globals;
    }

    public function getName()
    {
        return 'twig_moonphase';
    }
}
