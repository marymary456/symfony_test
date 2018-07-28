<?php

namespace App\Exception\Post;


class PostNotFoundException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}