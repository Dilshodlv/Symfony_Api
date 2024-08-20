<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetBooksByCategoryAction extends AbstractController
{
    public function __invoke(Request $request, BookRepository $bookRepository): array
    {
        $categoryId = $request->query->get('categoryId');

        if (!$categoryId) {
            throw new NotFoundHttpException('Category not found');
        }
        return $bookRepository->findBy(['category' => (int)$categoryId]);
    }
}
