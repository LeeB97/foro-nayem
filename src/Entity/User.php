<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombrecompleto;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Publicacion", mappedBy="user")
     */
    private $publicacaion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comentario", mappedBy="user", orphanRemoval=true)
     */
    private $comentario;

    public function __construct()
    {
        $this->publicacaion = new ArrayCollection();
        $this->comentario = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNombrecompleto(): ?string
    {
        return $this->nombrecompleto;
    }

    public function setNombrecompleto(?string $nombrecompleto): self
    {
        $this->nombrecompleto = $nombrecompleto;

        return $this;
    }

    /**
     * @return Collection|Publicacion[]
     */
    public function getPublicacaion(): Collection
    {
        return $this->publicacaion;
    }

    public function addPublicacaion(Publicacion $publicacaion): self
    {
        if (!$this->publicacaion->contains($publicacaion)) {
            $this->publicacaion[] = $publicacaion;
            $publicacaion->setUser($this);
        }

        return $this;
    }

    public function removePublicacaion(Publicacion $publicacaion): self
    {
        if ($this->publicacaion->contains($publicacaion)) {
            $this->publicacaion->removeElement($publicacaion);
            // set the owning side to null (unless already changed)
            if ($publicacaion->getUser() === $this) {
                $publicacaion->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comentario[]
     */
    public function getComentario(): Collection
    {
        return $this->comentario;
    }

    public function addComentario(Comentario $comentario): self
    {
        if (!$this->comentario->contains($comentario)) {
            $this->comentario[] = $comentario;
            $comentario->setUser($this);
        }

        return $this;
    }

    public function removeComentario(Comentario $comentario): self
    {
        if ($this->comentario->contains($comentario)) {
            $this->comentario->removeElement($comentario);
            // set the owning side to null (unless already changed)
            if ($comentario->getUser() === $this) {
                $comentario->setUser(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->username;
    }
}
