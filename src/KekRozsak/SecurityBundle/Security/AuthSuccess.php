<?php
namespace KekRozsak\SecurityBundle\Security;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;

class AuthSuccess implements AuthenticationSuccessHandlerInterface
{
	private $doctrine;

	public function __construct(RegistryInterface $doctrine)
	{
		$this->doctrine = $doctrine;
	}

	public function onSecurityAuthenticationSuccess(AuthenticationEvent $event)
	{
		$user = $event->getAuthenticationToken()->getUser();
		$em = $this->doctrine->getEntityManager();
		$user->setLastLoginAt(new \DateTime('now'));
		$em->persist($user);
		$em->flush();
	}

	public function onAuthenticationSuccess(Request $request, TokenInterface $token)
	{
		$user = $token->getUser();
		$em = $this->doctrine->getEntityManager();
		$user->setLastLoginAt(new \DateTime('now'));
		$em->persist($user);
		$em->flush();
	}
}

