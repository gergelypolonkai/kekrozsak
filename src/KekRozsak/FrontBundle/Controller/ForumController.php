<?php

namespace KekRozsak\FrontBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use KekRozsak\FrontBundle\Entity\ForumPost;
use KekRozsak\FrontBundle\Form\Type\ForumPostType;

/**
 * @Route("/forum")
 */
class ForumController extends Controller
{
	/**
	 * @Route("", name="KekRozsakFrontBundle_forum_main")
	 */
	public function mainAction()
	{
		// TODO: Protect this controller with roles? It is also defined in security.yml
		$groupRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:ForumTopicGroup');

		$topicGroups = $groupRepo->findAll();

		return $this->render('KekRozsakFrontBundle:Forum:topic_group_list.html.twig', array(
			'topicGroups' => $topicGroups,
		));
	}

	/**
	 * @Route("/{topicGroupSlug}", name="KekRozsakFrontBundle_forum_topic_list")
	 */
	public function topicListAction($topicGroupSlug)
	{
		$groupRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:ForumTopicGroup');
		if (!($topicGroup = $groupRepo->findOneBySlug($topicGroupSlug)))
			throw $this->createNotFoundException('A kért témakör nem létezik!');

		return $this->render('KekRozsakFrontBundle:Forum:topic_list.html.twig', array(
			'topicGroup' => $topicGroup,
		));
	}

	/**
	 * @Route("/{topicGroupSlug}/{topicSlug}", name="KekRozsakFrontBundle_forum_post_list")
	 */
	public function postListAction($topicGroupSlug, $topicSlug)
	{
		$request = $this->getRequest();

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

		return $this->render('KekRozsakFrontBundle:Forum:post_list.html.twig', array(
			'topicGroup' => $topicGroup,
			'topic'      => $topic,
			'posts'      => $posts,
			'form'       => $form->createView(),
		));
	}
}

