<?php

namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;

use KekRozsak\FrontBundle\Entity\ForumTopicGroup;
use KekRozsak\FrontBundle\Entity\ForumTopic;
use KekRozsak\FrontBundle\Entity\ForumPost;
use KekRozsak\FrontBundle\Entity\UserData;
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
     * @param  KekRozsak\FrontBundle\Entity\ForumTopicGroup $topicGroup
     * @return array
     *
     * @Route("/{slug}/", name="KekRozsakFrontBundle_forumTopicList")
     * @Template()
     * @ParamConverter("topicGroup")
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
     * @param  KekRozsak\FrontBundle\Entity\ForumTopicGroup $topicGroup
     * @param  KekRozsak\FrontBundle\Entity\ForumTopic      $topic
     * @return array
     *
     * @Route("/{topicGroupSlug}/{topicSlug}/", name="KekRozsakFrontBundle_forumPostList")
     * @Template()
     */
    public function postListAction($topicGroupSlug, $topicSlug)
    {
        $topicGroupRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:ForumTopicGroup');
        if (null === $topicGroup = $topicGroupRepo->findOneBySlug($topicGroupSlug)) {
            throw $this->createNotFoundException('Ilyen témakör nem létezik!');
        }

        $topicRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:ForumTopic');
        if (null === $topic = $topicRepo->findOneBy(array('slug' => $topicSlug, 'topicGroup' => $topicGroup))) {
            throw $this->createNotFoundException('Ilyen téma nem létezik!');
        }

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

    /**
     * @param  KekRozsak\FrontBundle\Entity\ForumTopicGroup $topicGroup
     * @param  KekRozsak\FrontBundle\Entity\ForumTopic      $topic
     * @return Symfony\Component\HttpFoundation\Response
     *
     * @Route("/{topicGroupSlug}/{topicSlug}/kedvenc-be.do", name="KekRozsakFrontBundle_forumFavouriteTopic", options={"expose": true})
     * @Method("GET")
     */
    public function favouriteTopic($topicGroupSlug, $topicSlug)
    {
	    $topicGroupRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:ForumTopicGroup');
        if (null === $topicGroup = $topicGroupRepo->findOneBySlug($topicGroupSlug)) {
            throw $this->createNotFoundException('Ilyen témakör nem létezik!');
        }

        $topicRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:ForumTopic');
        if (null === $topic = $topicRepo->findOneBy(array('slug' => $topicSlug, 'topicGroup' => $topicGroup))) {
            throw $this->createNotFoundException('Ilyen téma nem létezik!');
        }

        $user = $this->get('security.context')->getToken()->getUser();
        if (($userData = $user->getUserData()) === null) {
            $userData = new UserData();
            $userData->setUser($user);
        }
        $userData->addFavouriteTopic($topic);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($userData);
        $em->flush();

        return new Response();
    }

    /**
     * @param  KekRozsak\FrontBundle\Entity\ForumTopicGroup $topicGroup
     * @param  KekRozsak\FrontBundle\Entity\ForumTopic      $topic
     * @return Symfony\Component\HttpFoundation\Response
     *
     * @Route("/{topicGroupSlug}/{topicSlug}/kedvenc-ki.do", name="KekRozsakFrontBundle_forumUnfavouriteTopic", options={"expose": true})
     * @Method("GET")
     */
    public function unfavouriteTopic($topicGroupSlug, $topicSlug)
    {
        $topicGroupRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:ForumTopicGroup');
        if (null === $topicGroup = $topicGroupRepo->findOneBySlug($topicGroupSlug)) {
            throw $this->createNotFoundException('Ilyen témakör nem létezik!');
        }

        $topicRepo = $this->getDoctrine()->getRepository('KekRozsakFrontBundle:ForumTopic');
        if (null === $topic = $topicRepo->findOneBy(array('slug' => $topicSlug, 'topicGroup' => $topicGroup))) {
            throw $this->createNotFoundException('Ilyen téma nem létezik!');
        }

        $user = $this->get('security.context')->getToken()->getUser();
        if (($userData = $user->getUserData()) === null) {
            $userData = new UserData();
            $userData->setUser($user);
        }
        $userData->removeFavouriteTopic($topic);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($userData);
        $em->flush();

        return new Response();
    }
}
