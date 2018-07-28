<?php


namespace App\Service\Blog;


use App\Entity\Blog\Blog;
use App\Entity\Blog\Post;

interface PostServiceInterface
{
    public function create (Post $post, Blog $blog);

    /**
     * Get post by id.
     *
     */
    public function getPostByID (int $id);

    /**
     * Get all posts of blog.
     *
     */
    public function getAllPostsOfBlog ($blog);
}