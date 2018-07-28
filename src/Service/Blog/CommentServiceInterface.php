<?php


namespace App\Service\Blog;


use App\Entity\Blog\Comment;
use App\Entity\Blog\Post;

interface CommentServiceInterface
{
    public function addComment(Comment $comment, Post $post);
}