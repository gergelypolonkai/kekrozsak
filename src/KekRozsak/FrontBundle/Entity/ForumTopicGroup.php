<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use KekRozsak\SecurityBundle\Entity\User;

/**
 * KekRozsak\FrontBundle\Entity\ForumTopicGroup
 * @ORM\Entity
 * @ORM\Table(name="forum_topic_groups")
 */
class ForumTopicGroup
{
	public function __construct()
	{
		$this->topics = new ArrayCollection();
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
	 * @var KekRozsak\SecurityBundle\Entity\User $createdBy
	 * @ORM\ManyToOne(targetEntity="KekRozsak\SecurityBundle\Entity\User")
	 * @ORM\JoinColumn(name="created_by_id")
	 */
	private $createdBy;

	/**
	 * Set createdBy
	 *
	 * @param KekRozsak\SecurityBundle\Entity\User $createdBy
	 * @return ForumTopicGroup
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
	 * @ORM\Column(type="datetime", nullable=false)
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
	 * @var string $slug
	 * @ORM\Column(type="string", length=100, nullable=false, unique=true)
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
	 * @var string $title
	 * @ORM\Column(type="string", length=100, nullable=false, unique=true)
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
	 * @var ArrayCollection $topics
	 * @ORM\OneToMany(targetEntity="ForumTopic", mappedBy="topicGroup")
	 */
	private $topics;

	/**
	 * Add topic
	 *
	 * @param ForumTopic $topic
	 * @return ForumTopicGroup
	 */
	public function addTopic(ForumTopic $topic)
	{
		$this->topics[] = $topic;
		return $this;
	}

	/**
	 * Get topics
	 *
	 * @return ArrayCollection
	 */
	public function getTopics()
	{
		return $this->topics;
	}
}

