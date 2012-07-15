<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use KekRozsak\SecurityBundle\Entity\User;

/**
 * KekRozsak\FrontBundle\Entity\Group
 * @ORM\Entity
 * @ORM\Table(name="groups")
 */
class Group
{
	public function __construct()
	{
		$this->members = new ArrayCollection();
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
	 * @var KekRozsak\SecurityBundle\Entity\User $leader
	 * @ORM\ManyToOne(targetEntity="KekRozsak\SecurityBundle\Entity\User")
	 */
	protected $leader;

	/**
	 * Set leader
	 *
	 * @param KekRozsak\SecurityBundle\Entity\User $leader
	 * @return Group
	 */
	public function setLeader(\KekRozsak\SecurityBundle\Entity\User $leader = null)
	{
		$this->leader = $leader;
		return $this;
	}

	/**
	 * Get leader
	 *
	 * @return KekRozsak\SecurityBundle\Entity\User
	 */
	public function getLeader()
	{
		return $this->leader;
	}

	/**
	 * @var string $name
	 * @ORM\Column(type="string", length=50, nullable=false, unique=true)
	 */
	protected $name;

	/**
	 * Set name
	 *
	 * @param string $name
	 * @return Group
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @var string $slug
	 * @ORM\Column(type="string", length=50, nullable=false, unique=true)
	 */
	protected $slug;

	/**
	 * Set slug
	 *
	 * @param string $slug
	 * @return Group
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
	 * @return Group
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
	 * @ORM\Column(type="datetime", name="created_at", nullable=false)
	 */
	protected $createdAt;

	/**
	 * Set createdAt
	 *
	 * @param DateTime $createdAt
	 * @return Group
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
	 * @var Doctrine\Common\Collections\ArrayCollection $members
	 * @ORM\OneToMany(targetEntity="UserGroupMembership", mappedBy="group")
	 */
	protected $members;

	/**
	 * Add member
	 *
	 * @param KekRozsak\FrontBundle\Entity\UserGroupMembership $member
	 * @return Group
	 */
	public function addMember(\KekRozsak\FrontBundle\Entity\UserGroupMembership $member)
	{
		$this->members[] = $member;
		return $this;
	}

	/**
	 * Get all members
	 *
	 * @return Doctrine\Common\Collections\ArrayCollection
	 */
	public function getMembers()
	{
		return $this->members;
	}
}
