<?php


namespace App\Service\User;


use App\Entity\User\User;
use App\Exception\User\UserNotFoundException;
use App\Repository\Blog\BlogRepository;
use App\Repository\User\UserRepository;
use Doctrine\Common\Persistence\ManagerRegistry;



class UserService implements UserServiceInterface
{
    private $doctrine;
    private $userRepository;


    public function __construct(ManagerRegistry $doctrine, UserRepository $userRepository)
    {
        $this->doctrine = $doctrine;
        $this->userRepository = $userRepository;

    }

        /**
         * Get user by id.
         *
         * @throws UserNotFoundException
         *
         */
    public function getUserByID(int $id)
    {

        $user = $this->userRepository
            ->find($id);

        if (!$user) {
            throw new UserNotFoundException('User not found');
        }

        return $user;

    }

        /**
         * Get user by username.
         *
         * @throws UserNotFoundException
         *
         */
      public function getUserByUsername(string $username)
    {

       $user = $this->userRepository->findOneBy(['username' => $username]);

        if (!$user) {
            throw new UserNotFoundException('User not found');
        }

        return $user;
    }

}

