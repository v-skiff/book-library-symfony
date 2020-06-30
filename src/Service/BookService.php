<?php

namespace App\Service;

use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

class BookService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var BookRepository
     */
    private $bookRepository;
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(EntityManagerInterface $entityManager, BookRepository $bookRepository, PaginatorInterface $paginator)
    {
        $this->entityManager = $entityManager;
        $this->bookRepository = $bookRepository;
        $this->paginator = $paginator;
    }

    public function getBooks(int $page)
    {
        $queryBuilder = $this->bookRepository->getWithQueryBuilder();

        return $this->paginator->paginate(
            $queryBuilder,
            $page,
            10
        );
    }
}