<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

use KekRozsak\SecurityBundle\Entity\User;
use KekRozsak\FrontBundle\Entity\Group;

/**
 * KekRozsak\FrontBundle\Entity\Document
 * @ORM\Entity
 * @ORM\Table(name="documents")
 * @DoctrineAssert\UniqueEntity(fields={"title"}, message="Ilyen című dokumentum már létezik. Kérlek válassz másikat!")
 * @DoctrineAssert\UniqueEntity(fields={"slug"}, message="Ilyen című dokumentum már létezik. Kérlek válassz másikat!")
 */
class Document
{
    public function __construct()
    {
        $this->groups = new ArrayCollection();
    }

    /**
     * The ID of the Document
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
     * The title of the Document
     *
     * @var string $title
     *
     * @ORM\Column(type="string", length=150, unique=true, nullable=false)
     * @Assert\NotBlank()
     */
    protected $title;

    /**
     * Set title
     *
     * @param  string   $title
     * @return Document
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
     * The slugified title of this Document
     *
     * @var string $slug
     *
     * @ORM\Column(type="string", length=150, unique=true, nullable=false)
     * @Assert\NotBlank()
     */
    protected $slug;

    /**
     * Set slug
     *
     * @param  string   $slug
     * @return Document
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
     * The User who created this Document
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
     * @return Document
     */
    public function setCreatedBy(User $createdBy)
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
     * The timestamp when the Document was created
     *
     * @var DateTime $createdat
     *
     * @ORM\Column(type="datetime", nullable=false, name="created_at")
     */
    protected $createdAt;

    /**
     * Set createdAt
     *
     * @param  DateTime $createdAt
     * @return Document
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
     * The content of the Document
     *
     * @var string $content
     *
     * @ORM\Column(type="text", nullable=false)
     */
    protected $content;

    /**
     * Set content
     *
     * @param  string   $content
     * @return Document
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
     public function getContent()
    {
        return $this->content;
    }

    /**
     * @var Doctrine\Common\Collections\ArrayCollection $groups
     * @ORM\ManyToMany(targetEntity="KekRozsak\FrontBundle\Entity\Group", inversedBy="documents")
     * @ORM\JoinTable(name="group_document", joinColumns={
     *     @ORM\JoinColumn(name="document_id", referencedColumnName="id"),
     * }, inverseJoinColumns={
     *     @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     * })
     */
    protected $groups;

    /**
     * Add a group
     *
     * @param  KekRozsak\FrontBundle\Entity\Group $group
     * @return Document
     */
    public function addGroup(Group $group)
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
     * The User who last updated the Document
     *
     * @var KekRozsak\SecurityBundle\Entity\User $updatedBy
     *
     * @ORM\ManyToOne(targetEntity="KekRozsak\SecurityBundle\Entity\User")
     */
    protected $updatedBy;

    /**
     * Set updatedBy
     *
     * @param  KekRozsak\SecurityBundle\Entity\User $updatedBy
     * @return Document
     */
    public function setUpdatedBy(User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return KekRozsak\SecurityBundle\Entity\User
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * The timestamp the Document was last updated
     *
     * @var DateTime $updatedAt
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * Set updatedAt
     *
     * @param  DateTime $updatedAt
     * @return Document
     */
    public function setUpdatedAt(\DateTime $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @var string updateReason
     * @ORM\Column(type="text", nullable=true)
     */
    protected $updateReason;

    /**
     * Set updateReason
     *
     * @param  string   $updateReason
     * @return Document
     */
    public function setUpdateReason($updateReason = null)
    {
        $this->updateReason = $updateReason;

        return $this;
    }

    /**
     * Get updateReason
     *
     * @return string
     */
    public function getUpdateReason()
    {
        return $this->updateReason;
    }
}
