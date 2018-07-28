<?php

namespace App\Controller\Search;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Service\User\UserService;
use Symfony\Component\Routing\Annotation\Route;




class SearchController extends Controller
{


    /**
     * @Route("/search/byUsername/{search}", name="search_username")
     */
    public function searchByUsernameAction ($search, UserService $userService) {

        $user = $userService->getUserByUsername($search);

        return $this->render('search/index.html.twig',
            ['user' => $user]);
    }

}
