<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use KekRozsak\FrontBundle\Entity\User;
use KekRozsak\FrontBundle\Entity\Poll;

/**
 * KekRozsak\FrontBundle\Entity\PollAnswer
 * @ORM\Entity
 * @ORM\Table(name="poll_answers")
 */
class PollAnswer
{
    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var DateTime $createdAt
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var DateTime $updatedAt
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var text $updateReason
     * @ORM\Column(type="text", name="update_reason", nullable=true)
     */
    private $updateReason;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="User", inversedBy="pollVotes")
     */
    private $voters;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="created_by_id")
     */
    private $createdBy;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="updated_by_id")
     */
    private $updatedBy;

    /**
     * @var poll
     * @ORM\ManyToOne(targetEntity="Poll", inversedBy="answers")
     */
    private $poll;

    public function __construct()
    {
        $this->voters = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set createdAt
     *
     * @param datetime $createdAt
     * @return PollAnswer
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
     * @return PollAnswer
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
     * @return PollAnswer
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
     * Add voters
     *
     * @param User $voters
     * @return PollAnswer
     */
    public function addVoters(User $voters)
    {
        $this->voters[] = $voters;
        return $this;
    }

    /**
     * Get voters
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getVoters()
    {
        return $this->voters;
    }

    /**
     * Set createdBy
     *
     * @param User $createdBy
     * @return PollAnswer
     */
    public function setCreatedBy(User $createdBy = null)
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * Get createdBy
     *
     * @return User 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param User $updatedBy
     * @return PollAnswer
     */
    public function setUpdatedBy(User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return User 
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set poll
     *
     * @param Poll $poll
     * @return PollAnswer
     */
    public function setPoll(Poll $poll = null)
    {
        $this->poll = $poll;
        return $this;
    }

    /**
     * Get poll
     *
     * @return Poll 
     */
    public function getPoll()
    {
        return $this->poll;
    }
    /**
     * @var string $text
     * @ORM\Column(type="text", nullable=false)
     */
    private $text;


    /**
     * Set text
     *
     * @param string $text
     * @return PollAnswer
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
}
