<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Service\AuthorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    /**
     * @Route("/author", name="author")
     * @param Request $request
     * @param AuthorService $authorService
     * @return Response
     */
    public function index(Request $request, AuthorService $authorService)
    {
        $page = $request->query->getInt('page', 1);
        $authors = $authorService->getAuthors($page);

        $context['title'] = 'Authors';
        $context['pagination'] = $authors;

        return $this->render('author/index.html.twig', $context);
    }

    /**
     * @Route("/author/create", name="author_create")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($author);
            $em->flush();
            return $this->redirectToRoute('author');
        }

        $context['form'] = $form->createView();

        return $this->render('author/create.html.twig', $context);
    }
}
