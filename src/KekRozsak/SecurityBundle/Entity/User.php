<?php

namespace KekRozsak\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

use KekRozsak\FrontBundle\Entity\UserData;
use KekRozsak\FrontBundle\Entity\UserGroupMembership;

/**
 * KekRozsak\SecurityBundle\Entity\User
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @DoctrineAssert\UniqueEntity(fields="username", message="Ez a felhasználónév már foglalt. Kérlek, válassz egy másikat!", groups={"registration"})
 * @DoctrineAssert\UniqueEntity(fields="email", message="Ez az e-mail cím már foglalt. Kérlek, válassz egy másikat!", groups={"registration"})
 * @DoctrineAssert\UniqueEntity(fields="displayName", message="Ez a név már foglalt. Kérlek, válassz egy másikat!", groups={"registration"})
 */
class User implements UserInterface, AdvancedUserInterface
{
	public function __construct()
	{
		$this->groups = new ArrayCollection();
		$this->roles = new ArrayCollection();
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
	 * @var string $username
	 * @ORM\Column(type="string", length=50, nullable=false, unique=true)
	 * @Assert\NotBlank(groups="registration")
	 */
	protected $username;

	/**
	 * Set username
	 *
	 * @param string $username
	 * @return User
	 */
	public function setUsername($username)
	{
		$this->username = $username;
		return $this;
	}

	/**
	 * Get username
	 *
	 * @return string
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * @var string $password
	 * @ORM\Column(type="string", length=50, nullable=false)
	 * @Assert\NotBlank(groups="registration")
	 */
	protected $password;

	/**
	 * Set password
	 *
	 * @param string $password
	 * @return User
	 */
	public function setPassword($password)
	{
		$this->password = $password;
		return $this;
	}

	/**
	 * Get password
	 *
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @var string $displayName
	 * @ORM\Column(type="string", length=50, unique=true, name="display_name")
	 */
	protected $displayName;

	/**
	 * Set displayName
	 *
	 * @param string $displayName
	 * @return User
	 */
	public function setDisplayName($displayName)
	{
		$this->displayName = $displayName;
		return $this;
	}

	/**
	 * Get displayName
	 *
	 * @return string
	 */
	public function getDisplayName()
	{
		return $this->displayName;
	}

	/**
	 * @var string $email
	 * @ORM\Column(type="string", length=100, nullable=false, unique=true)
	 */
	protected $email;

	/**
	 * Set email
	 *
	 * @param string $email
	 * @return User
	 */
	public function setEmail($email)
	{
		$this->email = $email;
		return $this;
	}

	/**
	 * Get email
	 *
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @var DateTime $registeredAt
	 * @ORM\Column(type="datetime", nullable=false, name="registered_at")
	 */
	protected $registeredAt;

	/**
	 * Set registeredAt
	 *
	 * @param DateTime $registeredAt
	 * @return User
	 */
	public function setRegisteredAt(\DateTime $registeredAt)
	{
		$this->registeredAt = $registeredAt;
		return $this;
	}

	/**
	 * Get registeredAt
	 *
	 * @return DateTime
	 */
	public function getRegisteredAt()
	{
		return $this->registeredAt;
	}

	/**
	 * @var User acceptedBy
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="accepted_by_id")
	 */
	protected $acceptedBy;

	/**
	 * Set acceptedBy
	 *
	 * @param User $acceptedBy
	 * @return User
	 */
	public function setAcceptedBy(User $acceptedBy = null)
	{
		$this->acceptedBy = $acceptedBy;
		return $this;
	}

	/**
	 * Get acceptedBy
	 *
	 * @return User
	 */
	public function getAcceptedBy()
	{
		return $this->acceptedBy;
	}

	/**
	 * @var DateTime $lastLoginAt
	 * @ORM\Column(type="datetime", nullable=true, name="last_login_at")
	 */
	protected $lastLoginAt;

	/**
	 * Set lastLoginAt;
	 *
	 * @param DateTime $lastLoginAt
	 * @return User
	 */
	public function setLastLoginAt(\DateTime $lastLoginAt = null)
	{
		$this->lastLoginAt = $lastLoginAt;
		return $this;
	}

	/**
	 * Get lastLoginAt
	 *
	 * @return DateTime
	 */
	public function getLastLoginAt()
	{
		return $this->lastLoginAt;
	}

	/**
	 * @var \KekRozsak\FrontBundle\Entity\UserData $userData
	 * @ORM\OneToOne(targetEntity="KekRozsak\FrontBundle\Entity\UserData", fetch="LAZY", cascade={"persist"}, mappedBy="user")
	 */
	protected $userData;


	/**
	 * Set userData
	 *
	 * @param \KekRozsak\FrontBundle\Entity\UserData $userData
	 * @return User
	 */
	public function setUserData(\KekRozsak\FrontBundle\Entity\UserData $userData = null)
	{
		$this->userData = $userData;
		$userData->setUser($this);
		return $this;
	}

	/**
	 * Get userData
	 *
	 * @return \KekRozsak\FrontBundle\Entity\UserData
	 */
	public function getUserData()
	{
		return $this->userData;
	}

	/**
	 * @var Doctrine\Common\Collections\ArrayCollection $groups
	 * @ORM\OneToMany(targetEntity="KekRozsak\FrontBundle\Entity\UserGroupMembership", mappedBy="user")
	 * @ORM\JoinColumn(referencedColumnName="user_id")
	 */
	protected $groups;

	/**
	 * Add group
	 *
	 * @param KekRozsak\FrontBundle\Entity\UserGroupMembership $group
	 * @return User
	 */
	public function addGroup(\KekRozsak\FrontBundle\Entity\UserGroupMembership $group)
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
		return $this->groups;
	}

	/**
	 * @var Doctrine\Common\Collections\ArrayCollection $roles
	 * @ORM\ManyToMany(targetEntity="Role")
	 */
	protected $roles;

	/**
	 * Add a role
	 *
	 * @param KekRozsak\SecurityBundle\Entity\Role $role
	 * @return User
	 */
	public function addRole(\KekRozsak\SecurityBundle\Entity\Role $role)
	{
		$this->roles[] = $role;
		return $this;
	}

	/**
	 * Get all roles
	 *
	 * @return array
	 */
	public function getRoles()
	{
		return $this->roles->toArray();
	}

	/* Here comes the remaining part of UserInterface implementation */

	public function getSalt()
	{
		/* As we use crypt() to encode passwords, salt is always the
		 * same as password
		 */
		return $this->password;
	}

	public function eraseCredentials()
	{
	}

	/* Here comes the AdvancedUserInterface implementation */

	public function isAccountNonExpired()
	{
		/* Currently, accounts never expire */
		return true;
	}

	public function isAccountNonLocked()
	{
		/* Currently, accounts cannot be locked */
		return true;
	}

	public function isCredentialsNonExpired()
	{
		/* Currently, credentials never expire */
		return true;
	}

	public function isEnabled()
	{
		/* Account is enabled if it is accepted by someone */
		return ($this->acceptedBy !== null);
	}
}
