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
		if (!$this->_securityContext->getToken() instanceof Symfony\Component\Security\Core\Authentication\Token\AnonymousToken)
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

