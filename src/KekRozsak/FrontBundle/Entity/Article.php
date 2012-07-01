<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KekRozsak\FrontBundle\Entity\Article
 */
class Article
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
     * @var text $text
     */
    private $text;

    /**
     * @var string $source
     */
    private $source;

    /**
     * @var DateTime $created_at
     */
    private $created_at;

    /**
     * @var DateTime $updated_at
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
     * @return Article
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
     * @return Article
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
     * Set text
     *
     * @param text $text
     * @return Article
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
     * Set source
     *
     * @param string $source
     * @return Article
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set created_at
     *
     * @param DateTime $createdAt
     * @return Article
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->created_at = $createdAt;
        return $this;
    }

    /**
     * Get created_at
     *
     * @return DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param DateTime $updatedAt
     * @return Article
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updated_at = $updatedAt;
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set update_reason
     *
     * @param text $updateReason
     * @return Article
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
     * @return Article
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
     * @return Article
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
}