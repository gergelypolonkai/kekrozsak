<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

use KekRozsak\FrontBundle\Entity\Article;
use KekRozsak\FrontBundle\Entity\ForumPost;
use KekRozsak\FrontBundle\Entity\Group;
use KekRozsak\FrontBundle\Entity\Document;
use KekRozsak\FrontBundle\Entity\UserData;
use KekRozsak\FrontBundle\Entity\PollAnswer;

/**
 * KekRozsak\FrontBundle\Entity\User
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @DoctrineAssert\UniqueEntity(fields={"username"}, message="Ez a felhasználónév már foglalt. Kérlek, válassz egy másikat!", groups={"registration"})
 * @DoctrineAssert\UniqueEntity(fields={"email"}, message="Ez az e-mail cím már foglalt. Kérlek, válassz egy másikat!", groups={"registration"})
 * @DoctrineAssert\UniqueEntity(fields={"displayName"}, message="Ez a név már foglalt. Kérlek, válassz egy másikat!", groups={"registration"})
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
	 * @Assert\NotBlank(groups={"registration"})
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
	 * @Assert\NotBlank(groups={"registration"})
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
	 * @var string $email
	 * @ORM\Column(type="string", length=50, unique=true, nullable=false)
	 * @Assert\NotBlank(groups={"registration"})
	 * @Assert\Email(groups={"registration"})
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
	 * @ORM\Column(type="datetime", name="registered_at", nullable=false)
	 * @Assert\NotBlank()
	 * TODO: original validation.yml contained Type: \DateTime
	 * Assert\Type("\\DateTime")
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
	 * @var string $displayName
	 * @ORM\Column(type="string", length=50, nullable=false, unique=true, name="display_name")
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
	 * @var User $acceptedBy
	 * @ORM\ManyToOne(targetEntity="User", fetch="EXTRA_LAZY")
	 * @ORM\JoinColumn(name="accepted_by_id", referencedColumnName="id")
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
	 * @var datetime $lastLoginAt
	 * @ORM\Column(type="datetime", nullable=true, name="last_login_at")
	 */
	private $lastLoginAt;

	/**
	 * Set lastLoginAt
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
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 * @ORM\OneToMany(targetEntity="Article", mappedBy="createdBy", fetch="EXTRA_LAZY")
	 */
	private $articles;

	/**
	 * Add articles
	 *
	 * @param Article $articles
	 * @return User
	 */
	public function addArticle(Article $articles)
	{
		$this->articles[] = $articles;
		return $this;
	}

	/**
	 * Get articles
	 *
	 * @return Doctrine\Common\Collections\Collection 
	 */
	public function getArticles()
	{
		return $this->articles;
	}

	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 * @ORM\OneToMany(targetEntity="ForumPost", mappedBy="createdBy", fetch="EXTRA_LAZY")
	 */
	private $forumPosts;

	/**
	 * Add forumPosts
	 *
	 * @param ForumPost $forumPosts
	 * @return User
	 */
	public function addForumPost(ForumPost $forumPosts)
	{
		$this->forumPosts[] = $forumPosts;
		return $this;
	}

	/**
	 * Get forumPosts
	 *
	 * @return Doctrine\Common\Collections\Collection 
	 */
	public function getForumPosts()
	{
		return $this->forumPosts;
	}

	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection $ledGroups
	 * @ORM\OneToMany(targetEntity="Group", mappedBy="leader", fetch="EXTRA_LAZY")
	 */
	private $ledGroups;

	/**
	 * Add ledGroups
	 *
	 * @param Group $group
	 * @return User
	 */
	public function addGroup(Group $group)
	{
		$this->ledGroups[] = $group;
		return $this;
	}

	/**
	 * Get ledGroups
	 *
	 * @return Doctrine\Common\Collections\Collection 
	 */
	public function getLedGroups()
	{
		return $this->ledGroups;
	}

	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection $createdDocuments
	 * @ORM\OneToMany(targetEntity="Document", mappedBy="createdBy", fetch="EXTRA_LAZY")
	 */
	private $createdDocuments;

	/**
	 * Add createdDocuments
	 *
	 * @param Document $document
	 * @return User
	 */
	public function addDocument(Document $document)
	{
		$this->createdDocuments[] = $document;
		return $this;
	}

	/**
	 * Get createdDocuments
	 *
	 * @return Doctrine\Common\Collections\Collection
	 */
	public function getCreatedDocuments()
	{
		return $this->createdDocuments;
	}

	/**
	 * @var UserData $userData
	 * @ORM\OneToOne(targetEntity="UserData", mappedBy="user", fetch="EXTRA_LAZY", cascade={"persist"})
	 * @ORM\JoinColumn(name="id", referencedColumnName="user_id")
	 */
	private $userData;

	/**
	 * Set userData
	 *
	 * @param UserData $userData
	 * @return User
	 */
	public function setUserData(UserData $userData = null)
	{
		$this->userData = $userData;
		return $this;
	}

	/**
	 * Get userData
	 *
	 * @return UserData 
	 */
	public function getUserData()
	{
		return $this->userData;
	}

	/**
	 * @var PollAnswer
	 * @ORM\ManyToMany(targetEntity="PollAnswer", mappedBy="voters", fetch="EXTRA_LAZY")
	 */
	private $pollVotes;

	/**
	 * Set pollVotes
	 *
	 * @param PollAnswer $pollVotes
	 * @return User
	 */
	public function setPollVotes(PollAnswer $pollVotes = null)
	{
		$this->pollVotes = $pollVotes;
		return $this;
	}

	/**
	 * Get pollVotes
	 *
	 * @return PollAnswer 
	 */
	public function getPollVotes()
	{
		return $this->pollVotes;
	}

	/**
	 * Add pollVotes
	 *
	 * @param PollAnswer $pollVotes
	 * @return User
	 */
	public function addPollAnswer(PollAnswer $pollVotes)
	{
		$this->pollVotes[] = $pollVotes;
		return $this;
	}

	/**
	 * UserInterface::eraseCredentials()
	 */
	public function eraseCredentials()
	{
	}

	/**
	 * UserInterface::getSalt()
	 *
	 * As we use crypt() to encrypt and check password, salt is always the
	 * same as the encrypted password.
	 */
	public function getSalt()
	{
		return $this->password;
	}

	/**
	 * UserInterface::getRoles
	 */
	public function getRoles()
	{
		return array('ROLE_USER');
	}

	/**
	 * AdvancedUserInterface::isAccountNonExpired()
	 */
	public function isAccountNonExpired()
	{
		return true;
	}

	/**
	 * AdvancedUserInterface::isAccountNonLocked()
	 */
	public function isAccountNonLocked()
	{
		return true;
	}

	/**
	 * AdvancedUserInterface::isCredentialsNonExpired()
	 */
	public function isCredentialsNonExpired()
	{
		return true;
	}

	/**
	 * AdvancedUserInterface::isEnabled()
	 */
	public function isEnabled()
	{
		return ($this->acceptedBy !== null);
	}
}
