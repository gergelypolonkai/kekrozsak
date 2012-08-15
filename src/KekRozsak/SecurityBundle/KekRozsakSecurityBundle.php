<?php

namespace KekRozsak\SecurityBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use KekRozsak\SecurityBundle\DependencyInjection\Compiler\OverrideServiceCompilerPass;

class KekRozsakSecurityBundle extends Bundle
{
	public function build(ContainerBuilder $container)
	{
		parent::build($container);
		$container->addCompilerPass(new OverrideServiceCompilerPass());
	}
}
