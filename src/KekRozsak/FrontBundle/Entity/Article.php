<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use KekRozsak\FrontBundle\Entity\User;

/**
 * KekRozsak\FrontBundle\Entity\Article
 * @ORM\Entity
 * @ORM\Table(name="articles")
 */
class Article
{
	/**
	 * @var integer $id
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer", name="id")
	 */
	private $id;

	/**
	 * Get id
	 *
	 * @return integer 
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @var string $title
	 * @ORM\Column(type="string", length=100, nullable=false)
	 */
	private $title;

	/**
	 * Set title
	 *
	 * @param string $title
	 * @return Article
	 */
	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}

	/**
	 * Get title
	 *
	 * @return string 
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @var string $slug
	 * @ORM\Column(type="string", length=100, nullable=false, unique=true)
	 */
	private $slug;

	/**
	 * Set slug
	 *
	 * @param string $slug
	 * @return Article
	 */
	public function setSlug($slug)
	{
		$this->slug = $slug;
		return $this;
	}

	/**
	 * Get slug
	 *
	 * @return string 
	 */
	public function getSlug()
	{
		return $this->slug;
	}

	/**
	 * @var text $text
	 * @ORM\Column(type="text", nullable=false)
	 */
	private $text;

	/**
	 * Set text
	 *
	 * @param text $text
	 * @return Article
	 */
	public function setText($text)
	{
		$this->text = $text;
		return $this;
	}

	/**
	 * Get text
	 *
	 * @return text 
	 */
	public function getText()
	{
		return $this->text;
	}

	/**
	 * @var string $source
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $source;

	/**
	 * Set source
	 *
	 * @param string $source
	 * @return Article
	 */
	public function setSource($source)
	{
		$this->source = $source;
		return $this;
	}

	/**
	 * Get source
	 *
	 * @return string 
	 */
	public function getSource()
	{
		return $this->source;
	}

	/**
	 * @var DateTime $createdAt
	 * @ORM\Column(type="datetime", nullable=false, name="created_at")
	 */
	private $createdAt;

	/**
	 * Set createdAt
	 *
	 * @param DateTime $createdAt
	 * @return Article
	 */
	public function setCreatedAt(\DateTime $createdAt)
	{
		$this->createdAt = $createdAt;
		return $this;
	}

	/**
	 * Get createdAt
	 *
	 * @return DateTime 
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * @var User $createdBy
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="articles")
	 * @ORM\JoinColumn(name="created_by_id", referencedColumnName="id")
	 */
	private $createdBy;

	/**
	 * Set createdBy
	 *
	 * @param User $createdBy
	 * @return Article
	 */
	public function setCreatedBy(User $createdBy = null)
	{
		$this->createdBy = $createdBy;
		return $this;
	}

	/**
	 * Get createdBy
	 *
	 * @return User 
	 */
	public function getCreatedBy()
	{
		return $this->createdBy;
	}

	/**
	 * @var DateTime $updatedAt
	 * @ORM\Column(type="datetime", nullable=true, name="updated_at")
	 */
	private $updatedAt;

	/**
	 * Set updatedAt
	 *
	 * @param DateTime $updatedAt
	 * @return Article
	 */
	public function setUpdatedAt(\DateTime $updatedAt)
	{
		$this->updatedAt = $updatedAt;
		return $this;
	}

	/**
	 * Get updatedAt
	 *
	 * @return DateTime 
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}

	/**
	 * @var User $updatedBy
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="updated_by_id", referencedColumnName="id")
	 */
	private $updatedBy;

	/**
	 * Set updatedBy
	 *
	 * @param User $updatedBy
	 * @return Article
	 */
	public function setUpdatedBy(User $updatedBy = null)
	{
		$this->updatedBy = $updatedBy;
		return $this;
	}

	/**
	 * Get updatedBy
	 *
	 * @return User 
	 */
	public function getUpdatedBy()
	{
		return $this->updatedBy;
	}

	/**
	 * @var text $updateReason
	 * @ORM\Column(type="text", nullable=true, name="update_reason")
	 */
	private $updateReason;

	/**
	 * Set updateReason
	 *
	 * @param text $updateReason
	 * @return Article
	 */
	public function setUpdateReason($updateReason)
	{
		$this->updateReason = $updateReason;
		return $this;
	}

	/**
	 * Get updateReason
	 *
	 * @return text 
	 */
	public function getUpdateReason()
	{
		return $this->updateReason;
	}

	/**
	 * @var boolean $mainPage
	 * @ORM\Column(type="boolean", name="main_page", nullable=true)
	 */
	private $mainPage;

	/**
	 * Set mainPage
	 *
	 * @param boolean $mainPage
	 * @return Article
	 */
	public function setMainPage($mainPage)
	{
		$this->mainPage = $mainPage;
		return $this;
	}

	/**
	 * Get mainPage
	 *
	 * @return boolean 
	 */
	public function getMainPage()
	{
		return $this->mainPage;
	}

	/**
	 * @var boolean $public
	 * @ORM\Column(type="boolean", nullable=false)
	 */
	private $public;

	/**
	 * Set public
	 *
	 * @param boolean $public
	 * @return Article
	 */
	public function setPublic($public)
	{
		$this->public = $public;
		return $this;
	}

	/**
	 * Get public
	 *
	 * @return boolean 
	 */
	public function getPublic()
	{
		return $this->public;
	}
}
