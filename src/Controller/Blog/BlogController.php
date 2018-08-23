<?php

namespace App\Controller\Blog;


use App\Entity\Blog\Blog;
use App\Entity\User\User;
use App\Form\Blog\BlogType;
use App\Form\Search\SearchType;
use App\Service\Blog\BlogManager;
use App\Service\Blog\PostService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class BlogController extends Controller
{

    private $blogManager;
    private $postService;
    private $searchType;



    public function __construct(BlogManager $blogManager, PostService $postService, SearchType $searchType)
    {
        $this->blogManager = $blogManager;
        $this->postService = $postService;
        $this->searchType = $searchType;


    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @Route("/create", name="create_blog")
     */
    public function CreateBlogAction(Request $request)
    {
        $blog = new Blog();
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $title = $blog->getTitle();
            $blog->setTitle($title);

            $user = $this->getUser();
            $blog->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($blog);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('create_blog/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/my/blog/{id}", name="my_blog")
     */
    public function getUserBlog ($id, Request $request){
        /**
         * @var Blog $blog;
         */
        $blog = $this->blogManager->getBlogByID($id);
        $posts = $this->postService->getAllPostsOfBlog($blog);

        return $this->render('my_blog/index.html.twig', [
            'blog' => $blog->getTitle(),
            'posts' => $posts]);

    }
}
