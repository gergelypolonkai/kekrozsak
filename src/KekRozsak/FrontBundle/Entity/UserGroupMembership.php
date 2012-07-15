<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use KekRozsak\SecurityBundle\Entity\User;

/**
 * KekRozsak\FrontBundle\Entity\UserGroupMembership
 * @ORM\Entity
 * @ORM\Table(name="user_group_memberships", uniqueConstraints={
 *     @ORM\UniqueConstraint(columns={"user_id", "group_id"})
 * })
 */
class UserGroupMembership
{
	/**
	 * @var integer $id
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
	 * @var KekRozsak\SecurityBundle\Entity\User $user
	 * @ORM\ManyToOne(targetEntity="KekRozsak\SecurityBundle\Entity\User", inversedBy="groups")
	 * @ORM\JoinColumn(name="user_id")
	 */
	protected $user;

	/**
	 * Set user
	 *
	 * @param KekRozsak\SecurityBundle\Entity\User $user
	 * @return UserGroupMembership
	 */
	public function setUser(\KekRozsak\SecurityBundle\Entity\User $user)
	{
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
	 * @var KekRozsak\FrontBundle\Entity\Group
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
	public function setGroup(\KekRozsak\FrontBundle\Entity\Group $group)
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
}
