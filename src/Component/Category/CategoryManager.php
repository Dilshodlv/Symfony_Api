<?php

declare (strict_types=1);

namespace App\Component\Category;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

readonly class CategoryManager
{

    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function save(Category $category,bool $isNeedSave): void
    {
        $this->entityManager->persist($category);
        if($isNeedSave) {
            $this->entityManager->flush();
        }
    }
}