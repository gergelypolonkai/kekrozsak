<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * KekRozsak\FrontBundle\Entity\User
 */
class User implements UserInterface, AdvancedUserInterface
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $username
     */
    private $username;

    /**
     * @var string $password
     */
    private $password;

    /**
     * @var string $email
     */
    private $email;

    /**
     * @var DateTime $registered_at
     */
    private $registered_at;

    /**
     * @var string $display_name
     */
    private $display_name;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $roles;

    public function __construct()
    {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set registered_at
     *
     * @param DateTime $registeredAt
     * @return User
     */
    public function setRegisteredAt(\DateTime $registeredAt)
    {
        $this->registered_at = $registeredAt;
        return $this;
    }

    /**
     * Get registered_at
     *
     * @return DateTime 
     */
    public function getRegisteredAt()
    {
        return $this->registered_at;
    }

    /**
     * Set display_name
     *
     * @param string $displayName
     * @return User
     */
    public function setDisplayName($displayName)
    {
        $this->display_name = $displayName;
        return $this;
    }

    /**
     * Get display_name
     *
     * @return string 
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }

    /**
     * Add roles
     *
     * @param KekRozsak\FrontBundle\Entity\Role $roles
     * @return User
     */
    public function addRole(\KekRozsak\FrontBundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;
        return $this;
    }

    /**
     * Get roles
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRoles()
    {
        return $this->roles->toArray();
    }

    public function getRolesCollection()
    {
	return $this->roles;
    }

    public function eraseCredentials()
    {
    }

    public function getSalt()
    {
	return $this->password;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $articles;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $forum_posts;


    /**
     * Add articles
     *
     * @param KekRozsak\FrontBundle\Entity\Article $articles
     * @return User
     */
    public function addArticle(\KekRozsak\FrontBundle\Entity\Article $articles)
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
     * Add forum_posts
     *
     * @param KekRozsak\FrontBundle\Entity\ForumPost $forumPosts
     * @return User
     */
    public function addForumPost(\KekRozsak\FrontBundle\Entity\ForumPost $forumPosts)
    {
        $this->forum_posts[] = $forumPosts;
        return $this;
    }

    /**
     * Get forum_posts
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getForumPosts()
    {
        return $this->forum_posts;
    }
    /**
     * @var KekRozsak\FrontBundle\Entity\User
     */
    private $accepted_by;


    /**
     * Set accepted_by
     *
     * @param KekRozsak\FrontBundle\Entity\User $acceptedBy
     * @return User
     */
    public function setAcceptedBy(\KekRozsak\FrontBundle\Entity\User $acceptedBy = null)
    {
        $this->accepted_by = $acceptedBy;
        return $this;
    }

    /**
     * Get accepted_by
     *
     * @return KekRozsak\FrontBundle\Entity\User 
     */
    public function getAcceptedBy()
    {
        return $this->accepted_by;
    }

    public function isAccountNonExpired()
    {
	    return true;
    }
    
    public function isAccountNonLocked()
    {
	    return true;
    }
    
    public function isCredentialsNonExpired()
    {
	return true;
    }
    
    public function isEnabled()
    {
	return ($this->accepted_by !== null);
    }
    /**
     * @var datetime $last_login_at
     */
    private $last_login_at;


    /**
     * Set last_login_at
     *
     * @param datetime $lastLoginAt
     * @return User
     */
    public function setLastLoginAt($lastLoginAt)
    {
        $this->last_login_at = $lastLoginAt;
        return $this;
    }

    /**
     * Get last_login_at
     *
     * @return datetime 
     */
    public function getLastLoginAt()
    {
        return $this->last_login_at;
    }
}