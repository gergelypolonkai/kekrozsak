<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use KekRozsak\SecurityBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="news")
 */
class News
{
    /**
     * The ID of this News
     *
     * @var integer $id
     *
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
     * The title of this News
     *
     * @var string $title
     *
     * @ORM\Column(type="string", length=100)
     */
    protected $title;

    /**
     * Set title
     *
     * @param  string $title
     * @return News
     */
    public function setTitle($title)
    {
        // TODO: Check if empty or null!
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
     * The contents of this News
     *
     * @var string $text
     *
     * @ORM\Column(type="text", nullable=false)
     */
    protected $text;

    /**
     * Set text
     *
     * @param  string $text
     * @return News
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * The timestamp when this News was created
     *
     * @var DateTime $createdAt
     *
     * @ORM\Column(type="datetime", name="created_at", nullable=false)
     */
    protected $createdAt;

    /**
     * Set createdAt
     *
     * @param  DateTime $createdAt
     * @return News
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        // TODO: Check if null!
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
     * The User who created this News item
     *
     * @var KekRozsak\SecurityBundle\Entity\User $createdBy
     *
     * @ORM\ManyToOne(targetEntity="KekRozsak\SecurityBundle\Entity\User")
     * @ORM\JoinColumn(name="created_by_id")
     */
    protected $createdBy;

    /**
     * Set createdBy
     *
     * @param  KekRozsak\SecurityBundle\Entity\User $createdBy
     * @return News
     */
    public function setCreatedBy(User $createdBy)
    {
        // TODO: Check if null!
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
     * TRUE if this News item is public
     *
     * @var boolean $public
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $public;

    /**
     * Set public
     *
     * @param  boolean $public
     * @return News
     */
    public function setPublic($public)
    {
        // TODO: Check if parameter is boolean!
        $this->public = $public;

        return $this;
    }

    /**
     * Get public
     *
     * @return boolean
     */
    public function isPublic()
    {
        return $this->public;
    }
}
