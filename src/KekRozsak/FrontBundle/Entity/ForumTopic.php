<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KekRozsak\FrontBundle\Entity\ForumTopic
 */
class ForumTopic
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var string $slug
     */
    private $slug;

    /**
     * @var datetime $created_at
     */
    private $created_at;

    /**
     * @var datetime $updated_at
     */
    private $updated_at;

    /**
     * @var text $update_reason
     */
    private $update_reason;

    /**
     * @var KekRozsak\FrontBundle\Entity\User
     */
    private $created_by;

    /**
     * @var KekRozsak\FrontBundle\Entity\User
     */
    private $updated_by;

    /**
     * @var KekRozsak\FrontBundle\Entity\ForumTopicGroup
     */
    private $topic_group;


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
     * Set title
     *
     * @param string $title
     * @return ForumTopic
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
     * @return ForumTopic
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
     * Set created_at
     *
     * @param datetime $createdAt
     * @return ForumTopic
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
        return $this;
    }

    /**
     * Get created_at
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param datetime $updatedAt
     * @return ForumTopic
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set update_reason
     *
     * @param text $updateReason
     * @return ForumTopic
     */
    public function setUpdateReason($updateReason)
    {
        $this->update_reason = $updateReason;
        return $this;
    }

    /**
     * Get update_reason
     *
     * @return text 
     */
    public function getUpdateReason()
    {
        return $this->update_reason;
    }

    /**
     * Set created_by
     *
     * @param KekRozsak\FrontBundle\Entity\User $createdBy
     * @return ForumTopic
     */
    public function setCreatedBy(\KekRozsak\FrontBundle\Entity\User $createdBy = null)
    {
        $this->created_by = $createdBy;
        return $this;
    }

    /**
     * Get created_by
     *
     * @return KekRozsak\FrontBundle\Entity\User 
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * Set updated_by
     *
     * @param KekRozsak\FrontBundle\Entity\User $updatedBy
     * @return ForumTopic
     */
    public function setUpdatedBy(\KekRozsak\FrontBundle\Entity\User $updatedBy = null)
    {
        $this->updated_by = $updatedBy;
        return $this;
    }

    /**
     * Get updated_by
     *
     * @return KekRozsak\FrontBundle\Entity\User 
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }

    /**
     * Set topic_group
     *
     * @param KekRozsak\FrontBundle\Entity\ForumTopicGroup $topicGroup
     * @return ForumTopic
     */
    public function setTopicGroup(\KekRozsak\FrontBundle\Entity\ForumTopicGroup $topicGroup = null)
    {
        $this->topic_group = $topicGroup;
        return $this;
    }

    /**
     * Get topic_group
     *
     * @return KekRozsak\FrontBundle\Entity\ForumTopicGroup 
     */
    public function getTopicGroup()
    {
        return $this->topic_group;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $posts;

    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add posts
     *
     * @param KekRozsak\FrontBundle\Entity\ForumPost $posts
     * @return ForumTopic
     */
    public function addForumPost(\KekRozsak\FrontBundle\Entity\ForumPost $posts)
    {
        $this->posts[] = $posts;
        return $this;
    }

    /**
     * Get posts
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }
    /**
     * @var KekRozsak\FrontBundle\Entity\ForumPost
     */
    private $lastPost;


    /**
     * Set lastPost
     *
     * @param KekRozsak\FrontBundle\Entity\ForumPost $lastPost
     * @return ForumTopic
     */
    public function setLastPost(\KekRozsak\FrontBundle\Entity\ForumPost $lastPost = null)
    {
        $this->lastPost = $lastPost;
        return $this;
    }

    /**
     * Get lastPost
     *
     * @return KekRozsak\FrontBundle\Entity\ForumPost 
     */
    public function getLastPost()
    {
        return $this->lastPost;
    }
    /**
     * @var KekRozsak\FrontBundle\Entity\ForumPost
     */
    private $last_post;


}