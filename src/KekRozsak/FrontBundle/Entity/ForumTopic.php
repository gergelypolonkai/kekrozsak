<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use KekRozsak\SecurityBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="forum_topics")
 */
class ForumTopic
{
	public function __construct()
	{
		$this->posts = new ArrayCollection();
	}

	/**
	 * @var integer $id
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId()
	{
		return  $this->id;
	}

	/**
	 * @var KekRozsak\SecurityBundle\Entity\User $createdBy
	 * @ORM\ManyToOne(targetEntity="KekRozsak\SecurityBundle\Entity\User")
	 * @ORM\JoinColumn(name="created_by_id")
	 */
	private $createdBy;

	/**
	 * Set createdBy
	 *
	 * @param KekRozsak\SecurityBundle\Entity\User
	 * @return ForumTopic
	 */
	public function setCreatedBy(\KekRozsak\SecurityBundle\Entity\User $createdBy)
	{
		$this->createdBy = $createdBy;
		return $this;
	}

	/**
	 * Get createdBy
	 *
	 * @return KekRozsak\SecurityBundle\Entity\User
	 */
	public function getCreatedBy()
	{
		return $this->createdBy;
	}


	/**
	 * @var DateTime $createdAt
	 * @ORM\Column(type="datetime", nullable=false, name="created_at")
	 */
	private $createdAt;

	/**
	 * Set createdAt
	 *
	 * @param DateTime $createdAt
	 * @return ForumTopic
	 */
	public function setCreatedAt(\DateTime $createdAt)
	{
		$this->createdAt = $createdAt;
		return $this;
	}

	/**
	 * Get createdAt
	 *
	 * @return DateTime
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * @var ForumTopicGroup $topicGroup
	 * @ORM\ManyToOne(targetEntity="ForumTopicGroup", inversedBy="topics")
	 * @ORM\JoinColumn(name="topic_group_id")
	 */
	private $topicGroup;

	/**
	 * Set topicGroup
	 *
	 * @param ForumTopicGroup $topicGroup
	 * @return ForumTopic
	 */
	public function setTopicGroup(ForumTopicGroup $topicGroup)
	{
		$this->topicGroup = $topicGroup;
		return $this;
	}

	/**
	 * Get topicGroup
	 *
	 * @return ForumTopicGroup
	 */
	public function getTopicGroup()
	{
		return $this->topicGroup;
	}

	/**
	 * @var string $slug
	 * @ORM\Column(type="string", length=100, nullable=false)
	 */
	private $slug;

	/**
	 * Set slug
	 *
	 * @param string $slug
	 * @return ForumTopic
	 */
	public function setSlug($slug)
	{
		$this->slug = $slug;
		return $this;
	}

	/**
	 * Get slug
	 *
	 * @return string
	 */
	public function getSlug()
	{
		return $this->slug;
	}

	/**
	 * @var string $title
	 * @ORM\Column(type="string", length=100, nullable=false)
	 */
	private $title;

	/**
	 * Set title
	 *
	 * @param string $title
	 * @return ForumTopic
	 */
	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}

	/**
	 * Get title
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @var ForumPost $lastPost
	 * @ORM\OneToOne(targetEntity="ForumPost", cascade={"persist"})
	 * @ORM\JoinColumn(name="last_post_id")
	 */
	private $lastPost;

	/**
	 * Set lastPost
	 *
	 * @param ForumPost $lastPost
	 * @return ForumTopic
	 */
	public function setLastPost($lastPost = null)
	{
		$this->lastPost = $lastPost;
	}

	/**
	 * Get lastPost
	 *
	 * @return ForumPost
	 */
	public function getLastPost()
	{
		return $this->lastPost;
	}

	/**
	 * @var ArrayCollection $topics;
	 * @ORM\OneToMany(targetEntity="ForumPost", mappedBy="topic")
	 */
	private $posts;

	/**
	 * Add post
	 *
	 * @param ForumPost $post
	 * @return ForumTopic
	 */
	public function addPost(ForumPost $post)
	{
		$this->posts[] = $post;
		return $this;
	}

	/**
	 * Get posts
	 *
	 * @return ArrayCollection
	 */
	public function getPosts()
	{
		return $this->posts;
	}
}

