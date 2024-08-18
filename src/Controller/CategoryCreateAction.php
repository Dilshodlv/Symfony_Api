<?php

declare(strict_types=1);

namespace App\Controller;

use App\Component\Category\CategoryFactory;
use App\Component\Category\CategoryManager;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryCreateAction extends AbstractController
{
    public function __construct(private readonly CategoryFactory $categoryFactory,private readonly CategoryManager $categoryManager)
    {
    }

    public function __invoke(Category $data): Category
    {
        $category = $this->categoryFactory->create(
            $data->getName(),
        );
        $this->categoryManager->save($category,true);
        return $category;
    }
}
