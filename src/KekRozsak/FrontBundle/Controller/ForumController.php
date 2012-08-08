<?php

namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use KekRozsak\FrontBundle\Entity\ForumTopicGroup;
use KekRozsak\FrontBundle\Entity\ForumTopic;
use KekRozsak\FrontBundle\Entity\ForumPost;
use KekRozsak\FrontBundle\Form\Type\ForumPostType;

/**
 * @Route("/forum")
 */
class ForumController extends Controller
{
	/**
	 * @Route("", name="KekRozsakFrontBundle_forumTopicGroupList")
	 * @Template()
	 */
	public function topicGroupListAction()
	{
		$groupRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:ForumTopicGroup');

		// TODO: ORDER the topic list by last post date
		$topicGroups = $groupRepo->findAll();

		return array(
			'topicGroups' => $topicGroups,
		);
	}

	/**
	 * @Route("/{slug}", name="KekRozsakFrontBundle_forumTopicList")
	 * @Template()
	 * @ParamConverter("topicGroup")
	 */
	public function topicListAction(ForumTopicgRoup $topicGroup)
	{
		return array(
			'topicGroup' => $topicGroup,
		);
	}

	/**
	 * @Route("/{topicGroupSlug}/{topicSlug}", name="KekRozsakFrontBundle_forumPostList")
	 * @Template()
	 * @ParamConverter("topic", options={"mapping"={"topicGroup"="topicGroup", "topicSlug"="slug"}})
	 * @ParamConverter("topicGroup", options={"mapping"={"topicGroupSlug"="slug"}})
	 */
	public function postListAction(ForumTopicGroup $topicGroup, ForumTopic $topic)
	{
		// Get the list of posts in the requested topic
		$postRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:ForumPost');
		$posts = $postRepo->findBy(array('topic' => $topic), array('createdAt' => 'DESC') /* TODO: , limit, offset */);

		// Create an empty post object for posting
		$post = new ForumPost();
		$form = $this->createForm(new ForumPostType($topicGroup->getId(), $topic->getId()), $post);

		$request = $this->getRequest();
		if ($request->getMethod() == 'POST')
		{
			$form->bind($request);
			if ($form->isValid())
			{
				$post->setCreatedAt(new \DateTime('now'));
				$post->setCreatedBy($this->get('security.context')->getToken()->getUser());
				$post->setTopic($topic);

				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($post);
				$em->persist($topic);
				$em->flush();

				return $this->redirect($this->generateUrl('KekRozsakFrontBundle_forumPostList', array(
					'topicGroupSlug' => $topicGroup->getSlug(),
					'topicSlug'      => $topic->getSlug(),
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
