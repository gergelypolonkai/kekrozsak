<?php
namespace KekRozsak\SecurityBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class OverrideServiceCompilerPass implements CompilerPassInterface
{
	public function process(ContainerBuilder $container)
	{
		$definition = $container->getDefinition('security.role_hierarchy');
		$definition->setClass('KekRozsak\SecurityBundle\Service\RoleHierarchy');
		$definition->setArguments(array(new Reference('doctrine')));
	}
}
