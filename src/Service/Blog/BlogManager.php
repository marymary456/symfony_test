<?php


namespace App\Service\Blog;


use App\Entity\Blog\Blog;
use App\Entity\Blog\Comment;
use App\Entity\Blog\Post;
use App\Entity\User\User;
use App\Exception\Blog\BlogNotFoundException;
use App\Exception\User\UserNotFoundException;
use App\Repository\Blog\BlogRepository;
use App\Service\User\UserService;
use Doctrine\Common\Persistence\ManagerRegistry;

class BlogManager implements BlogManagerInterface
{
    private $userService;
    private $postService;
    private $commentService;
    private $blogRepository;


    public function __construct(UserService $userService, PostService $postService, CommentService $commentService, BlogRepository $blogRepository)
    {

        $this->userService = $userService;
        $this->postService = $postService;
        $this->commentService = $commentService;
        $this->blogRepository = $blogRepository;

    }

    /**
     * Get blog by id.
     *
     * @throws BlogNotFoundException
     *
     */
    public function getBlogByID (int $id){

        $blog = $this->blogRepository->find($id);
        if (!$blog) {
            throw new BlogNotFoundException('Blog not found');
        }

        return $blog;
    }

    /**
     * Get blog by title.
     *
     * @throws BlogNotFoundException
     *
     */
    public function getBlogByTitle (string $title)
    {
        $blog =$this->blogRepository->findOneBy(['title' => $title]);
        if (!$blog) {
            throw new BlogNotFoundException('Blog not found');
        }

        return $blog;
    }

    /**
     * Get blog by user_id.
     *
     * @throws UserNotFoundException
     * @throws BlogNotFoundException
     *
     */
    public function getBlogByUserID (int $id)
    {    /**
         * @var User $user
         */
        $user = $this->userService->getUserByID($id);

        if (!$user) {
            throw new UserNotFoundException('User not found');
        }

        $blog = $user->getBlog();

        if (!$blog){
            throw new BlogNotFoundException('Blog not found');
        }
        return $blog;
    }

    public function createPost(Post $post, $id)
    {
        $blog = $this->getBlogByID($id);

        $post = $this->postService->create($post, $blog);

        return $post;
    }

    public function getPostById($id): Post
    {
        return $this->postService->getPostById($id);
    }

    public function getPostsForBlog()
    {
        return $this->postService->getAllPosts();
    }


    public function addComment(Comment $comment, Post $post)
    {
        $this->commentService->addComment($comment, $post);
    }
}
