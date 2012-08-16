<?php
namespace KekRozsak\SecurityBundle\Service;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class CryptEncoder implements PasswordEncoderInterface
{
    function encodePassword($raw, $salt)
    {
        return crypt($raw);
    }

    function isPasswordValid($encoded, $raw, $salt)
    {
        return (crypt($raw, $salt) == $encoded);
    }
}

