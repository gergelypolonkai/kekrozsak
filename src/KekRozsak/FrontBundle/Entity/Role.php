<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KekRozsak\FrontBundle\Entity\Role
 */
class Role
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $display_name
     */
    private $display_name;

    /**
     * @var boolean $can_be_assigned
     */
    private $can_be_assigned;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $included_roles;

    public function __construct()
    {
        $this->included_roles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set display_name
     *
     * @param string $displayName
     * @return Role
     */
    public function setDisplayName($displayName)
    {
        $this->display_name = $displayName;
        return $this;
    }

    /**
     * Get display_name
     *
     * @return string 
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }

    /**
     * Set can_be_assigned
     *
     * @param boolean $canBeAssigned
     * @return Role
     */
    public function setCanBeAssigned($canBeAssigned)
    {
        $this->can_be_assigned = $canBeAssigned;
        return $this;
    }

    /**
     * Get can_be_assigned
     *
     * @return boolean 
     */
    public function getCanBeAssigned()
    {
        return $this->can_be_assigned;
    }

    /**
     * Add included_roles
     *
     * @param KekRozsak\FrontBundle\Entity\Role $includedRoles
     * @return Role
     */
    public function addRole(\KekRozsak\FrontBundle\Entity\Role $includedRoles)
    {
        $this->included_roles[] = $includedRoles;
        return $this;
    }

    /**
     * Get included_roles
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getIncludedRoles()
    {
        return $this->included_roles;
    }
}