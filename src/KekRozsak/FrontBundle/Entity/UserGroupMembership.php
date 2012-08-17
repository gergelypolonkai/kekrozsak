<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use KekRozsak\SecurityBundle\Entity\User;
use KekRozsak\FrontBundle\Entity\Group;

/**
 * KekRozsak\FrontBundle\Entity\UserGroupMembership
 * @ORM\Entity
 * @ORM\Table(name="user_group_memberships", uniqueConstraints={
 *     @ORM\UniqueConstraint(columns={"user_id", "group_id"})
 * })
 */
class UserGroupMembership
{
    public function __construct(User $user, Group $group)
    {
        $this->setUser($user);
        $this->setGroup($group);
        $this->setMembershipRequestedAt(new \DateTime('now'));
    }

    /**
     * The ID of the UserGroupMembership
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
     * The User this membership is applied to
     *
     * @var KekRozsak\SecurityBundle\Entity\User $user
     *
     * @ORM\ManyToOne(targetEntity="KekRozsak\SecurityBundle\Entity\User", inversedBy="groups")
     * @ORM\JoinColumn(name="user_id")
     */
    protected $user;

    /**
     * Set user
     *
     * @param  KekRozsak\SecurityBundle\Entity\User $user
     * @return UserGroupMembership
     */
    public function setUser(User $user)
    {
        // TODO: Check if not null!
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return KekRozsak\SecurityBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * The Group this membership is applied to
     *
     * @var KekRozsak\FrontBundle\Entity\Group
     *
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="members")
     * @ORM\JoinColumn(name="group_id")
     */
    protected $group;

    /**
     * Set group
     *
     * @param KekRozsak\FrontBundle\Entity\Group
     * @return UserGroupMembership
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
     * The timestamp when $user requested membership in $group
     *
     * @var DateTime $membershipRequestedAt
     *
     * @ORM\Column(type="datetime", name="membership_requested_at")
     */
    protected $membershipRequestedAt;

    /**
     * Set membershipRequestedAt
     *
     * @param  DateTime            $membershipRequestedAt
     * @return UserGroupMembership
     */
    public function setMembershipRequestedAt(\DateTime $membershipRequestedAt)
    {
        // TODO: Check if null!
        $this->membershipRequestedAt = $membershipRequestedAt;

        return $this;
    }

    /**
     * Get membershipRequestedAt
     *
     * @return DateTime
     */
    public function getMembershipRequestedAt()
    {
        return $this->membershipRequestedAt;
    }

    /**
     * The timestamp when $user's membership was accepted
     *
     * @var DateTime membershipAcceptedAt
     *
     * @ORM\Column(type="datetime", nullable=true, name="membership_accepted_at")
     */
    protected $membershipAcceptedAt;

    /**
     * Set membershipAcceptedAt
     *
     * @param  DateTime            $membershipAcceptedAt
     * @return UserGroupMembership
     */
    public function setMembershipAcceptedAt(\DateTime $membershipAcceptedAt = null)
    {
        $this->membershipAcceptedAt = $membershipAcceptedAt;

        return $this;
    }

    /**
     * Get membershipAcceptedAt
     *
     * @return DateTime
     */
    public function getMembershipAcceptedAt()
    {
        return $this->membershipAcceptedAt;
    }

    /**
     * The User who accepted $user's membership
     *
     * @var KekRozsak\SecurityBundle\Entity\User $membershipAcceptedBy
     *
     * @ORM\ManyToOne(targetEntity="KekRozsak\SecurityBundle\Entity\User")
     * @ORM\JoinColumn(name="membership_accepted_by_id")
     */
    protected $membershipAcceptedBy;

    /**
     * Set membershipAcceptedBy
     *
     * @param KekRozsak\SecurityBundle\Entity\User
     * @return UserGroupMembership
     */
    public function setMembershipAcceptedBy(User $membershipAcceptedBy = null)
    {
        $this->membershipAcceptedBy = $membershipAcceptedBy;

        return $this;
    }

    /**
     * Get membershipAcceptedBy
     *
     * @return KekRozsak\SecurityBundle\Entity\User
     */
    public function getMembershipAcceptedBy()
    {
        return $this->membershipAcceptedBy;
    }
}
