<?php

namespace App\Controller\User;

use App\Entity\User\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Service\User\UserService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class UserController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     * @Route("/about/me/{id}", name="about_me")
     */
    public function getUserAction (UserService $userService, $id)
        {/**
         * @var User $user
         */
        $doctrine = $this->getDoctrine();
        $user = $userService->getUserByID($id,$doctrine);
        $blog = $user->getBlog();
        return $this->render('about_me/about_me.html.twig', [
            'user' => $user->getUsername(),
            'blog' => $blog->getTitle()
        ]);
    }
}
