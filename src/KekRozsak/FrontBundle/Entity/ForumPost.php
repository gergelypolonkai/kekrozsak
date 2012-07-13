<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use KekRozsak\FrontBundle\Entity\User;
use KekRozsak\FrontBundle\Entity\ForumTopic;
use KekRozsak\FrontBundle\Entity\ForumTopicGroup;

/**
 * KekRozsak\FrontBundle\Entity\ForumPost
 * @ORM\Entity
 * @ORM\Table(name="forum_posts")
 */
class ForumPost
{
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
	 * @var datetime $createdAt
	 * @ORM\Column(type="datetime", name="created_at", nullable=false)
	 */
	private $createdAt;

	/**
	 * Set createdAt
	 *
	 * @param DateTime $createdAt
	 * @return ForumPost
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
	 * @var User $createdBy
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="forumPosts")
	 * @ORM\JoinColumn(name="created_by_id", referencedColumnName="id")
	 */
	private $createdBy;

	/**
	 * Set createdBy
	 *
	 * @param User $createdBy
	 * @return ForumPost
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
	 * @return ForumPost
	 */
	public function setUpdatedAt(\DateTime $updatedAt = null)
	{
		$this->updatedAt = $updatedAt;
		return $this;
	}

	/**
	 * Get updatedAt
	 *
	 * @return DateTime 
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}

	/**
	 * @var User $updatedBy
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="updated_by_id", referencedColumnName="id")
	 */
	private $updatedBy;

	/**
	 * Set updatedBy
	 *
	 * @param User $updatedBy
	 * @return ForumPost
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
	 * @var string $updateReason
	 * @ORM\Column(type="text", name="update_reason", nullable=true)
	 */
	private $updateReason;

	/**
	 * Set updateReason
	 *
	 * @param string $updateReason
	 * @return ForumPost
	 */
	public function setUpdateReason($updateReason = null)
	{
		$this->updateReason = $updateReason;
		return $this;
	}

	/**
	 * Get updateReason
	 *
	 * @return string 
	 */
	public function getUpdateReason()
	{
		return $this->updateReason;
	}

	/**
	 * @var ForumTopic $topic
	 * @ORM\ManyToOne(targetEntity="ForumTopic", inversedBy="posts")
	 */
	private $topic;

	/**
	 * Set topic
	 *
	 * @param ForumTopic $topic
	 * @return ForumPost
	 */
	public function setTopic(ForumTopic $topic)
	{
		$this->topic = $topic;
		if (($this->topic->getLastPost() === null) || ($this->topic->getLastPost()->getCreatedAt() > $this->createdAt))
			$topic->setLastPost($this);
		return $this;
	}

	/**
	 * Get topic
	 *
	 * @return ForumTopic 
	 */
	public function getTopic()
	{
		return $this->topic;
	}

	/**
	 * @var text $text
	 * @ORM\Column(type="text", nullable=false)
	 */
	private $text;

	/**
	 * Set text
	 *
	 * @param string $text
	 * @return ForumPost
	 */
	public function setText($text)
	{
		$this->text = $text;
		return $this;
	}

	/**
	 * Get text
	 *
	 * @return string 
	 */
	public function getText()
	{
		return $this->text;
	}
}
