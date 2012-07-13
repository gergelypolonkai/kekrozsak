<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use KekRozsak\FrontBundle\Entity\User;

/**
 * KekRozsak\FrontBundle\Entity\Poll
 * @ORM\Entity
 * @ORM\Table(name="polls")
 */
class Poll
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
     * @ORM\Column(type="datetime", nullable=false, name="created_at")
     */
    private $createdAt;

    /**
     * @var DateTime $updatedAt
     * @ORM\Column(type="datetime", name="updated_at")
     */
    private $updatedAt;

    /**
     * @var text $updateReason
     * @ORM\Column(type="text", name="update_reason")
     */
    private $updateReason;

    /**
     * @var DateTime $pollEnd
     * @ORM\Column(type="datetime", nullable=false, name="poll_end")
     */
    private $pollEnd;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="PollAnswer", mappedBy="answers")
     */
    private $answers;

    /**
     * @var KekRozsak\FrontBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="created_by_id", referencedColumnName="id")
     */
    private $createdBy;

    /**
     * @var KekRozsak\FrontBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="updated_by_id", referencedColumnName="id")
     */
    private $updatedBy;

    public function __construct()
    {
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Poll
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
     * @return Poll
     */
    public function setUpdatedAt($updatedAt = null)
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
     * @return Poll
     */
    public function setUpdateReason($updateReason = null)
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
     * Set pollEnd
     *
     * @param datetime $pollEnd
     * @return Poll
     */
    public function setPollEnd($pollEnd = null)
    {
        $this->pollEnd = $pollEnd;
        return $this;
    }

    /**
     * Get pollEnd
     *
     * @return datetime 
     */
    public function getPollEnd()
    {
        return $this->pollEnd;
    }

    /**
     * Add answers
     *
     * @param KekRozsak\FrontBundle\Entity\PollAnswer $answers
     * @return Poll
     */
    public function addPollAnswer(\KekRozsak\FrontBundle\Entity\PollAnswer $answers)
    {
        $this->answers[] = $answers;
        return $this;
    }

    /**
     * Get answers
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Set createdBy
     *
     * @param KekRozsak\FrontBundle\Entity\User $createdBy
     * @return Poll
     */
    public function setCreatedBy(\KekRozsak\FrontBundle\Entity\User $createdBy)
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
     * @return Poll
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
     * @var text $text
     * @ORM\Column(type="text", nullable=false)
     */
    private $text;

    /**
     * @var boolean $anyoneCanAddAnswers
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $anyoneCanAddAnswers;


    /**
     * Set text
     *
     * @param text $text
     * @return Poll
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
     * Set anyoneCanAddAnswers
     *
     * @param boolean $anyoneCanAddAnswers
     * @return Poll
     */
    public function setAnyoneCanAddAnswers($anyoneCanAddAnswers)
    {
        $this->anyoneCanAddAnswers = $anyoneCanAddAnswers;
        return $this;
    }

    /**
     * Get anyoneCanAddAnswers
     *
     * @return boolean 
     */
    public function getAnyoneCanAddAnswers()
    {
        return $this->anyoneCanAddAnswers;
    }
}
