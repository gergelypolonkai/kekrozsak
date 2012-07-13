<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KekRozsak\FrontBundle\Entity\News
 * @ORM\Entity
 * @ORM\Table(name="news")
 */
class News
{
	/**
	 * @var integer $id
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer", name="id")
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
	 * @ORM\Column(type="datetime", name="created_at")
	 */
	private $createdAt;

	/**
	 * Set createdAt
	 *
	 * @param datetime $createdAt
	 * @return News
	 */
	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
		return $this;
	}

	/**
	 * Get createdAt
	 *
	 * @return datetime 
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * @var datetime $updatedAt
	 * @ORM\Column(type="datetime", name="updated_at", nullable=true)
	 */
	private $updatedAt;

	/**
	 * @var text $updateReason
	 * @ORM\Column(type="text", name="update_reason", nullable=true)
	 */
	private $updateReason;

	/**
	 * @var string $title
	 * @ORM\Column(type="string", length=100, nullable=false)
	 */
	private $title;

	/**
	 * @var string $slug
	 * @ORM\Column(type="string", length=100, nullable=false, unique=true)
	 */
	private $slug;

	/**
	 * @var text $text
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $text;

	/**
	 * @var KekRozsak\FrontBundle\Entity\User $createdBy
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="created_by_id", referencedColumnName="id")
	 */
	private $createdBy;

	/**
	 * @var KekRozsak\FrontBundle\Entity\User $updatedBy
	 * @ORM\ManyToOne(targetEntity="User", fetch="EXTRA_LAZY")
	 * @ORM\JoinColumn(name="updated_by_id", referencedColumnName="id")
	 */
	private $updatedBy;

	/**
	 * Set updatedAt
	 *
	 * @param datetime $updatedAt
	 * @return News
	 */
	public function setUpdatedAt($updatedAt)
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
	 * Set updateReason
	 *
	 * @param text $updateReason
	 * @return News
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
	 * Set title
	 *
	 * @param string $title
	 * @return News
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
	 * Set slug
	 *
	 * @param string $slug
	 * @return News
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
	 * Set text
	 *
	 * @param text $text
	 * @return News
	 */
	public function setText($text)
	{
		$this->text = $text;
		return $this;
	}

	/**
	 * Get text
	 *
	 * @return text 
	 */
	public function getText()
	{
		return $this->text;
	}

	/**
	 * Set createdBy
	 *
	 * @param KekRozsak\FrontBundle\Entity\User $createdBy
	 * @return News
	 */
	public function setCreatedBy(\KekRozsak\FrontBundle\Entity\User $createdBy = null)
	{
		$this->createdBy = $createdBy;
		return $this;
	}

	/**
	 * Get createdBy
	 *
	 * @return KekRozsak\FrontBundle\Entity\User 
	 */
	public function getCreatedBy()
	{
		return $this->createdBy;
	}

	/**
	 * Set updatedBy
	 *
	 * @param KekRozsak\FrontBundle\Entity\User $updatedBy
	 * @return News
	 */
	public function setUpdatedBy(\KekRozsak\FrontBundle\Entity\User $updatedBy = null)
	{
		$this->updatedBy = $updatedBy;
		return $this;
	}

	/**
	 * Get updatedBy
	 *
	 * @return KekRozsak\FrontBundle\Entity\User 
	 */
	public function getUpdatedBy()
	{
		return $this->updatedBy;
	}
}
