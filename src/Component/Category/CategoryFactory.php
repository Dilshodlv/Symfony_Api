<?php

declare (strict_types=1);

namespace App\Component\Category;

use App\Entity\Category;

class CategoryFactory
{
    public function create(string $name): Category
    {
        $category = new Category();
        $category->setName($name);
        return $category;
    }

}