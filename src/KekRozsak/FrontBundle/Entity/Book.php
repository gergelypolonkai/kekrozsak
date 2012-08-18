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
     * The ID of the Book
     *
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
     * The copies available for this Book
     *
     * @var Doctrine\Common\Collections\ArrayCollection $copies
     *
     * @ORM\OneToMany(targetEntity="BookCopy", mappedBy="book")
     */
    protected $copies;

    /**
     * Remove a copy
     *
     * @param  KekRozsak\FrontBundle\Entity\BookCopy $copy
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

    /**
     * Get the copies of this Book those are borrowed by someone
     *
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getCopiesBorrowed()
    {
        return $this->copies->filter(function($copy) {
                return ($copy->getBorrower() !== null);
            });
    }

    /**
     * Get the copies of this Book those are borrowed by $user
     *
     * @param  KekRozsak\SecurityBundle\Entity\User        $user
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getCopiesBorrowedByUser(User $user)
    {
        return $this->copies->filter(function($copy) use ($user) {
                return ($copy->getBorrower() == $user);
            });
    }

    /**
     * Get the copies of this Book those are borrowed by $user, but marked as
     * returned
     *
     * @param  KekRozsak\SecurityBundle\Entity\User        $user
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getCopiesBorrowedReturnedByUser(User $user)
    {
        return $this->copies->filter(function($copy) use ($user) {
                return ($copy->getBorrower() == $user) && ($copy->isBorrowerReturned());
            });
    }

    /**
     * Get all the borrowable copies of this Book
     *
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getCopiesBorrowable()
    {
        return $this->copies->filter(function($copy) {
            return $copy->isBorrowable();
        });
    }

    /**
     * Get $user's copies of this Book
     *
     * @param  KekRozsak\SecurityBundle\Entity\User        $user
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getUsersCopies(User $user)
    {
        return $this->copies->filter(function ($copy) use ($user) {
                return ($copy->getOwner() == $user);
            });
    }

    /**
     * Get $user's borrowable copies of this Book
     *
     * @param  KekRozsak\SecurityBundle\Entity\User        $user
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getUsersCopiesBorrowable(User $user)
    {
        return $this->copies->filter(function($copy) use ($user) {
                return (($copy->getOwner() == $user) && $copy->isBorrowable());
            });
    }

    /**
     * Get $user's buyable copies of this Book
     *
     * @param  KekRozsak\SecurityBundle\Entity\User        $user
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getUsersCopiesBuyable(User $user)
    {
        return $this->copies->filter(function($copy) use ($user) {
                return (($copy->getOwner() == $user) && $copy->isBuyable());
            });
    }

    /**
     * The author of the Book
     *
     * @var string $author
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $author;

    /**
     * Set author
     *
     * @param  string $author
     * @return Book
     */
    public function setAuthor($author)
    {
        // TODO: Check if null!
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
     * The title of the Book
     *
     * @var string $title
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $title;

    /**
     * Set title
     *
     * @param  string $title
     * @return Book
     */
    public function setTitle($title)
    {
        // TODO: Check if null!
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
     * The Book's year of publication
     *
     * @var integer $year
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $year;

    /**
     * Set year
     *
     * @param  integer $year
     * @return Book
     */
    public function setYear($year)
    {
        // TODO: Check if null!
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
     * TRUE if comments can be written about the Book
     * @var boolean $commentable
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $commentable;

    /**
     * Set commentable
     *
     * @param  boolean $commentable
     * @return Book
     */
    public function setCommentable($commentable)
    {
        // TODO: Check if parameter is boolean!
        $this->commentable = $commentable;
        return $this;
    }

    /**
     * Get commentable
     *
     * @return boolean
     */
    public function isCommentable()
    {
        return $this->commentable;
    }

    /**
     * Collection of Users who would like to borrow a copy
     *
     * @var Doctrine\Common\Collections\ArrayCollection $wouldBorrow
     *
     * @ORM\ManyToMany(targetEntity="KekRozsak\SecurityBundle\Entity\User")
     * @ORM\JoinTable(name="book_would_borrow")
     */
    protected $wouldBorrow;

    /**
     * Add a user for want-to-borrowers
     *
     * @param  KekRozsak\SecurityBundle\Entity\User $user
     * @return Book
     */
    public function addWouldBorrow(User $user)
    {
        // TODO: Check if null!
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
     * Check if $user would like to borrow this book
     *
     * @param  KekRozsak\SecurityBundle\Entity\User $user
     * @return boolean
     */
    public function userWouldBorrow(User $user)
    {
        return $this->wouldBorrow->contains($user);
    }

    /**
     * Collection of Users who would like to buy a copy of this book
     *
     * @var Doctrine\Common\Collections\ArrayCollection $wouldBuy
     *
     * @ORM\ManyToMany(targetEntity="KekRozsak\SecurityBundle\Entity\User")
     * @ORM\JoinTable(name="book_would_buy")
     */
    protected $wouldBuy;

    /**
     * Add a user for want-to-buyers
     *
     * @param  KekRozsak\SecurityBundle\Entity\User $user
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
     * @param  KekRozsak\SecurityBundle\Entity\User $user
     * @return boolean
     */
    public function userWouldBuy(User $user)
    {
        return $this->wouldBuy->contains($user);
    }
}
