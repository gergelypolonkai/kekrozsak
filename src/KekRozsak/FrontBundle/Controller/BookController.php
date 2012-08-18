<?php

namespace KekRozsak\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;

use KekRozsak\FrontBundle\Entity\Book;
use KekRozsak\FrontBundle\Entity\BookCopy;
use KekRozsak\FrontBundle\Form\Type\BookType;

class BookController extends Controller
{
    /**
     * @Route("/konyvtar", name="KekRozsakFrontBundle_bookList", options={"expose" = true})
     * @Template()
     */
    public function listAction()
    {
        $query = $this->getDoctrine()->getEntityManager()->createQuery('SELECT b FROM KekRozsakFrontBundle:Book b ORDER BY b.author ASC, b.title ASC, b.year ASC');

        $books = $query->getResult();

        return array(
            'books' => $books,
        );
    }

    /**
     * @Route("/konyvtar/uj-konyv.html", name="KekRozsakFrontBundle_bookNew", options={"expose" = true})
     * @Template()
     */
    public function newAction()
    {
        $book = new Book();
        $newBookForm = $this->createForm(new BookType(), $book);
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $newBookForm->bindRequest($request);
            if ($newBookForm->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($book);
                $em->flush();

                return new Response('success');
            }
        }

        return array(
            'form'  => $newBookForm->createView(),
        );
    }

    /**
     * @Route("/sugo/konyvtar-lista.html", name="KekRozsakFrontBundle_bookListHelp")
     * @Template()
     */
    public function listHelpAction()
    {
        return array();
    }

    /**
     * @Route("/konyvadat/{id}/ajax.{_format}", name="KekRozsakFrontBundle_bookAjaxData", defaults={"_format": "html"}, options={"expose": true})
     * @Template()
     * @ParamConverter("book")
     *
     * @param KekRozsak\FrontBundle\Entity\Book $book
     */
    public function ajaxDataAction(Book $book)
    {
        return array(
            'book' => $book,
        );
    }

    /**
     * @Route("/konyv/torles/{id}", name="KekRozsakFrontBundle_bookDeleteCopy", requirements={"id": "\d+"}, options={"expose": true})
     * @ParamConverter("book")
     *
     * @param KekRozsak\FrontBundle\Entity\Book $book
     */
    public function ajaxDeleteBookAction(Book $book)
    {
        $copies = $book->getUsersCopies($this->get('security.context')->getToken()->getUser());
        $em = $this->getDoctrine()->getEntityManager();
        $copies->forAll(function($key, $copy) use ($book, $em) {
            $book->removeCopy($copy);
            $em->remove($copy);
        });
        $em->persist($book);
        $em->flush();

        return new Response();
    }

    /**
     * @Route("/konyv/ujpeldany/{id}", name="KekRozsakFrontBundle_bookAddCopy", requirements={"id": "\d+"}, options={"expose": true})
     * @ParamConverter("book")
     *
     * @param KekRozsak\FrontBundle\Entity\Book $book
     */
    public function ajaxAddCopyAction(Book $book)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $copies = $book->getUsersCopies($user);
        if ($copies->count() == 0) {
            $copy = new BookCopy($book, $user);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($copy);
            $em->flush();
        }

        return new Response();
    }

    /**
     * @Route("/konyv/kolcsonozheto/{id}/{newValue}", name="KekRozsakFrontBundle_bookSetCopyBorrowable", requirements={"id": "\d+"}, options={"expose": true})
     * @ParamConverter("book")
     *
     * @param KekRozsak\FrontBundle\Entity\Book $book
     * @param boolean                           $newValue
     */
    public function ajaxSetBookCopyBorrowableAction(Book $book, $newValue)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $copies = $book->getUsersCopies($user);
        $em = $this->getDoctrine()->getEntityManager();
        $copies->forAll(function($key, $copy) use ($em, $newValue) {
            $copy->setBorrowable($newValue);
            $em->persist($copy);
        });
        $em->flush();

        return new Response();
    }

    /**
     * @Route("/konyv/megveheto/{id}/{newValue}", name="KekRozsakFrontBundle_bookSetCopyForSale", requirements={"id": "\d+"}, options={"expose": true})
     * @ParamConverter("book")
     *
     * @param KekRozsak\FrontBundle\Entity\Book $book
     * @param boolean                           $newValue
     */
    public function ajaxSetBookCopyForSaleAction(Book $book, $newValue)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $copies = $book->getUsersCopies($user);
        $em = $this->getDoctrine()->getEntityManager();
        $copies->forAll(function($key, $copy) use ($em, $newValue) {
            $copy->setBuyable($newValue);
            $em->persist($copy);
        });
        $em->flush();

        return new Response();
    }

    /**
     * @Route("/konyv/szeretnek/{id}/{wantToBuy}", name="KekRozsakFrontBundle_bookWantOne", requirements={"id": "\d+"}, options={"expose": true})
     * @ParamConverter("book")
     *
     * @param KekRozsak\FrontBundle\Entity\Book $book
     * @param boolean                           $wantToBuy
     */
    public function ajaxWantABookAction(Book $book, $wantToBuy)
    {
        $user = $this->get('security.context')->getToken()->getUser();

        if ($wantToBuy) {
            $book->addWouldBuy($user);
        } else {
            $book->addWouldBorrow($user);
        }

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($book);
        $em->flush();

        return new Response();
    }
}
