<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Doctrine\Common\Collections\ArrayCollection;

use KekRozsak\SecurityBundle\Entity\User;

/**
 * KekRozsak\FrontBundle\Entity\Book
 *
 * @ORM\Entity
 * @ORM\Table(name="books")
 *
 * @DoctrineAssert\UniqueEntity(fields={"author", "title", "year"})
 */
class Book
{
	public function __construct()
	{
		$this->copies = new ArrayCollection();
		$this->wouldBorrow = new ArrayCollection();
		$this->wouldBuy = new ArrayCollection();
	}

	/**
	 * @var integer $id
	 *
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	protected $id;

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
	 * @var Doctrine\Common\Collections\ArrayCollection $copies
	 *
	 * @ORM\OneToMany(targetEntity="BookCopy", mappedBy="book")
	 */
	protected $copies;

	/**
	 * Remove a copy
	 *
	 * @param KekRozsak\FrontBundle\Entity\BookCopy $copy
	 * @return Book
	 */
	public function removeCopy(BookCopy $copy)
	{
		$this->copies->removeElement($copy);
	}

	/**
	 * Get copies
	 *
	 * @return Doctrine\Common\Collections\ArrayCollection
	 */
	public function getCopies()
	{
		return $this->copies;
	}

	public function getCopiesBorrowed()
	{
		return $this->copies->filter(function($copy) {
			return ($copy->getBorrower() !== null);
		});
	}

	public function getCopiesBorrowedByUser(User $user)
	{
		return $this->copies->filter(function($copy) use ($user) {
			return ($copy->getBorrower() == $user);
		});
	}

	public function getCopiesBorrowedReturnedByUser(User $user)
	{
		return $this->copies->filter(function($copy) use ($user) {
			return ($copy->getBorrower() == $user) && ($copy->isBorrowerReturned());
		});
	}

	public function getCopiesBorrowable()
	{
		return $this->copies->filter(function($copy) {
			return $copy->isBorrowable();
		});
	}

	public function getUsersCopies(User $user)
	{
		return $this->copies->filter(function ($copy) use ($user) {
			return ($copy->getOwner() == $user);
		});
	}

	public function getUsersCopiesBorrowable(User $user)
	{
		return $this->copies->filter(function($copy) use ($user) {
			return (($copy->getOwner() == $user) && $copy->isBorrowable());
		});
	}

	public function getUsersCopiesBuyable(User $user)
	{
		return $this->copies->filter(function($copy) use ($user) {
			return (($copy->getOwner() == $user) && $copy->isBuyable());
		});
	}

	/**
	 * @var string $author
	 *
	 * @ORM\Column(type="string", length=100, nullable=false)
	 */
	protected $author;

	/**
	 * Set author
	 *
	 * @param string $author
	 * @return Book
	 */
	public function setAuthor($author)
	{
		$this->author = $author;
		return $this;
	}

	/**
	 * Get author
	 *
	 * @return string
	 */
	public function getAuthor()
	{
		return $this->author;
	}

	/**
	 * @var string $title
	 *
	 * @ORM\Column(type="string", length=100, nullable=false)
	 */
	protected $title;

	/**
	 * Set title
	 *
	 * @param string $title
	 * @return Book
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
	 * @var integer $year
	 *
	 * @ORM\Column(type="integer", nullable=false)
	 */
	protected $year;

	/**
	 * Set year
	 *
	 * @param integer $year
	 * @return Book
	 */
	public function setYear($year)
	{
		$this->year = $year;
		return $this;
	}

	/**
	 * Get year
	 *
	 * @return integer
	 */
	public function getYear()
	{
		return $this->year;
	}

	/**
	 * @var boolean $commentable
	 *
	 * @ORM\Column(type="boolean", nullable=false)
	 */
	protected $commentable;

	/**
	 * @var Doctrine\Common\Collections\ArrayCollection $wouldBorrow
	 *
	 * @ORM\ManyToMany(targetEntity="KekRozsak\SecurityBundle\Entity\User")
	 * @ORM\JoinTable(name="book_would_borrow")
	 */
	protected $wouldBorrow;

	/**
	 * Add a user for want-to-borrowers
	 *
	 * @param KekRozsak\SecurityBundle\Entity\User $user
	 * @return Book
	 */
	public function addWouldBorrow(User $user)
	{
		$this->wouldBorrow->add($user);
		return $this;
	}

	/**
	 * Get wouldBorrow list
	 *
	 * @return Doctrine\Common\Collections\ArrayCollection
	 */
	public function getWouldBorrow()
	{
		return $this->wouldBorrow;
	}

	/**
	 * Check if specified user would borrow this book
	 *
	 * @param KekRozsak\SecurityBundle\Entity\User $user
	 * @return boolean
	 */
	public function userWouldBorrow(User $user)
	{
		return $this->wouldBorrow->contains($user);
	}

	/**
	 * @var Doctrine\Common\Collections\ArrayCollection $wouldBuy
	 *
	 * @ORM\ManyToMany(targetEntity="KekRozsak\SecurityBundle\Entity\User")
	 * @ORM\JoinTable(name="book_would_buy")
	 */
	protected $wouldBuy;

	/**
	 * Add a user for want-to-buyers
	 *
	 * @param KekRozsak\SecurityBundle\Entity\User $user
	 * @return Book
	 */
	public function addWouldBuy(User $user)
	{
		$this->wouldBuy->add($user);
		return $this;
	}

	/**
	 * Get wouldBuy list
	 *
	 * @return Doctrine\Common\Collections\ArrayCollection
	 */
	public function getWouldBuy()
	{
		return $this->wouldBuy;
	}

	/**
	 * Check if specified user would buy this book
	 *
	 * @param KekRozsak\SecurityBundle\Entity\User $user
	 * @return boolean
	 */
	public function userWouldBuy(User $user)
	{
		return $this->wouldBuy->contains($user);
	}
}
