<?php

declare (strict_types=1);

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class AboutMeAction extends AbstractController
{
    public function __invoke(#[CurrentUser]User $user): User
    {
        return $user;
    }

}