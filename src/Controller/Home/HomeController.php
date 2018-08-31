<?php

namespace App\Controller\Home;


use App\Entity\Blog\Post;
use App\Form\Search\SearchType;
use App\Repository\Blog\PostRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\Blog\PostService;

class HomeController extends Controller
{

    private $postService;
    private $postRepository;


    /**
     * HomeController constructor.
     * @param $postService
     */
    public function __construct(PostService $postService, PostRepository $postRepository)
    {
        $this->postService = $postService;
        $this->postRepository = $postRepository;
    }


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

        $posts = $this->postRepository->findBy(
            [],
            ['id' => 'DESC']);



        return $this->render('home/index.html.twig',
            ['form' => $form->createView(),
             'posts' => $posts]);
    }
}
