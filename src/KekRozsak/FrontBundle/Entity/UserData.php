<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use KekRozsak\SecurityBundle\Entity\User;

/**
 * KekRozsak\FrontBundle\Entity\UserData
 * @ORM\Entity
 * @ORM\Table(name="user_data")
 */
class UserData
{
    public function __construct()
    {
        $this->emailPublic = false;
        $this->realNamePublic = false;
        $this->msnAddressPublic = false;
        $this->googleTalkPublic = false;
        $this->skypePublic = false;
        $this->phoneNumberPublic = false;
        $this->favouriteTopics = new ArrayCollection();
    }

    /**
     * The User object this UserData belongs to
     *
     * @var KekRozsak\SecurityBundle\Entity\User $user
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="KekRozsak\SecurityBundle\Entity\User", inversedBy="userData")
     * @ORM\JoinColumn(name="user_id")
     */
    protected $user;

    /**
     * Set user
     *
     * @param  KekRozsak\SecurityBundle\Entity\User $user
     * @return UserData
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return KekRozsak\SecurityBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * TRUE if $user's e-mail address is public
     *
     * @var boolean $emailPublic
     *
     * @ORM\Column(type="boolean", name="email_public")
     */
    protected $emailPublic;

    /**
     * Set emailPublic
     *
     * @param  boolean  $emailPublic
     * @return UserData
     */
    public function setEmailPublic($emailPublic)
    {
        // TODO: Check if parameter is boolean!
        $this->emailPublic = $emailPublic;

        return $this;
    }

    /**
     * Get emailPublic
     *
     * @return boolean
     */
    public function isEmailPublic()
    {
        return $this->emailPublic;
    }

    /**
     * The real name of $user
     *
     * @var string $realName
     *
     * @ORM\Column(type="string", length=100, nullable=true, name="real_name")
     */
    protected $realName;

