<?php

namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use KekRozsak\FrontBundle\Entity\ForumTopicGroup;
use KekRozsak\FrontBundle\Entity\ForumTopic;
use KekRozsak\FrontBundle\Entity\ForumPost;
use KekRozsak\FrontBundle\Form\Type\ForumTopicGroupType;
use KekRozsak\FrontBundle\Form\Type\ForumTopicType;
use KekRozsak\FrontBundle\Form\Type\ForumPostType;
use KekRozsak\FrontBundle\Extensions\Slugifier;

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
        $request = $this->getRequest();
        $newTopicGroup = new ForumTopicGroup();
        $newTopicGroupForm = $this->createForm(new ForumTopicGroupType(), $newTopicGroup);

        if ($request->getMethod() == 'POST') {
            $newTopicGroupForm->bind($request);

            if ($newTopicGroupForm->isValid()) {
                $slugifier = new \KekRozsak\FrontBundle\Extensions\Slugifier();
                $newTopicGroup->setSlug($slugifier->slugify($newTopicGroup->getTitle()));
                $newTopicGroup->setCreatedAt(new \DateTime('now'));
                $newTopicGroup->setCreatedBy($this->get('security.context')->getToken()->getUser());

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($newTopicGroup);
                $em->flush();

                return $this->redirect(
                        $this->generateUrl(
                                'KekRozsakFrontBundle_forumTopicGroupList'
                            )
                    );
            }
        }

        // TODO: ORDER the topic list by last post date
        $topicGroups = $groupRepo->findAll();

        return array(
            'topicGroups'       => $topicGroups,
            'newTopicGroupForm' => $newTopicGroupForm->createView(),
        );
    }

    /**
     * @Route("/{slug}", name="KekRozsakFrontBundle_forumTopicList")
     * @Template()
     * @ParamConverter("topicGroup")
     *
     * @param  KekRozsak\FrontBundle\Entity\ForumTopicGroup $topicGroup
     * @return array
     */
    public function topicListAction(ForumTopicgRoup $topicGroup)
    {
        $request = $this->getRequest();
        $newTopic = new ForumTopic();
        $newTopicForm = $this->createForm(new ForumTopicType(), $newTopic);

        if ($request->getMethod() == 'POST') {
            $newTopicForm->bind($request);

            if ($newTopicForm->isValid()) {
                $slugifier = new \KekRozsak\FrontBundle\Extensions\Slugifier();
                $newTopic->setSlug($slugifier->slugify($newTopic->getTitle()));
                $newTopic->setCreatedAt(new \DateTime('now'));
                $newTopic->setCreatedBy($this->get('security.context')->getToken()->getUser());
                $newTopic->setTopicGroup($topicGroup);

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($newTopic);
                $em->flush();

                return $this->redirect(
                        $this->generateUrl(
                                'KekRozsakFrontBundle_forumTopicList',
                                array(
                                    'slug' => $topicGroup->getSlug(),
                                )
                            )
                    );
            }
        }

        return array(
            'topicGroup'   => $topicGroup,
            'newTopicForm' => $newTopicForm->createView(),
        );
    }

    /**
     * @Route("/{topicGroupSlug}/{topicSlug}", name="KekRozsakFrontBundle_forumPostList")
     * @Template()
     * @ParamConverter("topic", options={"mapping"={"topicGroup"="topicGroup", "topicSlug"="slug"}})
     * @ParamConverter("topicGroup", options={"mapping"={"topicGroupSlug"="slug"}})
     *
     * @param  KekRozsak\FrontBundle\Entity\ForumTopicGroup $topicGroup
     * @param  KekRozsak\FrontBundle\Entity\ForumTopic      $topic
     * @return array
     */
    public function postListAction(ForumTopicGroup $topicGroup, ForumTopic $topic)
    {
        // Get the list of posts in the requested topic
        $postRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:ForumPost');
        $posts = $postRepo->findBy(
                array('topic' => $topic),
                array('createdAt' => 'DESC')
                /* TODO: , limit, offset */
            );

        // Create an empty post object for posting
        $post = new ForumPost();
        $form = $this->createForm(
                new ForumPostType(
                        $topicGroup->getId(),
                        $topic->getId()
                    ),
                $post
            );

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $post->setCreatedAt(new \DateTime('now'));
                $post->setCreatedBy($this->get('security.context')->getToken()->getUser());
                $post->setTopic($topic);

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($post);
                $em->persist($topic);
                $em->flush();

                return $this->redirect(
                        $this->generateUrl(
                                'KekRozsakFrontBundle_forumPostList',
                                array(
                                    'topicGroupSlug' => $topicGroup->getSlug(),
                                    'topicSlug'      => $topic->getSlug(),
                                )
                            )
                    );
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
