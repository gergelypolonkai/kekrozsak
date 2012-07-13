<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use KekRozsak\FrontBundle\Entity\User;

/**
 * KekRozsak\FrontBundle\Entity\Document
 * @ORM\Entity
 * @ORM\Table(name="documents")
 */
class Document
{
	/**
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
	 * @ORM\Column(type="string", length=150, nullable=false, unique=true)
	 */
	private $title;

	/**
	 * Set title
	 *
	 * @param string $title
	 * @return Document
	 */
	public function setTitle(string $title)
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
	 * @var string $slug;
	 * @ORM\Column(type="string", length=150, nullable=false, unique=true)
	 */
	private $slug;

	/**
	 * Set slug
	 *
	 * @param string $slug
	 * @return Document
	 */
	public function setSlug(string $slug)
	{
		$this->slug = $slug;
		return $this;
	}

	/** Get slug
	 *
	 * @return string
	 */
	public function getSlug()
	{
		return $this->slug;
	}

	/**
	 * @var string $text
	 * @ORM\Column(type="text", nullable=false)
	 */
	private $text;

	/**
	 * Set text
	 *
	 * @param string $text
	 * @return Document
	 */
	public function setText(string $text)
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
	 * @var DateTime $createdAt
	 * @ORM\Column(type="datetime", name="created_at", nullable=false)
	 */
	private $createdAt;

	/**
	 * Set createdAt
	 *
	 * @param DateTime $createdAt
	 * @return Document
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
	 * @var User $createdBy
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="createdDocuments")
	 * @ORM\JoinColumn(name="created_by_id", referencedColumnName="id")
	 */
	private $createdBy;

	/**
	 * Set createdBy
	 *
	 * @param User $createdBy
	 * @return Document
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
	 * @var DateTime $updatedAt
	 * @ORM\Column(type="datetime", name="updated_at", nullable=true)
	 */
	private $updatedAt;

	/**
	 * Set updatedAt
	 *
	 * @param DateTime $updatedAt
	 * @return Document
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
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="updatedDocuments")
	 * @ORM\JoinColumn(name="updated_by_id", referencedColumnName="id")
	 */
	private $updatedBy;

	/**
	 * Set updatedBy
	 *
	 * @param User $updatedBy
	 * @return Document
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
	 * @ORM\Column(name="update_reason", type="text", nullable=true)
	 */
	private $updateReason;

	/**
	 * Set updateReason
	 *
	 * @param string $updateReason
	 * @return Document
	 */
	public function setUpdateReason(string $updateReason = null)
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
	 * @var Group $groups
	 * @ORM\ManyToMany(targetEntity="Group", mappedBy="documents", fetch="EXTRA_LAZY")
	 */
	private $groups;

	/**
	 * Set groups
	 *
	 * @param Group $groups
	 * @return Document
	 */
	public function setGroups(Group $groups = null)
	{
		$this->groups = $groups;
		return $this;
	}

	/**
	 * Get groups
	 *
	 * @return Group
	 */
	public function getGroups()
	{
		return $this->groups;
	}
}

