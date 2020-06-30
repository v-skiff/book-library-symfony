<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/book", name="book")
     */
    public function index()
    {
        $books = $this->getDoctrine()->getRepository(Book::class)->findAll();
//        dd($books[0]->getAuthor()->getName());
        $context['title'] = 'Books';
        $context['books'] = $books;

        return $this->render('book/index.html.twig', $context);
    }

    /**
     * @Route("/book/create", name="book_create")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($book);
            $em->flush();
            return $this->redirectToRoute('book');
        }

        $context['form'] = $form->createView();

        return $this->render('book/create.html.twig', $context);
    }
}
