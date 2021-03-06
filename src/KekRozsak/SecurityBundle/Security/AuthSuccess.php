<?php
namespace KekRozsak\SecurityBundle\Security;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service
 * @DI\Tag("kernel.event_listener", attributes={"event" = "security.authentication.success"})
 */
class AuthSuccess implements AuthenticationSuccessHandlerInterface
{
    /**
     * The Doctrine interface
     *
     * @var Symfony\Bridge\Doctrine\RegistryInterface $doctrine
     */
    private $doctrine;

    /**
     * @DI\InjectParams
     *
     * @param \Symfony\Bridge\Doctrine\RegistryInterface $doctrine
     */
    public function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function onSecurityAuthenticationSuccess(AuthenticationEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        $em = $this->doctrine->getManager();
        $user->setLastLoginAt(new \DateTime('now'));
        $em->persist($user);
        $em->flush();
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $user = $token->getUser();
        $em = $this->doctrine->getManager();
        $user->setLastLoginAt(new \DateTime('now'));
        $em->persist($user);
        $em->flush();
    }
}
