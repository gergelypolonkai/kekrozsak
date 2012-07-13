<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use KekRozsak\FrontBundle\Entity\User;
use KekRozsak\FrontBundle\Entity\ForumTopic;
use KekRozsak\FrontBundle\Entity\ForumPost;

/**
 * KekRozsak\FrontBundle\Entity\ForumTopicGroup
 * @ORM\Entity
 * @ORM\Table(name="forum_topic_groups")
 */
class ForumTopicGroup
{
	public function __construct()
	{
		$this->topic = new \Doctrine\Common\Collections\ArrayCollection();
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
	 * @ORM\Column(type="string", length=100, unique=true)
	 */
	private $title;

	/**
	 * Set title
	 *
	 * @param string $title
	 * @return ForumTopicGroup
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
	 * @ORM\Column(type="string", length=100, unique=true)
	 */
	private $slug;

	/**
	 * Set slug
	 *
	 * @param string $slug
	 * @return ForumTopicGroup
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
	 * @return ForumTopicGroup
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
	 * @var User
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="created_by_id")
	 */
	private $createdBy;

	/**
	 * Set createdBy
	 *
	 * @param User $createdBy
	 * @return ForumTopicGroup
	 */
	public function setCreatedBy(User $createdBy)
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
	 * @param DateTime $updatedAt
	 * @return ForumTopicGroup
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
	 * @return ForumTopicGroup
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
	 * @var text $update_reason
	 * @ORM\Column(type="text", name="update_reason", nullable=true)
	 */
	private $updateReason;

	/**
	 * Set updateReason
	 *
	 * @param text $updateReason
	 * @return ForumTopicGroup
	 */
	public function setUpdateReason($updateReason = null)
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
	 * @var ForumPost
	 * @ORM\OneToOne(targetEntity="ForumPost", cascade={"persist"})
	 * @ORM\JoinColumn(name="last_post_id")
	 */
	private $lastPost;

	/**
	 * Set lastPost
	 *
	 * @param ForumPost $lastPost
	 * @return ForumTopicGroup
	 */
	public function setLastPost(ForumPost $lastPost = null)
	{
		$this->lastPost = $lastPost;
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

	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 * @ORM\OneToMany(targetEntity="ForumTopic", mappedBy="topicGroup")
	 */
	private $topics;

	/**
	 * Get topics
	 *
	 * @return Doctrine\Common\Collections\Collection 
	 */
	public function getTopics()
	{
		return $this->topics;
	}
}
