<?php

namespace KekRozsak\FrontBundle\Twig;

use Symfony\Bridge\Doctrine\RegistryInterface;

class NewsExtension extends \Twig_Extension
{
	protected $doctrine;

	public function __construct(RegistryInterface $doctrine)
	{
		$this->doctrine = $doctrine;
	}

	public function getGlobals()
	{
		$newsRepo = $this->doctrine->getRepository('KekRozsakFrontBundle:News');
		$news = $newsRepo->findBy(array(), array('createdAt' => 'DESC'), 4);

		return array(
			'recentNews' => $news,
		);
	}

	public function getName()
	{
		return 'News';
	}
}

