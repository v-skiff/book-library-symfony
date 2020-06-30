<?php

namespace App\Service;

use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

class AuthorService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var AuthorRepository
     */
    private $authorRepository;
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(EntityManagerInterface $entityManager, AuthorRepository $authorRepository, PaginatorInterface $paginator)
    {
        $this->entityManager = $entityManager;
        $this->authorRepository = $authorRepository;
        $this->paginator = $paginator;
    }

    public function getAuthors(int $page)
    {
        $queryBuilder = $this->authorRepository->getWithQueryBuilder();

        return $this->paginator->paginate(
            $queryBuilder,
            $page,
            10
        );
    }
}