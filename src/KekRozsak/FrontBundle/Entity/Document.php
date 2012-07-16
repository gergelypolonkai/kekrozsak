<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use KekRozsak\SecurityBundle\Entity\User;
use KekRozsak\FrontBundle\Entity\Group;

/**
 * KekRozsak\FrontBundle\Entity\Document
 * @ORM\Entity
 * @ORM\Table(name="documents")
 */
class Document
{
	public function __construct()
	{
		$this->groups = new ArrayCollection();
	}

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
	 * @var string $title
	 * @ORM\Column(type="string", length=150, unique=true, nullable=false)
	 */
	protected $title;

	/**
	 * Set title
	 *
	 * @param string $title
	 * @return Document
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
	 * @ORM\Column(type="string", length=150, unique=true, nullable=false)
	 */
	protected $slug;

	/**
	 * Set slug
	 *
	 * @param string $slug
	 * @return Document
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
	 * @var KekRozsak\SecurityBundle\Entity\User $createdBy
	 * @ORM\ManyToOne(targetEntity="KekRozsak\SecurityBundle\Entity\User")
	 * @ORM\JoinColumn(name="created_by_id")
	 */
	protected $createdBy;

	/**
	 * Set createdBy
	 *
	 * @param KekRozsak\SecurityBundle\Entity\User $createdBy
	 * @return Document
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
	 * @var DateTime $createdat
	 * @ORM\Column(type="datetime", nullable=false, name="created_at")
	 */
	protected $createdAt;

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
	 * @var string $content
	 * @ORM\Column(type="text", nullable=false)
	 */
	protected $content;

	/**
	 * Set content
	 *
	 * @param string $content
	 * @return Document
	 */
	public function setContent($content)
	{
		$this->content = $content;
		return $this;
	}

	/**
	 * Get content
	 *
	 * @return string
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * @var Doctrine\Common\Collections\ArrayCollection $groups
	 * @ORM\ManyToMany(targetEntity="KekRozsak\FrontBundle\Entity\Group", mappedBy="documents")
	 */
	protected $groups;

	/**
	 * Add a group
	 *
	 * @param KekRozsak\FrontBundle\Entity\Group $group
	 * @return Document
	 */
	public function addGroup(\KekRozsak\FrontBundle\Entity\Group $group)
	{
		$this->groups[] = $group;
		return $this;
	}

	/**
	 * Get all groups
	 *
	 * @return Doctrine\Common\Collections\ArrayCollection
	 */
	public function getGroups()
	{
		return $this->group;
	}
}
