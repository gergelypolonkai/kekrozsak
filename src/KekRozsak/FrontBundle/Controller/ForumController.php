<?php

namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ForumController extends Controller
{
	public function mainAction()
	{
		// TODO: Protect this controller with roles? It is also defined in security.yml
		$groupRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:ForumTopicGroup');

		$topicGroups = $groupRepo->findAll();

		return $this->render('KekRozsakFrontBundle:Forum:topic_group_list.html.twig', array(
			'topicGroups' => $topicGroups,
		));
	}

	public function topicListAction($topicGroupSlug)
	{
		$groupRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:ForumTopicGroup');
		if (!($topicGroup = $groupRepo->findOneBySlug($topicGroupSlug)))
			throw $this->createNotFoundException('A kért témakör nem létezik!');

		return $this->render('KekRozsakFrontBundle:Forum:topic_list.html.twig', array(
			'topicGroup' => $topicGroup,
		));
	}

	public function postListAction($topicGroupSlug, $topicSlug)
	{
		$groupRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:ForumTopicGroup');
		if (!($topicGroup = $groupRepo->findOneBySlug($topicGroupSlug)))
			throw $this->createNotFoundException('A kért témakör nem létezik!');
		$topicRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:ForumTopic');
		if (!($topic = $topicRepo->findOneBy(array('topic_group' => $topicGroup, 'slug' => $topicSlug))))
			throw $this->createNotFoundException('A kért téma nem létezik!');
		return $this->render('KekRozsakFrontBundle:Forum:post_list.html.twig', array(
			'topicGroup' => $topicGroup,
			'topic'      => $topic,
		));
	}
}

