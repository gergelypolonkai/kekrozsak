<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

use KekRozsak\SecurityBundle\Entity\User;
use KekRozsak\FrontBundle\Entity\Group;

/**
 * @ORM\Entity
 * @ORM\Table(name="events")
 *
 * @DoctrineAssert\UniqueEntity(fields={"startDate", "slug"})
 * @DoctrineAssert\UniqueEntity(fields={"startDate", "title"})
 */
class Event
{
    /**
     * The ID of the Event
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
     * The User who created the Event
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
     * @param KekRozsak\SecurityBundle\Entity\User $createdBy
     * @return Event
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
     * The date on which the Event starts
     *
     * @var DateTime $startDate
     *
     * @ORM\Column(type="date", nullable=true, name="start_date", nullable=false)
     */
    protected $startDate;
	
    /**
     * Set startDate
     *
     * @param DateTime $startDate
     * @return Event
     */
    public function setStartDate(\DateTime $startDate = null)
    {
        $this->startDate = $startDate;
        return $this;
    }
	
    /**
     * Get startDate
     *
     * @return DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }
	
    /**
     * The date on which the Event ends. May be null if same as $startDate
     *
     * @var DateTime $endDate
     *
     * @ORM\Column(type="date", nullable=true, name="end_date")
     */
    protected $endDate;

    /**
     * Set endDate
     *
     * @param DateTime $endDate
     * @return Event
     */
    public function setEndDate(\DateTime $endDate = null)
    {
        // TODO: Check if endDate is later than startDate
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * Get endDate
     *
     * @return DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * An ArrayCollection of Users who wish to attend on this Event
     *
     * @var Doctrine\Common\Collections\ArrayCollection $attendees
     *
     * @ORM\ManyToMany(targetEntity="KekRozsak\SecurityBundle\Entity\User")
     * @ORM\JoinTable(name="event_attendees")
     */
    protected $attendees;

    /**
     * Add attendee
     *
     * @param KekRozsak\SecurityBundle\Entity\User $attendee
     * @return Event
     */
    public function addAttendee(User $attendee)
    {
        $this->attendees[] = $attendee;
        return $this;
    }

    /**
     * Get all attendees
     *
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getAttendees()
    {
        return $this->attendees;
    }

    /**
     * Check if a user is attending
     *
     * @param KekRozsak\SecurityBundle\Entity\User $user
     * @return boolean
     */
    public function isAttending(User $user)
    {
        $users = $this->attendees->filter(function ($attendee) use ($user)
        {
            if ($attendee == $user) {
                return true;
            }
        });

        return ($users->count() != 0);
    }

    /**
     * The title of the Event
     *
     * @var string $title
     *
     * @ORM\Column(type="string", length=150)
     *
     * @Assert\NotBlank()
     */
    protected $title;

    /**
     * Set title
     *
     * @param string $title
     * @return Event
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
     * Slugified title of the event
     *
     * @var string $slug
     *
     * @ORM\Column(type="string", length=150)
     *
     * @Assert\NotBlank()
     */
    protected $slug;

    /**
     * Set slug
     *
     * @param string $slug
     * @return Event
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
     * Description of the Event
     *
     * @var string $description
     *
     * @ORM\Column(type="text")
     *
     * @Assert\NotBlank()
     */
    protected $description;

    /**
     * Set description
     *
     * @param string $description
     * @return Event
     */
    public function setDescription($description)
    {
        // TODO: Check if empty!
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @var KekRozsak\FrontBundle\Entity\Group $group
     *
     * @ORM\ManyToOne(targetEntity="KekRozsak\FrontBundle\Entity\Group")
     */
     protected $group;

    /**
     * Set group
     *
     * @param KekRozsak\FrontBundle\Entity\Group $group
     * @return Event
     */
    public function setGroup(Group $group = null)
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
     * TRUE if the Event is cancelled
     *
     * @var boolean $cancelled
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $cancelled;

    /**
     * Set cancelled
     *
     * @param boolean $cancelled
     * @return Event
     */
    public function setCancelled($cancelled = false)
    {
        // TODO: Check if parameter is boolean
        $this->cancelled = $cancelled;
        return $this;
    }

    /**
     * Get cancelled
     *
     * @return boolean
     */
    public function getCancelled()
    {
        return $this->cancelled;
    }

    /**
     * The time when the Event starts
     *
     * @var DateTime $startTime
     *
     * @ORM\Column(type="time", nullable=false, name="start_time")
     */
    protected $startTime;

    /**
     * Set startTime
     *
     * @param DateTime $startTime
     * @return Event
     */
    public function setStartTime(\DateTime $startTime)
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * Get startTime
     *
     * @return DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * The time when the Event ends
     *
     * @var DateTime $endTime
     *
     * @ORM\Column(type="time", nullable=true, name="end_time")
     */
    protected $endTime;

     /**
     * Set endTime
     *
     * @param DateTime $endTime
     * @return Event
     */
    public function setEndTime(\DateTime $endTime = null)
    {
        // TODO: Check if endTime is later than startDate + startTime
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * Get endTime
     *
     * @return DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Check if an event will go on a specific date
     *
     * @param DateTime $date
     * @return boolean
     */
    public function isOnDate(\DateTime $date)
    {
        $date->setTime(0, 0, 0);

        return (
            (
                ($this->startDate == $date)
                && ($this->endDate === null)
            )
            || (
                ($this->startDate <= $date)
                && ($this->endDate >= $date)
            )
        );
    }

    /**
     * Check if the event happened before a given date
     *
     * @param DateTime $date
     * @return boolean
     */
    public function isPast(\DateTime $date = null)
    {
        if ($date === null) {
            $date = new \DateTime('now');
        }

        return ($this->endDate < $date);
    }
}
