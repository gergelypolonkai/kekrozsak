<?php

namespace KekRozsak\FrontBundle\Twig;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service
 * @DI\Tag("twig.extension")
 */
class EventsExtension extends \Twig_Extension
{
    protected $_doctrine;
    protected $_securityContext;

    /**
     * @DI\InjectParams({
     *     "doctrine"        = @DI\Inject("doctrine"),
     *     "securityContext" = @DI\Inject("security.context")
     * })
     *
     * @param \Symfony\Bridge\Doctrine\RegistryInterface $doctrine
     * @param \Symfony\Component\Security\Core\SecurityContextInterface $securityContext
     */
    public function __construct(RegistryInterface $doctrine, SecurityContextInterface $securityContext)
    {
        $this->_doctrine = $doctrine;
        $this->_securityContext = $securityContext;
    }

    public function getGlobals()
    {
        $today = new \DateTime('now');
        $firstDay = \DateTime::createFromFormat('Y-m-d', $today->format('Y-m-01'));
        $firstDayWeekday = $firstDay->format('N');
        $numDays = $firstDay->format('t');
        $lastDay = \DateTime::createFromFormat('Y-m-d', $today->format('Y-m-' . sprintf("%02d", $numDays)));

        /*
         * Get all events in today's month. Iterate through this
         * collection, adding each element to $monthEvents array's
         * 'day'th element array.
         */
        $query = $this->_doctrine->getEntityManager()->createQuery('SELECT e FROM KekRozsakFrontBundle:Event e WHERE e.cancelled = FALSE AND ((e.startDate < :firstDay AND e.endDate >= :firstDay) OR e.startDate BETWEEN :firstDay AND :lastDay)');
        $query->setParameter('firstDay', $firstDay, \Doctrine\DBAL\Types\Type::DATE);
        $query->setParameter('lastDay', $lastDay, \Doctrine\DBAL\Types\Type::DATE);
        $events = $query->getResult();

        $eventList = array();
        for ($i = 1; $i <= $numDays; $i++) {
            $date = \DateTime::createFromFormat(
                    'Y-m-d',
                    $today->format('Y-m-' . sprintf('%02d', $i))
                );
            $eventList[$i]['date'] = $date;
            $eventList[$i]['events'] = array();
            foreach ($events as $event)  {
                if ($event->isOnDate($date)) {
                    $eventList[$i]['events'][] = $event;
                }
            }
        }

        return array(
            'events'          => $events,
            'eventList'       => $eventList,
            'today'           => $today,
            'firstDay'        => $firstDay,
            'lastDay'         => $lastDay,
            'firstDayWeekday' => $firstDayWeekday,
            'numDays'         => $numDays,
        );
    }

    public function getName()
    {
        return 'Events';
    }
}
