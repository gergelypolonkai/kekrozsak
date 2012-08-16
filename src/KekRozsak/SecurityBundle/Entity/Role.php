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
     * The ID of the Role
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
     * The role name of the Role
     *
     * @var string name
     *
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
        // TODO: Check if null or empty!
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
     * TRUE if this Role is automatically added to newly registered Users
     *
     * @var boolean $default
     *
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
        // TODO: Check if parameter is boolean!
        $this->default = $default;
        return $this;
    }

    /**
     * The description of this Role
     *
     * @var text description
     *
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
     * Short description of the Role (e.g readable name)
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
        // TODO: Check if empty or null!
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
     * List of inherited Roles. Required for RoleHierarchy
     *
     * @var Doctrine\Common\Collections\ArrayCollection $inheritedRoles
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
