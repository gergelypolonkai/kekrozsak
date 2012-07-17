<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use KekRozsak\SecurityBundle\Entity\User;
use KekRozsak\FrontBundle\Entity\Document;

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
		$this->documents = new ArrayCollection();
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

	/**
	 * Check if user is a member of this Group
	 *
	 * @param KekRozsak\SecurityBundle\Entity\User $user
	 * @return boolean
	 */
	public function isMember(\KekRozsak\SecurityBundle\Entity\User $user)
	{
		return ($this->members->filter(
				function ($groupMembership) use ($user) {
					return (
						($groupMembership->getUser() == $user)
						&& (
							$groupMembership->getGroup()->isOpen()
							|| ($groupMembership->getMembershipAcceptedAt() !== null)
						)
					);
				}
			)->count() > 0);
	}

	/**
	 * Check if user already requested a membership in this Group
	 *
	 * @param KekRozsak\SecurityBundle\Entity\User $user
	 * @return boolean
	 */
	public function isRequested(\KekRozsak\SecurityBundle\Entity\User $user)
	{
		return ($this->members->filter(
				function ($groupMembership) use ($user) {
					return (
						($groupMembership->getUser() == $user)
						&& ($groupMembership->getMembershipRequestedAt() !== null)
					);
				}
			)->count() > 0);
	}

	/**
	 * @var string description
	 * @ORM\Column(type="text", nullable=true)
	 */
	protected $description;

	/**
	 * Set description
	 *
	 * @param string $description
	 * @return Group
	 */
	public function setDescription($description = null)
	{
		$this->description = $description;
		return $this;
	}

	/**
	 * Get description
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @var boolean open
	 * @ORM\Column(type="boolean", nullable=false)
	 */
	protected $open;

	/**
	 * Set open
	 *
	 * @param boolean $open
	 * @ return Group
	 */
	public function setOpen($open = false)
	{
		$this->open = $open;
		return $this;
	}

	/**
	 * Get open
	 *
	 * @return boolean
	 */
	public function isOpen()
	{
		return $this->open;
	}

	/**
	 * @var Doctrine\Common\Collections\ArrayCollection $documents
	 * @ORM\ManyToMany(targetEntity="Document", inversedBy="groups")
	 * @ORM\JoinTable(name="group_document", inverseJoinColumns={
	 *     @ORM\JoinColumn(name="document_id", referencedColumnName="id"),
	 * }, joinColumns={
	 *     @ORM\JoinColumn(name="group_id", referencedColumnName="id")
	 * })
	 */
	protected $documents;

	/**
	 * Add document
	 *
	 * @param KekRozsak\FrontBundle\Entity\Document $document
	 * @return Group
	 */
	public function addDocument(\KekRozsak\FrontBundle\Entity\Document $document)
	{
		$this->documents[] = $document;
		return $this;
	}
	
	/**
	 * Get all documents
	 *
	 * @return Doctrine\Common\Collections\ArrayCollection
	 */
	public function getDocuments()
	{
		return $this->documents;
	}
}
