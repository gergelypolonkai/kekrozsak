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
	 * @var boolean $admin
	 * @ORM\Column(type="boolean", nullable=false)
	 */
	protected $admin;

	/**
	 * Set admin
	 *
	 * @param boolean $admin
	 * @return Role
	 */
	public function setAdmin($admin)
	{
		$this->admin = $admin;
		return $this;
	}

	/**
	 * Get admin
	 *
	 * @return boolean
	 */
	public function isAdmin()
	{
		return $this->admin;
	}

	/**
	 * @var boolean $superadmin
	 * @ORM\Column(type="boolean", nullable=false)
	 */
	protected $superAdmin;

	/**
	 * Set superadmin
	 *
	 * @param boolean $superadmin
	 * @return Role
	 */
	public function setSuperadmin($superadmin)
	{
		$this->superadmin = $superadmin;
		return $this;
	}

	/**
	 * Get superadmin
	 *
	 * @return boolean
	 */
	public function getSuperadmin()
	{
		return $this->superadmin;
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
}

