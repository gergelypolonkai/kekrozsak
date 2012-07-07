<?php
namespace KekRozsak\SecurityBundle\Security;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

class AuthSuccess implements AuthenticationSuccessHandlerInterface
{
	private $doctrine;

	public function __construct(RegistryInterface $doctrine)
	{
		$this->doctrine = $doctrine;
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

