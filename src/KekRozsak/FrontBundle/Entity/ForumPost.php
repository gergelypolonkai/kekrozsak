<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KekRozsak\FrontBundle\Entity\ForumPost
 */
class ForumPost
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var datetime $created_at
     */
    private $created_at;

    /**
     * @var datetime $updated_at
     */
    private $updated_at;

    /**
     * @var string $update_reason
     */
    private $update_reason;

    /**
     * @var text $text
     */
    private $text;

    /**
     * @var KekRozsak\FrontBundle\Entity\User
     */
    private $created_by;

    /**
     * @var KekRozsak\FrontBundle\Entity\User
     */
    private $updated_by;

    /**
     * @var KekRozsak\FrontBundle\Entity\ForumTopic
     */
    private $topic;


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
     * Set created_at
     *
     * @param datetime $createdAt
     * @return ForumPost
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
     * @return ForumPost
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
     * @param string $updateReason
     * @return ForumPost
     */
    public function setUpdateReason($updateReason)
    {
        $this->update_reason = $updateReason;
        return $this;
    }

    /**
     * Get update_reason
     *
     * @return string 
     */
    public function getUpdateReason()
    {
        return $this->update_reason;
    }

    /**
     * Set text
     *
     * @param text $text
     * @return ForumPost
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Get text
     *
     * @return text 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set created_by
     *
     * @param KekRozsak\FrontBundle\Entity\User $createdBy
     * @return ForumPost
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
     * @return ForumPost
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
     * Set topic
     *
     * @param KekRozsak\FrontBundle\Entity\ForumTopic $topic
     * @return ForumPost
     */
    public function setTopic(\KekRozsak\FrontBundle\Entity\ForumTopic $topic = null)
    {
        $this->topic = $topic;
        return $this;
    }

    /**
     * Get topic
     *
     * @return KekRozsak\FrontBundle\Entity\ForumTopic 
     */
    public function getTopic()
    {
        return $this->topic;
    }
}