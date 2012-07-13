<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use KekRozsak\FrontBundle\Entity\User;
use KekRozsak\FrontBundle\Entity\ForumTopicGroup;
use KekRozsak\FrontBundle\Entity\ForumPost;

/**
 * KekRozsak\FrontBundle\Entity\ForumTopic
 * @ORM\Entity
 * @ORM\Table(name="forum_topics", uniqueConstraints={@ORM\UniqueConstraint(columns={"topic_group_id", "title"}), @ORM\UniqueConstraint(columns={"topic_group_id", "slug"})})
 */
class ForumTopic
{
	public function __construct()
	{
		$this->posts = new \Doctrine\Common\Collections\ArrayCollection();
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
		return $this->id;
	}

	/**
	 * @var string $title
	 * @ORM\Column(type="string", length=100)
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
	 * @var string $slug
	 * @ORM\Column(type="string", length=100)
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
	 * @var datetime $createdAt
	 * @ORM\Column(type="datetime", name="created_at")
	 */
	private $createdAt;

	/**
	 * Set createdAt
	 *
	 * @param DateTime $createdAt
	 * @return ForumTopic
	 */
	public function setCreatedAt($createdAt)
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
	 * @var User
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="created_by_id")
	 */
	private $createdBy;

	/**
	 * Set createdBy
	 *
	 * @param User $createdBy
	 * @return ForumTopic
	 */
	public function setCreatedBy(\User $createdBy)
	{
		$this->createdBy = $createdBy;
		return $this;
	}

	/**
	 * Get createdBy
	 *
	 * @return User 
	 */
	public function getCreatedBy()
	{
		return $this->createdBy;
	}

	/**
	 * @var datetime $updatedAt
	 * @ORM\Column(type="datetime", name="updated_at", nullable=true)
	 */
	private $updatedAt;

	/**
	 * Set updatedAt
	 *
	 * @param datetime $updatedAt
	 * @return ForumTopic
	 */
	public function setUpdatedAt(\DateTime $updatedAt = null)
	{
		$this->updatedAt = $updatedAt;
		return $this;
	}

	/**
	 * Get updatedAt
	 *
	 * @return datetime 
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}

	/**
	 * @var User
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="updated_by_id")
	 */
	private $updatedBy;

	/**
	 * Set updatedBy
	 *
	 * @param User $updatedBy
	 * @return ForumTopic
	 */
	public function setUpdatedBy(User $updatedBy = null)
	{
		$this->updatedBy = $updatedBy;
		return $this;
	}

	/**
	 * Get updatedBy
	 *
	 * @return User 
	 */
	public function getUpdatedBy()
	{
		return $this->updatedBy;
	}

	/**
	 * @var text $updateReason
	 * @ORM\Column(type="text", name="update_reason")
	 */
	private $updateReason;

	/**
	 * Set updateReason
	 *
	 * @param text $updateReason
	 * @return ForumTopic
	 */
	public function setUpdateReason($updateReason)
	{
		$this->updateReason = $updateReason;
		return $this;
	}

	/**
	 * Get updateReason
	 *
	 * @return text 
	 */
	public function getUpdateReason()
	{
		return $this->updateReason;
	}

	/**
	 * @var ForumTopicGroup
	 * @ORM\ManyToOne(targetEntity="ForumTopicGroup")
	 * @ORM\JoinColumn(name="topic_group_id", referencedColumnName="id")
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
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 * @ORM\OneToMany(targetEntity="ForumPost", mappedBy="topic")
	 */
	private $posts;

	/**
	 * Add posts
	 *
	 * @param ForumPost $posts
	 * @return ForumTopic
	 */
	public function addForumPost(ForumPost $posts)
	{
		$this->posts[] = $posts;
		return $this;
	}

	/**
	 * Get posts
	 *
	 * @return Doctrine\Common\Collections\Collection 
	 */
	public function getPosts()
	{
		return $this->posts;
	}

	/**
	 * @var ForumPost
	 * @ORM\OneToOne(targetEntity="ForumPost", cascade={"persist"})
	 * @ORM\JoinColumn(name="last_post_id", referencedColumnName="id")
	 */
	private $lastPost;

	/**
	 * Set lastPost
	 *
	 * @param ForumPost $lastPost
	 * @return ForumTopic
	 */
	public function setLastPost(ForumPost $lastPost = null)
	{
		$this->lastPost = $lastPost;
		$this->topicGroup->setLastPost($lastPost);
		return $this;
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
}
