<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

use KekRozsak\SecurityBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="forum_topics", uniqueConstraints={
 *     @ORM\UniqueConstraint(columns={"topic_group_id", "title"}),
 *     @ORM\UniqueConstraint(columns={"topic_group_id", "slug"})
 * })
 * @DoctrineAssert\UniqueEntity(fields={"topicGroup", "title"}, message="Ilyen nevű téma már létezik ebben a témakörben. Kérlek válassz másikat!")
 * @DoctrineAssert\UniqueEntity(fields={"topicGroup", "slug"}, message="Ilyen nevű téma már létezik ebben a témakörben. Kérlek válassz másikat!")
 */
class ForumTopic
{
    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * The ID of the ForumTopic
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
        return  $this->id;
    }

    /**
     * The User who created this ForumTopic
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
     * @param KekRozsak\SecurityBundle\Entity\User
     * @return ForumTopic
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
     * The timestamp when the ForumTopic was created
     *
     * @var DateTime $createdAt
     *
     * @ORM\Column(type="datetime", nullable=false, name="created_at")
     */
    protected $createdAt;

    /**
     * Set createdAt
     *
     * @param  DateTime   $createdAt
     * @return ForumTopic
     */
    public function setCreatedAt(\DateTime $createdAt)
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
     * The ForumTopicGroup to which this ForumTopic belongs
     *
     * @var ForumTopicGroup $topicGroup
     *
     * @ORM\ManyToOne(targetEntity="ForumTopicGroup", inversedBy="topics")
     * @ORM\JoinColumn(name="topic_group_id", nullable=false)
     */
    protected $topicGroup;

    /**
     * Set topicGroup
     *
     * @param  ForumTopicGroup $topicGroup
     * @return ForumTopic
     */
    public function setTopicGroup(ForumTopicGroup $topicGroup)
    {
        // TODO: Check if not null!
        $this->topicGroup = $topicGroup;

        return $this;
    }

    /**
     * Get topicGroup
     *
     * @return ForumTopicGroup
     */
    public function getTopicGroup()
    {
        return $this->topicGroup;
    }

    /**
     * The slugified title of the ForumTopic
     *
     * @var string $slug
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $slug;

    /**
     * Set slug
     *
     * @param  string     $slug
     * @return ForumTopic
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
     * The title of the ForumTopic
     *
     * @var string $title
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $title;

    /**
     * Set title
     *
     * @param  string     $title
     * @return ForumTopic
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
     * The last Post of this ForumTopic, is any
     *
     * @var ForumPost $lastPost
     *
     * @ORM\OneToOne(targetEntity="ForumPost", cascade={"persist"})
     * @ORM\JoinColumn(name="last_post_id")
     */
    protected $lastPost;

    /**
     * Set lastPost
     *
     * @param  ForumPost  $lastPost
     * @return ForumTopic
     */
    public function setLastPost($lastPost = null)
    {
        $this->lastPost = $lastPost;
    }

    /**
     * Get lastPost
     *
     * @return ForumPost
     */
    public function getLastPost()
    {
        return $this->lastPost;
    }

    /**
     * The list of all the ForumPosts in this topic
     *
     * @var ArrayCollection $topics;
     *
     * @ORM\OneToMany(targetEntity="ForumPost", mappedBy="topic", fetch="LAZY")
     */
     protected $posts;

    /**
     * Add post
     *
     * @param  ForumPost  $post
     * @return ForumTopic
     */
    public function addPost(ForumPost $post)
    {
        // TODO: Check if null!
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Get posts
     *
     * @return ArrayCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
