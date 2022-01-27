<?php

namespace App\Entity;

use App\Repository\CollectionCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CollectionCategoryRepository::class)]

class CollectionCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'Category', targetEntity: ItemsCollection::class, orphanRemoval: true)]
    private $collections;

    public function __construct()
    {
        $this->collections = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|ItemsCollection[]
     */
    public function getCollections(): Collection
    {
        return $this->collections;
    }

    public function addCollection(ItemsCollection $collection): self
    {
        if (!$this->collections->contains($collection)) {
            $this->collections[] = $collection;
            $collection->setCategory($this);
        }

        return $this;
    }

    public function removeCollection(ItemsCollection $collection): self
    {
        if ($this->collections->removeElement($collection)) {
            // set the owning side to null (unless already changed)
            if ($collection->getCategory() === $this) {
                $collection->setCategory(null);
            }
        }

        return $this;
    }
}
