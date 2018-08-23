<?php


namespace App\Service\Blog;



use App\Entity\Blog\Blog;
use App\Entity\Blog\Post;
use App\Exception\Post\PostNotFoundException;
use App\Repository\Blog\BlogRepository;
use App\Repository\Blog\PostRepository;
use Doctrine\ORM\EntityManagerInterface;

class PostService implements PostServiceInterface
{
 private $postRepository;
 private $entityManager;
 private $blogRepository;

    /**
     * PostService constructor.
     * @param $blogRepository
     */
    public function __construct( BlogRepository $blogRepository, PostRepository $postRepository, EntityManagerInterface $entityManager)
    {
        $this->postRepository = $postRepository;
        $this->entityManager = $entityManager;
        $this->blogRepository = $blogRepository;
    }


    public function create (Post $post, Blog $blog){
        $blog->addPost($post);
        $post->setBlog($blog);

        $this->entityManager->persist($post);
        $this->entityManager->flush();

        return $post;
    }

    /**
     * Get post by id.
     *
     * @throws PostNotFoundException
     *
     */
    public function getPostByID (int $id){
        $post = $this->postRepository->find($id);
        if (!$post) {
            throw new PostNotFoundException('Post not found');
        }

        return $post;
    }

    /**
     * Get all posts of blog.
     *
     */
    public function getAllPostsOfBlog ($blog)
    {
        /**
         * @var Blog $blog;
         */
        $posts = $blog->getPosts();
        return $posts;
    }

    public function getAllPosts()
    {
        $posts = $this->postRepository->findAll();
        return $posts;
    }
}