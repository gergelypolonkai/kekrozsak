<?php

namespace KekRozsak\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

use KekRozsak\FrontBundle\Entity\Book;
use KekRozsak\SecurityBundle\Entity\User;

/**
 * KekRozsak\FrontBundle\Entity\BookCopy
 * @ORM\Entity
 * @ORM\Table(name="book_copies", uniqueConstraints={
 *     @ORM\UniqueConstraint(columns={"owner_id", "book_id"})
 * })
 *
 * @DoctrineAssert\UniqueEntity(fields={"owner_id", "book_id"})
 */
class BookCopy
{
    public function __construct(Book $book, User $owner)
    {
        $this->book = $book;
        $this->owner = $owner;
        $this->borrowable = false;
        $this->buyable = false;
        $this->borrower = null;
        $this->borrowerReturned = true;
    }

    /**
     * The ID of the BookCopy
     *
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * The Book this BookCopy belongs to
     * @var KekRozsak\FrontBundle\Entity\Book $book
     *
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="copies")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $book;

    /**
     * The User this BookCopy belongs to
     *
     * @var KekRozsak\SecurityBundle\Entity\User $owner
     *
     * @ORM\ManyToOne(targetEntity="KekRozsak\SecurityBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $owner;

    /**
     * Get owner
     *
     * @return KekRozsak\SecurityBundle\Entity\User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * The owner's comment about this BookCopy's Book
     *
     * @var string $ownerComment
     *
     * @ORM\Column(type="text", name="owner_comment", nullable=true)
     */
    protected $ownerComment;

    /**
     * TRUE if this BookCopy is borrowable
     *
     * @var boolean $borrowable
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $borrowable;

    /**
     * Set borrowable
     *
     * @param boolean $borrowable
     * @return BookCopy
     */
    public function setBorrowable($borrowable)
    {
        // TODO: Check if parameter is boolean!
        $this->borrowable = $borrowable;
        return $this;
    }

    /**
     * Get borrowable
     *
     * @return boolean
     */
    public function isBorrowable()
    {
        return $this->borrowable;
    }

    /**
     * TRUE if this BookCopy is for sale
     *
     * @var boolean $buyable
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $buyable;

    /**
     * Set buyable
     *
     * @param boolean $buyable
     * @return BookCopy
     */
    public function setBuyable($buyable)
    {
        // Check if parameter is boolean!
        $this->buyable = $buyable;
        return $this;
    }

    /**
     * Get buyable
     *
     * @return boolean
     */
    public function isBuyable()
    {
        return $this->buyable;
    }

    /**
     * The User who is currently borrowing this BookCopy, or null
     *
     * @var KekRozsak\SecurityBundle\Entity\User $borrower
     *
     * @ORM\OneToOne(targetEntity="KekRozsak\SecurityBundle\Entity\User")
     */
    protected $borrower;

    /**
     * Get borrower
     *
     * @return KekRozsak\SecurityBundle\Entity\User
     */
    public function getBorrower()
    {
        return $this->borrower;
    }

    /**
     * TRUE if borrower says he/she returned this Copy to the owner
     * @var boolean $borrowerReturned
     *
     * @ORM\Column(type="boolean", nullable=false, name="borrower_returned")
     */
    protected $borrowerReturned;

    /**
     * Get borrowerReturned
     *
     * @return boolean
     */
    public function isBorrowerReturned()
    {
        return $this->borrowerReturned();
    }
}
