<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use KekRozsak\FrontBundle\Entity\ForumTopic;
use KekRozsak\SecurityBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="forum_posts")
 */
class ForumPost
{
    /**
     * The ID of the ForumPost
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
     * The User who created this ForumPost
     *
     * @var KekRozsak\SecurityBundle\Entity\User $createBy
     *
     * @ORM\ManyToOne(targetEntity="KekRozsak\SecurityBundle\Entity\User")
     * @ORM\JoinColumn(name="created_by_id")
     */
    protected $createdBy;

    /**
     * Set createdBy
     *
     * @param  KekRozsak\SecurityBundle\Entity\User $createdBy
     * @return ForumPost
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
     * The timestamp when the ForumPost was created
     *
     * @var DateTime $createdAt
     *
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * Set createdAt
     *
     * @param  DateTime  $createdAt
     * @return ForumPost
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        // TODO: Check if null!
        $this->createdAt = $createdAt;
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
     * The content of the ForumPost
     *
     * @var string $text
     *
     * @ORM\Column(type="text", nullable=false)
     */
    protected $text;

    /**
     * Set text
     *
     * @param  string    $text
     * @return ForumPost
     */
    public function setText($text)
    {
        // TODO: Check if empty or null!
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
     * The ForumTopic in which this ForumPost is
     *
     * @var ForumTopic $topic
     *
     * @ORM\ManyToOne(targetEntity="ForumTopic", inversedBy="posts")
     */
    protected $topic;

    /**
     * Set topic
     *
     * @param  ForumTopic $topic
     * @return ForumPost
     */
    public function setTopic(ForumTopic $topic)
    {
        // Set this as the last post of $topic, if later than $topic's current
        // last post
        $this->topic = $topic;
        if (
                !$topic->getLastPost()
                || ($topic->getLastPost()->getCreatedAt() < $this->createdAt)
        ) {
            $topic->setLastPost($this);
        }

        return $this;
    }

    /**
     * Get topic
     *
     * @return ForumTopic
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set createdAt before persisting
     *
     * @ORM\PrePersist
     */
    public function setCreationTime()
    {
        if ($this->createdAt === null) {
            $this->createdAt = new \DateTime('now');
    }
    }
}
