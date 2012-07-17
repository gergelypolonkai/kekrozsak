<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\Orm\Mapping as ORM;

use KekRozsak\FrontBundle\Entity\ForumTopic;

/**
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
	protected $id;

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
	 * @ORM\ManyToOne(targetEntity="\KekRozsak\SecurityBundle\Entity\User")
	 * @ORM\JoinColumn(name="created_by_id")
	 */
	protected $createdBy;

	/**
	 * Set createdBy
	 *
	 * @param \KekRozsak\SecurityBundle\Entity\User $createdBy
	 * @return ForumPost
	 */
	public function setCreatedBy(\KekRozsak\SecurityBundle\Entity\User $createdBy)
	{
		$this->createdBy = $createdBy;
		return $this;
	}

	/**
	 * Get createdBy
	 *
	 * @return \KekRozsak\SecurityBundle\Entity\User
	 */
	public function getCreatedBy()
	{
		return $this->createdBy;
	}

	/**
	 * @var DateTime $createdAt
	 * @ORM\Column(type="datetime", name="created_at")
	 */
	protected $createdAt;

	/**
	 * Set createdAt
	 *
	 * @param DateTime $createdAt
	 * @return ForumPost
	 */
	public function setCreatedAt(\DateTime $createdAt)
	{
		$this->createdAt = $createdAt;
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
	 * @var string $text
	 * @ORM\Column(type="text", nullable=false)
	 */
	protected $text;

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

	/**
	 * @var ForumTopic $topic
	 * @ORM\ManyToOne(targetEntity="ForumTopic", inversedBy="posts")
	 */
	protected $topic;

	/**
	 * Set topic
	 *
	 * @param ForumTopic $topic
	 * @return ForumPost
	 */
	public function setTopic(ForumTopic $topic)
	{
		$this->topic = $topic;
		if ($topic->getLastPost()->getCreatedAt() < $this->createdAt)
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
}

