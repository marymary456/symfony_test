<?php

namespace App\Service\Blog;


use App\Entity\Blog\Comment;
use App\Entity\Blog\Post;
use Doctrine\ORM\EntityManagerInterface;

class CommentService implements CommentServiceInterface
{
    private $entityManager;

    /**
     * CommentService constructor.
     * @param $entityManager
     */
    public function __construct( EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function addComment(Comment $comment, Post $post)
    {
        $post->addComment($comment);
        $comment->setPost($post);
        $this->entityManager->persist($comment);
        $this->entityManager->flush();
    }
}