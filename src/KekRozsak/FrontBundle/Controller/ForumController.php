<?php

namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use KekRozsak\FrontBundle\Entity\ForumPost;
use KekRozsak\FrontBundle\Form\Type\ForumPostType;

/**
 * @Route("/forum")
 */
class ForumController extends Controller
{
	/**
	 * @Route("", name="KekRozsakFrontBundle_forum_main")
	 * @Template("KekRozsakFrontBundle:Forum:topic_group_list.html.twig")
	 */
	public function mainAction()
	{
		$groupRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:ForumTopicGroup');

		// TODO: ORDER the topic list by last post date
		$topicGroups = $groupRepo->findAll();

		return array(
			'topicGroups' => $topicGroups,
		);
	}

	/**
	 * @Route("/{topicGroupSlug}", name="KekRozsakFrontBundle_forum_topic_list")
	 * @Template("KekRozsakFrontBundle:Forum:topic_list.html.twig")
	 */
	public function topicListAction($topicGroupSlug)
	{
		$groupRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:ForumTopicGroup');

		if (!($topicGroup = $groupRepo->findOneBySlug($topicGroupSlug)))
			throw $this->createNotFoundException('A kért témakör nem létezik!');

		return array(
			'topicGroup' => $topicGroup,
		);
	}

	/**
	 * @Route("/{topicGroupSlug}/{topicSlug}", name="KekRozsakFrontBundle_forum_post_list")
	 * @Template("KekRozsakFrontBundle:Forum:post_list.html.twig")
	 */
	public function postListAction($topicGroupSlug, $topicSlug)
	{
		// Get the topic group based on slug
		$groupRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:ForumTopicGroup');
		if (!($topicGroup = $groupRepo->findOneBySlug($topicGroupSlug)))
			throw $this->createNotFoundException('A kért témakör nem létezik!');

		// Get the topic based on slug
		$topicRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:ForumTopic');
		if (!($topic = $topicRepo->findOneBy(array('topicGroup' => $topicGroup, 'slug' => $topicSlug))))
			throw $this->createNotFoundException('A kért téma nem létezik!');

		// Get the list of posts in the requested topic
		$postRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:ForumPost');
		$posts = $postRepo->findBy(array('topic' => $topic), array('createdAt' => 'DESC') /* TODO: , limit, offset */);

		// Create an empty post object for posting
		$post = new ForumPost();
		$form = $this->createForm(new ForumPostType($topicGroup->getId(), $topic->getId()), $post);

		$request = $this->getRequest();
		if ($request->getMethod() == 'POST')
		{
			$form->bindRequest($request);
			if ($form->isValid())
			{
				$post->setCreatedAt(new \DateTime('now'));
				$post->setCreatedBy($this->get('security.context')->getToken()->getUser());
				$post->setTopic($topic);

				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($post);
				$em->persist($topic);
				$em->flush();

				return $this->redirect($this->generateUrl('KekRozsakFrontBundle_forum_post_list', array(
					'topicGroupSlug' => $topicGroupSlug,
					'topicSlug'      => $topicSlug,
				)));
			}
		}

		return array(
			'topicGroup' => $topicGroup,
			'topic'      => $topic,
			'posts'      => $posts,
			'form'       => $form->createView(),
		);
	}
}
