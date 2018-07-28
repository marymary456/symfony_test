<?php


namespace App\Service\User;
use App\Exception\User\UserNotFoundException;
use Doctrine\ORM\EntityManagerInterface;


interface UserServiceInterface
{
    /**
     * Get user by id.
     *
     * @throws UserNotFoundException
     *
     */
    public function getUserByID(int $id);

    /**
     * Get user by username.
     *
     * @throws UserNotFoundException
     *
     */
    public function getUserByUsername(string $username);

}