<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KekRozsak\FrontBundle\Entity\ForumTopicGroup
 */
class ForumTopicGroup
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
     * @return ForumTopicGroup
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
     * @return ForumTopicGroup
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
     * @return ForumTopicGroup
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
     * @return ForumTopicGroup
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
     * @return ForumTopicGroup
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
     * @return ForumTopicGroup
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
     * @return ForumTopicGroup
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
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $topic;

    public function __construct()
    {
        $this->topic = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add topic
     *
     * @param KekRozsak\FrontBundle\Entity\ForumTopic $topic
     * @return ForumTopicGroup
     */
    public function addForumTopic(\KekRozsak\FrontBundle\Entity\ForumTopic $topic)
    {
        $this->topic[] = $topic;
        return $this;
    }

    /**
     * Get topic
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTopic()
    {
        return $this->topic;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $topics;


    /**
     * Get topics
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTopics()
    {
        return $this->topics;
    }
}