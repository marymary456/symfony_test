<?php

namespace App\Entity\Blog;


use App\Entity\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\Blog\BlogRepository")
 */
class Blog
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */

    private $title;

    /**
     * @var array Post[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Blog\Post", mappedBy="blog")
     */

    private $posts;
    /**
     * @var User
     *
     * @ORM\OneToOne(targetEntity="App\Entity\User\User", inversedBy="blog")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */

    private $user;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getPosts()
    {
        return $this->posts;
    }

    public function addPost(Post $post)
    {
        $this->posts->add($post);
        return $this;
    }

    public function removePost(Post $post)
    {
        $this->posts->removeElement($post);
        return $this;
    }

    /**
     * @return User
     */

    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Blog
     */

    public function setUser(User $user): Blog
    {
        $this->user = $user;
        return $this;
    }
}
