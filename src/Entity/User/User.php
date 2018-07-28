<?php

        namespace App\Entity\User;

        use App\Entity\Blog\Blog;
        use Doctrine\ORM\Mapping as ORM;
        use Symfony\Component\Validator\Constraints as Assert;
        use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
        use Symfony\Component\Security\Core\User\UserInterface;
        use \JMS\Serializer\Annotation as Serializer;

        /**
        * @ORM\Entity(repositoryClass="App\Repository\User\UserRepository")
        * @UniqueEntity(fields="email", message="Email already taken")
        * @UniqueEntity(fields="username", message="Username already taken")
        */
        class User implements UserInterface
        {


            /**
            * @ORM\Id
            * @ORM\Column(type="integer")
            * @ORM\GeneratedValue(strategy="AUTO")
            */
            private $id;

            /**
            * @ORM\Column(type="string", length=255, unique=true)
            * @Assert\NotBlank()
            * @Assert\Email()
            */
            private $email;

            /**
            * @ORM\Column(type="string", length=255, unique=true)
            * @Assert\NotBlank()
            */
            private $username;

            /**
            * @Assert\NotBlank()
            * @Assert\Length(max=4096)
            */
            private $plainPassword;

            /**
            *
            * @ORM\Column(type="string", length=64)
            */
            private $password;

            /**
             * @ORM\Column(type="string", length=255, options={"default" : "ROLE_USER"})
             */
            private $role;

            /**
             * @var array Blog[]
             *
             * @ORM\OneToOne(targetEntity="App\Entity\Blog\Blog", mappedBy="user")
             */
            private $blog;

            /**
             * @return array
             */
            public function getBlog(): Blog
            {
                return $this->blog;
            }


            public function __construct()
            {
                $this->role = 'ROLE_USER';
            }

            /**
             * @return mixed
             */
            public function getId()
            {
                return $this->id;
            }

            /**
             * @param mixed $role
             */
            public function setRole($role): void
            {
                $this->role = $role;
            }


            public function getRole()
            {
                return $this->role;
            }

            public function getEmail()
            {
            return $this->email;
            }

            public function setEmail($email)
            {
            $this->email = $email;
            }

            public function getUsername()
            {
            return $this->username;
            }

            public function setUsername($username)
            {
            $this->username = $username;
            }

            public function getPlainPassword()
            {
            return $this->plainPassword;
            }

            public function setPlainPassword($password)
            {
            $this->plainPassword = $password;
            }

            public function getPassword()
            {
            return $this->password;
            }

            public function setPassword($password)
            {
            $this->password = $password;
            }

            public function getSalt()
            {
            return null;
            }

            public function getRoles()
            {
                return array('ROLE_USER');
            }

            public function eraseCredentials()
            {
                // TODO: Implement eraseCredentials() method.
            }


        }
