<?php

namespace App\Controller\Home;


use App\Form\Search\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function number(Request $request)
    {

        $form = $this->createForm(SearchType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            return $this->redirectToRoute('search_username', ['search' => $data['search']]);
        }


        return $this->render('home/index.html.twig',
            ['form' => $form->createView()]);
    }
}
