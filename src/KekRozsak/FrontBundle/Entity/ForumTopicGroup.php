<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

use KekRozsak\SecurityBundle\Entity\User;

/**
 * KekRozsak\FrontBundle\Entity\ForumTopicGroup
 * @ORM\Entity
 * @ORM\Table(name="forum_topic_groups")
 * @DoctrineAssert\UniqueEntity(fields={"title"}, message="Ilyen nevű témakör már létezik. Kérlek válassz másikat!")
 * @DoctrineAssert\UniqueEntity(fields={"slug"}, message="Ilyen nevű témakör már létezik. Kérlek válassz másikat!")
 */
class ForumTopicGroup
{
    /**
     * The ACL class OID for this class
     *
     * @const ACL_OID
     */
    const ACL_OID = 'forumTopicGroupClass';

    public function __construct()
    {
        $this->topics = new ArrayCollection();
    }

    /**
     * The ID of the ForumTopicGroup
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
     * The User who created this ForumTopicGroup
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
     * @return ForumTopicGroup
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
     * The timestamp when this ForumTopicGroup was created
     *
     * @var DateTime $createdAt
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * Set createdAt
     *
     * @param  DateTime        $createdAt
     * @return ForumTopicGroup
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
     * The slugified title of this ForumTopicGroup
     *
     * @var string $slug
     *
     * @ORM\Column(type="string", length=100, nullable=false, unique=true)
     */
    protected $slug;

    /**
     * Set slug
     *
     * @param  string          $slug
     * @return ForumTopicGroup
     */
    public function setSlug($slug)
    {
        // TODO: Check if empty or null!
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
     * The title of this ForumTopicGroup
     *
     * @var string $title
     *
     * @ORM\Column(type="string", length=100, nullable=false, unique=true)
     * @Assert\NotBlank()
     */
    protected $title;

    /**
     * Set title
     *
     * @param  string          $title
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
     * The ArrayCollection of ForumTopics that belong to this ForumTopicGroup
     *
     * @var ArrayCollection $topics
     *
     * @ORM\OneToMany(targetEntity="ForumTopic", mappedBy="topicGroup")
     */
    protected $topics;

    /**
     * Add topic
     *
     * @param  ForumTopic      $topic
     * @return ForumTopicGroup
     */
    public function addTopic(ForumTopic $topic)
    {
        // TODO: Check if null!
        $this->topics[] = $topic;

        return $this;
    }

    /**
     * Get topics
     *
     * @return ArrayCollection
     */
    public function getTopics()
    {
        return $this->topics;
    }
}
