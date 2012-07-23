<?php

namespace KekRozsak\FrontBundle\Twig;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;

class NewsExtension extends \Twig_Extension
{
	protected $_doctrine;
	protected $_securityContext;

	public function __construct(RegistryInterface $doctrine, SecurityContextInterface $securityContext)
	{
		$this->_doctrine = $doctrine;
		$this->_securityContext = $securityContext;
	}

	public function getGlobals()
	{
		$newsRepo = $this->_doctrine->getRepository('KekRozsakFrontBundle:News');
		$searchCriteria = array();
		if (!is_object($this->_securityContext->getToken()) || !is_object($this->_securityContext->getToken()->getUser()))
			$searchCriteria['public'] = true;

		$news = $newsRepo->findBy($searchCriteria, array('createdAt' => 'DESC'), 4);

		return array(
			'recentNews' => $news,
		);
	}

	public function getName()
	{
		return 'News';
	}
}

