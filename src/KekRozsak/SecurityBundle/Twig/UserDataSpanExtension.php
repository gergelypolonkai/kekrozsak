<?php

namespace KekRozsak\SecurityBundle\Twig;

use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use KekRozsak\SecurityBundle\Entity\User;

class UserDataSpanExtension extends \Twig_Extension
{
	protected $_securityContext;
	protected $_serviceContainer;

	public function __construct(ContainerInterface $container, SecurityContextInterface $security)
	{
		$this->_serviceContainer = $container;
		$this->_securityContext = $security;
	}

	public function getFilters()
	{
		return array(
			'userdataspan' => new \Twig_Filter_Method($this, 'getUserDataSpan', array('is_safe' => array('html'))),
		);
	}

	public function getUserDataSpan(User $user)
	{
		if (!is_object($this->_securityContext->getToken()) || !is_object($this->_securityContext->getToken()->getUser()))
			return '<span class="userdata-secret" title="|Felhasználó|A felhasználóink kiléte szigorúan bizalmas, csak a tagok számára elérhető.">[nem jelenhet meg]</span>';

		return '<span class="userdata" rel="' . $this->_serviceContainer->get('router')->generate('KekRozsakSecurityBundle_ajaxUserdata', array('id' => $user->getId(), '_format' => 'html')) . '">' . $user->getDisplayName() . '</span>';
	}

	public function getName()
	{
		return 'twig_userdataspan';
	}
}

