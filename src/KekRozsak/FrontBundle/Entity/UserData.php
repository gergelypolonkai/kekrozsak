<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KekRozsak\FrontBundle\Entity\UserData
 */
class UserData
{
    /**
     * @var KekRozsak\FrontBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param KekRozsak\FrontBundle\Entity\User $user
     * @return UserData
     */
    public function setUser(\KekRozsak\FrontBundle\Entity\User $user = null)
    {
        $this->user = $user;
	$this->user_id = $user->getId();
        return $this;
    }

    /**
     * Get user
     *
     * @return KekRozsak\FrontBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @var integer $user_id
     */
    private $user_id;

    /**
     * @var string $realName
     */
    private $realName;

    /**
     * @var boolean $realNamePublic
     */
    private $realNamePublic;


    /**
     * Set user_id
     *
     * @param integer $userId
     * @return UserData
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;
        return $this;
    }

    /**
     * Get user_id
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set realName
     *
     * @param string $realName
     * @return UserData
     */
    public function setRealName($realName)
    {
        $this->realName = $realName;
        return $this;
    }

    /**
     * Get realName
     *
     * @return string 
     */
    public function getRealName()
    {
        return $this->realName;
    }

    /**
     * Set realNamePublic
     *
     * @param boolean $realNamePublic
     * @return UserData
     */
    public function setRealNamePublic($realNamePublic)
    {
        $this->realNamePublic = $realNamePublic;
        return $this;
    }

    /**
     * Get realNamePublic
     *
     * @return boolean 
     */
    public function getRealNamePublic()
    {
        return $this->realNamePublic;
    }
    /**
     * @var text $selfDescription
     */
    private $selfDescription;

    /**
     * @var boolean $emailPublic
     */
    private $emailPublic;


    /**
     * Set selfDescription
     *
     * @param text $selfDescription
     * @return UserData
     */
    public function setSelfDescription($selfDescription)
    {
        $this->selfDescription = $selfDescription;
        return $this;
    }

    /**
     * Get selfDescription
     *
     * @return text 
     */
    public function getSelfDescription()
    {
        return $this->selfDescription;
    }

    /**
     * Set emailPublic
     *
     * @param boolean $emailPublic
     * @return UserData
     */
    public function setEmailPublic($emailPublic)
    {
        $this->emailPublic = $emailPublic;
        return $this;
    }

    /**
     * Get emailPublic
     *
     * @return boolean 
     */
    public function getEmailPublic()
    {
        return $this->emailPublic;
    }
    /**
     * @var string $msnAddress
     */
    private $msnAddress;

    /**
     * @var boolean $msnAddressPublic
     */
    private $msnAddressPublic;

    /**
     * @var string $googleTalk
     */
    private $googleTalk;

    /**
     * @var boolean $googleTalkPublic
     */
    private $googleTalkPublic;

    /**
     * @var string $skype
     */
    private $skype;

    /**
     * @var boolean $skypePublic
     */
    private $skypePublic;


    /**
     * Set msnAddress
     *
     * @param string $msnAddress
     * @return UserData
     */
    public function setMsnAddress($msnAddress)
    {
        $this->msnAddress = $msnAddress;
        return $this;
    }

    /**
     * Get msnAddress
     *
     * @return string 
     */
    public function getMsnAddress()
    {
        return $this->msnAddress;
    }

    /**
     * Set msnAddressPublic
     *
     * @param boolean $msnAddressPublic
     * @return UserData
     */
    public function setMsnAddressPublic($msnAddressPublic)
    {
        $this->msnAddressPublic = $msnAddressPublic;
        return $this;
    }

    /**
     * Get msnAddressPublic
     *
     * @return boolean 
     */
    public function getMsnAddressPublic()
    {
        return $this->msnAddressPublic;
    }

    /**
     * Set googleTalk
     *
     * @param string $googleTalk
     * @return UserData
     */
    public function setGoogleTalk($googleTalk)
    {
        $this->googleTalk = $googleTalk;
        return $this;
    }

    /**
     * Get googleTalk
     *
     * @return string
     */
    public function getGoogleTalk()
    {
        return $this->googleTalk;
    }

    /**
     * Set googleTalkPublic
     *
     * @param boolean $googleTalkPublic
     * @return UserData
     */
    public function setGoogleTalkPublic($googleTalkPublic)
    {
        $this->googleTalkPublic = $googleTalkPublic;
        return $this;
    }

    /**
     * Get googleTalkPublic
     *
     * @return boolean 
     */
    public function getGoogleTalkPublic()
    {
        return $this->googleTalkPublic;
    }

    /**
     * Set skype
     *
     * @param string $skype
     * @return UserData
     */
    public function setSkype($skype)
    {
        $this->skype = $skype;
        return $this;
    }

    /**
     * Get skype
     *
     * @return string 
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * Set skypePublic
     *
     * @param boolean $skypePublic
     * @return UserData
     */
    public function setSkypePublic($skypePublic)
    {
        $this->skypePublic = $skypePublic;
        return $this;
    }

    /**
     * Get skypePublic
     *
     * @return boolean 
     */
    public function getSkypePublic()
    {
        return $this->skypePublic;
    }
    /**
     * @var string $phoneNumber
     */
    private $phoneNumber;

    /**
     * @var boolean $phoneNumberPublic
     */
    private $phoneNumberPublic;


    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return UserData
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set phoneNumberPublic
     *
     * @param boolean $phoneNumberPublic
     * @return UserData
     */
    public function setPhoneNumberPublic($phoneNumberPublic)
    {
        $this->phoneNumberPublic = $phoneNumberPublic;
        return $this;
    }

    /**
     * Get phoneNumberPublic
     *
     * @return boolean 
     */
    public function getPhoneNumberPublic()
    {
        return $this->phoneNumberPublic;
    }
}
