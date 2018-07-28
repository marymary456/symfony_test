<?php


namespace App\Service\Blog;


use App\Entity\Blog\Comment;
use App\Entity\Blog\Post;

interface BlogManagerInterface
{
    /**
     * Get blog by id.
     *
     */
    public function getBlogByID (int $id);

    /**
     * Get blog by title.
     *
     */
    public function getBlogByTitle (string $title);

    /**
     * Get blog by user_id.
     *
     */
    public function getBlogByUserID (int $id);

    public function createPost(Post $post, $id);

    public function getPostById($id): Post;

    public function getPostsForBlog();

    public function addComment(Comment $comment, Post $post);


}