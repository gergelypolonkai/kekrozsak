<?php
namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use KekRozsak\SecurityBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="blog_posts")
 */
class BlogPost
{
    /**
     * The ID of the BlogPost
     *
     * var integer $id
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
     * True if the BlogPost is published. If not, only the author and the
     * administrators can see it.
     *
     * @var boolean $published
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $published;

    /**
     * Set published
     *
     * @param  boolean $published
     * @return BlogPost
     */
    public function setPublished($published)
    {
        // TODO: Check if parameter is boolean!
        $this->published = $published;
        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function isPublished()
    {
        return $this->published;
    }
    
    /**
     * The Group which this BlogPost is associated with
     *
     * @var KekRozsak\FrontBundle\Entity\Group $group
     *
     * @ORM\ManyToOne(targetEntity="KekRozsak\FrontBundle\Entity\Group")
     * @ORM\JoinColumn(name="group_id", nullable=true)
     */
    protected $group;

    /**
     * Set group
     *
     * @param  KekRozsak\FrontBundle\Entity\Group $group
     * @return BlogPost
     */
    public function setGroup(Group $group)
    {
        $this->group = $group;
        return $this;
    }

    /**
     * Get group
     *
     * @return KekRozsak\FrontBundle\Entity\Group
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * The title of the BlogPost
     *
     * @var strinct $title
     *
     * @ORM\Column(type="string", length=150, nullable=false)
     */
    protected $title;

    /**
     * Set title
     *
     * @param  string $title
     * @return BlogPost
     */
    public function setTitle($title)
    {
        // TODO: Check if not null nor empty!
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
     * The slugified title of the BlogPost
     *
     * @var string $slug
     *
     * @ORM\Column(type="string", length=150, nullable=false)
     */
    protected $slug;

    /**
     * Set slug
     *
     * @param  string $slug
     * @return BlogPost
     */
    public function setSlug($slug)
    {
        // TODO: Check if not null nor empty!
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
     * The User who created this BlogPost
     *
     * @var KekRozsak\SecurityBundle\Entity\User $createdBy
     *
     * @ORM\ManyToOne(targetEntity="KekRozsak\SecurityBundle\Entity\User")
     * @ORM\JoinColumn(name="created_by_id", nullable=false)
     */
    protected $createdBy;

    /**
     * Set createdBy
     *
     * @param  KekRozsak\SecurityBundle\Entity\User $createdBy
     * @return BlogPost
     */
    public function setCreatedBy(User $createdBy)
    {
        // TODO: Check if not null!
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
        return $this->createdBy();
    }

    /**
     * The timestamp when this BlogPost was created
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
     * @return BlogPost
     */
    public function setCreatedAt(\DataTime $createdAt)
    {
        // TODO: Check if not null!
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
     * The User who last updated this BlogPost, or NULL if it is unmodified
     *
     * @var KekRozsak\SecurityBundle\Entity\User $updatedBy
     *
     * @ORM\ManyToOne(targetEntity="KekRozsak\SecurityBundle\Entity\User")
     * @ORM\JoinColumn(name="updated_by_id", nullable=true)
     */
    protected $updatedBy;

    /**
     * Set updatedBy
     *
     * @param  KekRozsak\SecurityBundle\Entity\User $updatedBy
     * @return BlogPost
     */
    public function setUpdatedBy(User $updatedBy)
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
     * The timestamp when this BlogPost was last modified, or null if it is not
     * modified
     *
     * @var DateTime $updatedAt
     *
     * @ORM\Column(type="datetime", name="updated_at", nullable=true)
     */
    protected $updatedAt;

    /**
     * Set updatedAt
     *
     * @param  DateTime $updatedAt
     * @return BlogPost
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * The reason of the last update, or null if the object is not modified
     *
     * @var string $updateReason
     *
     * @ORM\Column(type="string", length=255, name="update_reason", nullable=true)
     */
    protected $updateReason;

    /**
     * Set updateReason
     *
     * @param  string $updateReason
     * @return BlogPost
     */
    public function setUpdateReason($updateReason)
    {
        if (trim($updateReason) == '') {
            $updateReason = null;
        }
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

    /**
     * The content of this BlogPost
     *
     * @var string $content
     *
     * @ORM\Column(type="text", nullable=false)
     */
    protected $content;

    /**
     * Set content
     *
     * @param  string $content
     * @return BlogPost
     */
    public function setContent($content)
    {
        // TODO: Check if not null nor empty!
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
}
