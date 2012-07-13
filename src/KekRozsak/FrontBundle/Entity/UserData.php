<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use KekRozsak\FrontBundle\Entity\User;

/**
 * KekRozsak\FrontBundle\Entity\UserData
 * @ORM\Entity
 * @ORM\Table(name="user_data")
 */
class UserData
{
	/**
	 * @var User $user
	 * @ORM\Id
	 * @ORM\OneToOne(targetEntity="User", inversedBy="userData")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 */
	protected $user;

	/**
	 * Set user
	 *
	 * @param User $user
	 * @return UserData
	 */
	public function setUser(User $user = null)
	{
		$this->user = $user;
		$this->userId = $user->getId();
		return $this;
	}

	/**
	 * Get user
	 *
	 * @return User 
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * @var boolean $emailPublic
	 * @ORM\Column(type="boolean", name="email_public")
	 */
	protected $emailPublic;

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
	 * @var string $realName
	 * @ORM\Column(name="real_name", type="string", length=100, nullable=true)
	 */
	protected $realName;

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
	 * @var boolean $realNamePublic
	 * @ORM\Column(name="real_name_public", type="boolean", nullable=false)
	 */
	protected $realNamePublic;

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
	 * @ORM\Column(name="self_description", type="text", nullable=true)
	 */
	protected $selfDescription;

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
	 * @var string $msnAddress
	 * @ORM\Column(type="string", length=100, name="msn_address", nullable=true)
	 */
	protected $msnAddress;

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
	 * @var boolean $msnAddressPublic
	 * @ORM\Column(type="boolean", name="msn_address_public", nullable=false)
	 */
	protected $msnAddressPublic;

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
	 * @var string $googleTalk
	 * @ORM\Column(type="string", length=100, name="google_talk", nullable=true)
	 */
	protected $googleTalk;

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
	 * @var boolean $googleTalkPublic
	 * @ORM\Column(type="boolean", name="google_talk_public", nullable=false)
	 */
	protected $googleTalkPublic;

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
	 * @var string $skype
	 * @ORM\Column(type="string", length=100, nullable=true)
	 */
	protected $skype;

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
	 * @var boolean $skypePublic
	 * @ORM\Column(type="boolean", name="skype_public", nullable=false)
	 */
	protected $skypePublic;

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
	 * @ORM\Column(type="string", length=30, name="phone_number", nullable=true)
	 */
	protected $phoneNumber;

	/**
	 * Set phoneNumber
	 *
	 * @param string $phoneNumber
	 * @return UserData
	 */
	public function setPhoneNumber($phoneNumber = null)
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
	 * @var boolean $phoneNumberPublic
	 * @ORM\Column(type="boolean", name="phone_number_public", nullable=false)
	 */
	protected $phoneNumberPublic;

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
