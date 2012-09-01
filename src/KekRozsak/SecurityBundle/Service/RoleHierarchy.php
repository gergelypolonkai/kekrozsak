<?php

namespace KekRozsak\SecurityBundle\Service;

use Symfony\Component\Security\Core\Role\RoleHierarchyInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\Role\RoleInterface;

class RoleHierarchy implements RoleHierarchyInterface
{
    private $hierarchy;
    private $roleRepo;
    private $map;

    public function __construct(RegistryInterface $doctrine)
    {
        $this->hierarchy = array();
        $this->roleRepo = $doctrine->getRepository('KekRozsakSecurityBundle:Role');

        $this->buildRoleMap();
    }

    public function getReachableRoles(array $roles)
    {
        $reachableRoles = array();
        foreach ($roles as $role) {
            $thisRole = $role->getRole();
            if (!isset($this->map[$thisRole])) {
                continue;
            }
            $reachableRoles[] = $role;

            foreach ($this->map[$thisRole] as $r) {
                if (($childRole = $this->roleRepo->findOneByName($r)) !== null) {
                    $reachableRoles[] = $childRole;
                }
            }
        }

        return $reachableRoles;
    }

    private function buildRoleMap()
    {
        $this->map = array();
        $roles = $this->roleRepo->findAll();
        foreach ($roles as $mainRole) {
            $main = $mainRole->getRole();
            $this->map[$main] = array($main);
            foreach ($mainRole->getInheritedRoles() as $childRole) {
                $this->map[$main][] = $childRole->getRole();
                // TODO: This is one-level only. Get as deep as possible.
                // BEWARE OF RECURSIVE NESTING!
                foreach ($childRole->getInheritedRoles() as $grandchildRole) {
                    $this->map[$main][] = $grandchildRole->getRole();
                }
            }
        }
    }
}
