<?php

namespace KekRozsak\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;

use KekRozsak\SecurityBundle\Entity\User;

/**
 * KekRozsak\SecurityBundle\Entity\Role
 *
 * @ORM\Entity
 * @ORM\Table(name="roles")
 */
class Role implements RoleInterface
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
	 * @var string name
	 * @ORM\Column(type="string", length=50, unique=true, nullable=false)
	 */
	protected $name;

	/**
	 * Set name
	 *
	 * @param string $name
	 * @return Role
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
	 * @var boolean $default
	 * @ORM\Column(type="boolean", nullable=false)
	 */
	protected $default;

	/**
	 * Set default
	 *
	 * @param boolean $default
	 */
	public function setDefault($default)
	{
		$this->default = $default;
		return $this;
	}

	/**
	 * @var text description
	 * @ORM\Column(type="string", length=150, nullable=true)
	 */
	protected $description;

	/**
	 * Set description
	 *
	 * @param string $description
	 * @return Role
	 */
	public function setDescription($description = null)
	{
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

	/* Here comes the rest of RoleInterface's implementation */

	public function getRole()
	{
		return $this->name;
	}

	/**
	 * Short description
	 *
	 * @var string shortDescription
	 *
	 * @ORM\Column(type="string", length=50, nullable=false, unique=true, name="short_description")
	 */
	protected $shortDescription;

	/**
	 * Set shortDescription
	 *
	 * @param string $shortDescription
	 * @return Role
	 */
	public function setShortDescription($shortDescription)
	{
		$this->shortDescription = $shortDescription;
		return $this;
	}

	/**
	 * Get shortDescription
	 *
	 * @return string
	 */
	public function getShortDescription()
	{
		return $this->shortDescription;
	}

	/**
	 * List of inherited Roles
	 *
	 * @ORM\ManyToMany(targetEntity="Role", fetch="LAZY")
	 * @ORM\JoinTable(name="role_hierarchy", joinColumns={
	 *     @ORM\JoinColumn(name="parent_role_id", referencedColumnName="id")
	 * }, inverseJoinColumns={
	 *     @ORM\JoinColumn(name="child_role_id", referencedColumnName="id")
	 * })
	 */
	protected $inheritedRoles;

	/**
	 * Get all inherited roles
	 *
	 * @return Doctrine\Common\Collections\ArrayCollection
	 */
	public function getInheritedRoles()
	{
		return $this->inheritedRoles;
	}
}

