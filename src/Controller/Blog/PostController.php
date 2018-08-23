<?php

namespace App\Controller\Blog;


use App\Entity\Blog\Comment;
use App\Entity\Blog\Post;
use App\Entity\User\User;
use App\Form\Blog\CommentType;
use App\Form\Blog\PostType;
use App\Service\Blog\BlogManager;
use App\Service\Blog\CommentService;
use App\Service\Blog\PostService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class PostController extends Controller
{

    private $blogManager;
    private $postService;
    private $commentService;

    public function __construct(BlogManager $blogManager, PostService $postService, CommentService $commentService)
    {
        $this->blogManager = $blogManager;
        $this->postService = $postService;
        $this->commentService = $commentService;
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @Route("/new/post", name="new_post")
     *
     */
    public function createPostAction(Request $request)
    {

        /**
         * @var User $user
         */
        $user = $this->getUser();

        $blog = $user->getBlog();
        $id = $blog->getId();

        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $title = $post->getTitle();
            $post->setTitle($title);

            $content = $post->getContent();
            $post->setContent($content);

            $postId = $this->blogManager->createPost($post, $id);

            return $this->redirectToRoute('get_post',[
                'postId' => $postId->getId()
            ]);
        }

        return $this->render('create_post/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/post/{postId}", name="get_post")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getPostById(Request $request, $postId)
    {
            $post = $this->blogManager->getPostById($postId);
            $comment = new Comment();
            $form = $this->createForm(CommentType::class,$comment);;
            $comments = $post->getComments();
            $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $text = $comment->getComment();
            $comment->setComment($text);

            $this->commentService->addComment($comment, $post);

            return $this->redirectToRoute('get_post', [
                'postId' => $postId
            ]);
        }
            if (!$comments) {
                $comments = [];
            }
            return $this->render('post/index.html.twig', [
                'post' => $post,
                'comments' => $comments,
                'form' => $form->createView()
            ]);

    }
}


