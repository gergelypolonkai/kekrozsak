<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use KekRozsak\SecurityBundle\Entity\User;

/** 
 * @ORM\Entity
 * @ORM\Table(name="articles")
 */
class Article
{
	/**
	 * @var integer $id
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
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
	 * @var KekRozsak\SecurityBundle\Entity\User $createdBy
	 * @ORM\ManyToOne(targetEntity="KekRozsak\SecurityBundle\Entity\User")
	 * @ORM\JoinColumn(name="created_by_id")
	 */
	private $createdBy;

	/**
	 * Set createdBy
	 *
	 * @param KekRozsak\SecurityBundle\Entity\User $createdBy
	 * @return Article
	 */
	public function setCreatedBy(\KekRozsak\SecurityBundle\Entity\User $createdBy)
	{
		$this->createdBy = $createdBy;
		return $this;
	}

	/**
	 * Get createdBy
	 *
	 * @return KekRozsak\SecurityBundle\Entity\User
	 */
	public function getCreatedBy()
	{
		return $this->createdBy;
	}

	/**
	 * @var DateTime $createdAt
	 * @ORM\Column(type="datetime", name="created_at", nullable=false)
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
	 * @var string $title
	 * @ORM\Column(type="string", length=100, nullable=false, unique=true)
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
	 * @var string $text
	 * @ORM\Column(type="text", nullable=false)
	 */
	private $text;

	/**
	 * Set text
	 *
	 * @param string $text
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
	 * return string
	 */
	public function getText()
	{
		return $this->text;
	}

	/**
	 * @var boolean $mainPage
	 * @ORM\Column(type="boolean", name="main_page")
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
	 * @var boolean public
	 * @ORM\Column(type="boolean", nullable=false)
	 */
	private $public;

	/**
	 * Set public
	 *
	 * @param boolean $public
	 * @return Article
	 */
	public function setPublic($public = false)
	{
		$this->public = $public;
		return $this;
	}

	/**
	 * Get public
	 *
	 * @return boolean
	 */
	public function isPublic()
	{
		return $this->public;
	}

	/**
	 * @var string $source
	 * @ORM\Column(type="string", nullable=true)
	 */
	private $source;

	/**
	 * Set source
	 *
	 * @param string $source
	 * @return Article
	 */
	public function setSource($source = null)
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
}

