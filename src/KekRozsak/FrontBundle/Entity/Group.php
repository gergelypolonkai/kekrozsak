<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KekRozsak\FrontBundle\Entity\Group
 * @ORM\Entity
 * @ORM\Table(name="groups")
 */
class Group
{
    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $name
     * @ORM\Column(type="string", length=50, nullable=false, unique=true)
     */
    private $name;

    /**
     * @var string $slug
     * @ORM\Column(type="string", length=50, nullable=false, unique=true)
     */
    private $slug;

    /**
     * @var datetime $createdAt
     * @ORM\Column(type="datetime", name="created_at", nullable=false)
     */
    private $createdAt;

    /**
     * @var datetime $updatedAt
     * @ORM\Column(type="datetime", name="updated_at", nullable=true)
     */
    private $updatedAt;

    /**
     * @var text $updateReason
     * @ORM\Column(type="text", name="update_reason", nullable=true)
     */
    private $updateReason;

    /**
     * @var KekRozsak\FrontBundle\Entity\User $createdBy
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $createdBy;

    /**
     * @var KekRozsak\FrontBundle\Entity\User $updatedBy
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $updatedBy;

    /**
     * @var KekRozsak\FrontBundle\Entity\User $leader
     * @ORM\ManyToOne(targetEntity="User", inversedBy="ledGroups")
     */
    private $leader;

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
     * Set name
     *
     * @param string $name
     * @return Group
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Group
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
     * Set createdAt
     *
     * @param datetime $createdAt
     * @return Group
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param datetime $updatedAt
     * @return Group
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set updateReason
     *
     * @param text $updateReason
     * @return Group
     */
    public function setUpdateReason($updateReason)
    {
        $this->updateReason = $updateReason;
        return $this;
    }

    /**
     * Get updateReason
     *
     * @return text 
     */
    public function getUpdateReason()
    {
        return $this->updateReason;
    }

    /**
     * Set createdBy
     *
     * @param KekRozsak\FrontBundle\Entity\User $createdBy
     * @return Group
     */
    public function setCreatedBy(\KekRozsak\FrontBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * Get createdBy
     *
     * @return KekRozsak\FrontBundle\Entity\User 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param KekRozsak\FrontBundle\Entity\User $updatedBy
     * @return Group
     */
    public function setUpdatedBy(\KekRozsak\FrontBundle\Entity\User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return KekRozsak\FrontBundle\Entity\User 
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set leader
     *
     * @param KekRozsak\FrontBundle\Entity\User $leader
     * @return Group
     */
    public function setLeader(\KekRozsak\FrontBundle\Entity\User $leader = null)
    {
        $this->leader = $leader;
        return $this;
    }

    /**
     * Get leader
     *
     * @return KekRozsak\FrontBundle\Entity\User 
     */
    public function getLeader()
    {
        return $this->leader;
    }

    /**
     * @var ArrayCollection $documents
     * @ORM\ManyToMany(targetEntity="Document", inversedBy="groups")
     */
    private $documents;
}
