<?php
namespace KekRozsak\SecurityBundle\Service;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("kek_rozsak_security.encoder.crypt")
 */
class CryptEncoder implements PasswordEncoderInterface
{
    public function encodePassword($raw, $salt)
    {
        return crypt($raw);
    }

    public function isPasswordValid($encoded, $raw, $salt)
    {
        return (crypt($raw, $salt) == $encoded);
    }
}
