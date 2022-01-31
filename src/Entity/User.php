<?php

namespace App\Entity;

use App\Entity\Timestamps;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: "app.user")]
#[ORM\HasLifecycleCallbacks()]
#[UniqueEntity('email')]
#[UniqueEntity(
    fields: 'username',
    message: 'This username is already used.',
    errorPath: 'username',
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use \App\Entity\Timestamps;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 255)]
    private $username;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: ItemsCollection::class, fetch: 'EAGER', orphanRemoval: true)]
    private $itemsCollections;


    #[ORM\Column(type: 'boolean')]

    private $isVerified = false;

    public function __construct()
    {
        $this->itemsCollections = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }
    public function getName(): string
    {
        return (string) $this->username;
    }
    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
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
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection|ItemsCollection[]
     */
    public function getItemsCollections(): Collection
    {
        return $this->itemsCollections;
    }

    public function addItemsCollection(ItemsCollection $itemsCollection): self
    {
        if (!$this->itemsCollections->contains($itemsCollection)) {
            $this->itemsCollections[] = $itemsCollection;
            $itemsCollection->setOwner($this);
        }

        return $this;
    }

    public function removeItemsCollection(ItemsCollection $itemsCollection): self
    {
        if ($this->itemsCollections->removeElement($itemsCollection)) {
            // set the owning side to null (unless already changed)
            if ($itemsCollection->getOwner() === $this) {
                $itemsCollection->setOwner(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
