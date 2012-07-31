<?php

namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use KekRozsak\FrontBundle\Entity\Event;

class EventController extends Controller
{
	/**
	 * @Route("/esesmeny/{startDate}/{eventSlug}", name="KekRozsakFrontBundle_eventView")
	 * @Template()
	 * @ParamConverter("event", class="KekRozsakFrontBundle:Event", options={"mapping"={"eventSlug" = "slug", "startDate"="startDate"}})
	 * @ParamConverter("startDate", class="DateTime", options={"format"="Y-m-d"})
	 */
	public function viewAction(\DateTime $startDate, Event $event)
	{
		if ($event->getGroup() !== null)
		{
			if (!$event->getGroup()->isMember($this->get('security.context')->getToken()->getUser()))
				throw new AccessDeniedException('Ehhez az eseményhez nem csatlakozhatsz, mivel a csoportjának nem vagy tagja.');
		}

		return array(
			'event' => $event,
		);
	}

	/**
	 * @Route("/esemeny/{startDate}/{eventSlug}/csatlakozas", name="KekRozsakFrontBundle_eventJoin")
	 * @Template()
	 * @ParamConverter("event", class="KekRozsakFrontBundle:Event", options={"mapping"={"eventSlug"="slug", "startDate"="startDate"}})
	 * @ParamConverter("startDate", class="DateTime", options={"format"="Y-m-d"})
	 */
	public function joinAction(\DateTime $startDate, Event $event)
	{
		if ($event->getGroup() !== null)
		{
			if (!$event->getGroup()->isMember($this->get('security.context')->getToken()->getUser()))
				throw new AccessDeniedException('Ehhez az eseményhez nem csatlakozhatsz, mivel a csoportjának nem vagy tagja.');
		}

		$event->addAttendee($this->get('security.context')->getToken()->getUser());

		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($event);
		$em->flush();

		return $this->redirect($this->generateUrl('KekRozsakFrontBundle_eventView', array(
			'eventDate' => $eventDate,
			'eventSlug' => $eventSlug,
		)));
	}

	/**
	 * @Route("/esemenyek/{date}", name="KekRozsakFrontBundle_eventList")
	 * @Template()
	 * @ParamConverter("date", options={"format": "Y-m-d"})
	 */
	public function listAction(\DateTime $date)
	{
		$query = $this->getDoctrine()->getEntityManager()->createQuery('SELECT e FROM KekRozsakFrontBundle:Event e WHERE e.cancelled = FALSE AND ((e.startDate < :day AND e.endDate >= :day) OR e.startDate = :day)');
		$query->setParameter('day', $date, \Doctrine\DBAL\Types\Type::DATE);
		$events = $query->getResult();

		return array(
			'day'    => $date,
			'events' => $events,
		);
	}

	/**
	 * @Route("/esemenyek/{date}/ajax-lista.{_format}", name="KekRozsakFrontBundle_eventAjaxList", requirements={=_format": "html"})
	 * @Template()
	 * @ParamConverter("date", options={"format": "Y-m-d"})
	 */
	public function ajaxListAction(\DateTime $date)
	{
		$query = $this->getDoctrine()->getEntityManager()->createQuery('SELECT e FROM KekRozsakFrontBundle:Event e WHERE e.cancelled = FALSE AND ((e.startDate < :day AND e.endDate >= :day) OR e.startDate = :day)');
		$query->setParameter('day', $date, \Doctrine\DBAL\Types\Type::DATE);
		$events = $query->getResult();

		return array(
			'day'    => $date,
			'events' => $events,
		);
	}
}
