<?php

namespace KekRozsak\SecurityBundle\Entity;

use \Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Security\Core\User\UserInterface;
use \Symfony\Component\Security\Core\User\AdvancedUserInterface;
use \Symfony\Component\Validator\Constraints as Assert;
use \Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

use \KekRozsak\FrontBundle\Entity\UserData;

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
	 * @var string $username
	 * @ORM\Column(type="string", length=50, nullable=false, unique=true)
	 * @Assert\NotBlank(groups="registration")
	 */
	private $username;

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
	private $password;

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
	private $displayName;

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
	private $email;

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
	private $registeredAt;

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
	private $acceptedBy;

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
	private $lastLoginAt;

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
	 * @ORM\OneToOne(targetEntity="KekRozsak\FrontBundle\Entity\UserData", mappedBy="user", fetch="LAZY", cascade={"persist"})
	 * @ORM\JoinColumn(name="id", referencedColumnName="user_id")
	 */
	private $userData;


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

	/* Here comes the remaining part of UserInterface implementation */

	public function getRoles()
	{
		/* As we use ACLs instead of roles, every user get the
		 * ROLE_USER role, and nothing else
		 */
		return array('ROLE_USER');
	}

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
