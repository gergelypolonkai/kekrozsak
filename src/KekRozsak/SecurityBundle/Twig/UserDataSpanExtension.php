<?php

namespace KekRozsak\SecurityBundle\Twig;

use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

use KekRozsak\SecurityBundle\Entity\User;

class UserDataSpanExtension extends \Twig_Extension
{
	protected $_securityContext;
	protected $_router;

	public function __construct(Router $router, SecurityContextInterface $security)
	{
		$this->_router = $router;
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

		return '<span class="userdata" rel="' . $this->_router->generate('KekRozsakSecurityBundle_ajaxUserdata', array('id' => $user->getId(), '_format' => 'html')) . '"><a href="">' . $user->getDisplayName() . '</a></span>';
	}

	public function getName()
	{
		return 'twig_userdataspan';
	}
}