    /**
     * Set realName
     *
     * @param  string   $realName
     * @return UserData
     */
    public function setRealName($realName = null)
    {
        // TODO: Check if empty!
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
     * TRUE is $user's real name is public
     *
     * @var boolean $realNamePublic
     *
     * @ORM\Column(type="boolean", name="real_name_public")
     */
    protected $realNamePublic;

    /**
     * Set realNamePublic
     *
     * @param  boolean  $realNamePublic
     * @return UserData
     */
    public function setRealNamePublic($realNamePublic = false)
    {
        // TODO: Check if parameter is boolean!
        $this->realNamePublic = $realNamePublic;

        return $this;
    }

    /**
     * Get realNamePublic
     *
     * @return boolean
     */
    public function isRealNamePublic()
    {
        return $this->realNamePublic;
    }

    /**
     * The self description of $user
     *
     * @var string $selfDescription
     *
     * @ORM\Column(type="text", nullable=true, name="self_description")
     */
    protected $selfDescription;

    /**
     * Set selfDescription
     *
     * @param  string   $selfDescription
     * @return UserData
     */
    public function setSelfDescription($selfDescription = null)
    {
        $this->selfDescription = $selfDescription;

        return $this;
    }

    /**
     * Get selfDescription
     *
     * @return string
     */
    public function getSelfDescription()
    {
        return $this->selfDescription;
    }

    /**
     * The MSN address of $user
     *
     * @var string $msnAddress
     *
     * @ORM\Column(type="string", length=100, nullable=true, name="msn_address")
     */
    protected $msnAddress;

    /**
     * Set msnAddress
     *
     * @param  string   $msnAddress
     * @return UserData
     */
    public function setMsnAddress($msnAddress = null)
    {
        // TODO: Check if empty!
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
     * TRUE if $user's MSN address is public
     *
     * @var boolean $msnAddressPublic
     *
     * @ORM\Column(type="boolean", name="msn_address_public")
     */
    protected $msnAddressPublic;

    /**
     * Set msnAddressPublic
     *
     * @param  boolean  $msnAddressPublic
     * @return UserData
     */
    public function setMsnAddressPublic($msnAddressPublic)
    {
        // TODO: Check if parameter is boolean!
        $this->msnAddressPublic = $msnAddressPublic;

        return $this;
    }

    /**
     * Get msnAddressPublic
     *
     * @return boolean
     */
    public function isMsnAddressPublic()
    {
        return $this->msnAddressPublic;
    }

    /**
     * Google Talk address of $user
     *
     * @var string $googleTalk
     *
     * @ORM\Column(type="string", length=100, nullable=true, name="google_talk")
     */
    protected $googleTalk;

    /**
     * Set googleTalk
     *
     * @param  string   $googleTalk
     * @return UserData
     */
    public function setGoogleTalk($googleTalk = null)
    {
        // TODO: Check if empty!
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
     * TRUE if $user's Google Talk address is public
     *
     * @var boolean $googleTalkPublic
     *
     * @ORM\Column(type="boolean", name="google_talk_public")
     */
    protected $googleTalkPublic;

    /**
     * Set googleTalkPublic
     *
     * @param  boolean  $googleTalkPublic
     * @return UserData
     */
    public function setGoogleTalkPublic($googleTalkPublic)
    {
        // TODO: Check if parameter is boolean!
        $this->googleTalkPublic = $googleTalkPublic;

        return $this;
    }

    /**
     * Get googleTalkPublic
     *
     * @return boolean
     */
    public function isGoogleTalkPublic()
    {
        return $this->googleTalkPublic;
    }

    /**
     * Skype name of $user
     *
     * @var string $skype
     *
     * @ORM\Column(type="string", length=100, nullable=true, name="skype")
     */
    protected $skype;

    /**
     * Set skype
     *
     * @param  string   $skype
     * @return UserData
     */
    public function setSkype($skype = null)
    {
        // TODO: Check if empty!
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
     * TRUE if $user's Skype name is public
     *
     * @var boolean $skypePublic
     *
     * @ORM\Column(type="boolean", name="skype_public")
     */
    protected $skypePublic;

    /**
     * Set skypePublic
     *
     * @param  boolean  $skypePublic
     * @return UserData
     */
    public function setSkypePublic($skypePublic)
    {
        // TODO: Check if parameter is boolean!
        $this->skypePublic = $skypePublic;

        return $this;
    }

    /**
     * Get skypePublic
     *
     * @return boolean
     */
    public function isSkypePublic()
    {
        return $this->skypePublic;
    }

    /**
     * Phone number of $user
     *
     * @var string $phoneNumber
     *
     * @ORM\Column(type="string", length=30, nullable=true, name="phone_number")
     */
    protected $phoneNumber;

    /**
     * Set phoneNumber
     *
     * @param  string   $phoneNumber
     * @return UserData
     */
    public function setPhoneNumber($phoneNumber = null)
    {
        // TODO: Check if empty!
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
     * TRUE if $user's phone number is public
     *
     * @var boolean $phoneNumberPublic
     *
     * @ORM\Column(type="boolean", name="phone_number_public")
     */
    protected $phoneNumberPublic;

    /**
     * Set phoneNumberPublic
     *
     * @param  boolean  $phoneNumberPublic
     * @return UserData
     */
    public function setPhoneNumberPublic($phoneNumberPublic)
    {
        // TODO: Check if parameter is boolean!
        $this->phoneNumberPublic = $phoneNumberPublic;

        return $this;
    }

    /**
     * Get phoneNumberPublic
     *
     * @return boolean
     */
    public function isPhoneNumberPublic()
    {
        return $this->phoneNumberPublic;
    }

    /**
     * ArrayCollection of the User's favourite ForumTopics
     *
     * @var Doctrine\Common\Collections\ArrayCollection $favouriteTopics
     *
     * @ORM\ManyToMany(targetEntity="ForumTopic", fetch="LAZY")
     * @ORM\JoinTable(name="user_favourite_forum_topics", joinColumns={
     *         @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     *     }, inverseJoinColumns={
     *         @ORM\JoinColumn(name="forum_topic_id")
     *     }
     * )
     */
    protected $favouriteTopics;

    /**
     * Add a favourite ForumTopic
     *
     * @param  KekRozsak\FrontBundle\Entity\ForumTopic $topic
     * @return UserData
     */
    public function addFavouriteTopic(ForumTopic $topic)
    {
        // TODO: Check if not null
        $this->favouriteTopics->add($topic);

        return $this;
    }

    /**
     * Remove a favourite ForumTopic
     *
     * @param  KekRozsak\FrontBundle\Entity\ForumTopic $topic
     * @return UserData
     */
    public function removeFavouriteTopic(ForumTopic $topic)
    {
        // TODO: Check if not null
        $this->favouriteTopics->removeElement($topic);

        return $this;
    }

    /**
     * Get favourite ForumTopics
     *
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getFavouriteTopics()
    {
        return $this->favouriteTopics;
    }

    /**
     * Check if given ForumTopic is favourited by User
     *
     * @param  KekRozsak\FrontBundle\Entity\ForumTopic $topic
     * @return boolean
     */
    public function isFavouriteForumTopic(ForumTopic $topic)
    {
        return $this->favouriteTopics->contains($topic);
    }

    /**
     * The avatar image of the user
     *
     * @var UploadedFile $avatarImage
     *
     * @ORM\ManyToOne(targetEntity="KekRozsak\FrontBundle\Entity\UploadedFile")
     * @ORM\JoinColumn(name="avatar_image_id", nullable=true)
     */
    protected $avatarImage;

    /**
     * Set avaratImage
     *
     * @param  KekRozsak\FrontBundle\Entity\UploadedFile $avatarImage
     * @return UserData
     */
    public function setAvatarImage(UploadedFile $avatarImage)
    {
        $this->avatarImage = $avatarImage;

        return $this;
    }

    /**
     * Get avatarImage
     *
     * @return KekRozsak\FrontBundle\Entity\UploadedFile
     */
    public function getAvatarImage()
    {
        return $this->avatarImage;
    }
}
