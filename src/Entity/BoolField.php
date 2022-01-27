<?php

namespace App\Entity;

use App\Repository\BoolFieldRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BoolFieldRepository::class)]
class BoolField
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $data;

    #[ORM\ManyToOne(targetEntity: Item::class, inversedBy: 'boolFields')]
    #[ORM\JoinColumn(nullable: false)]
    private $owningItem;

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

    public function getData(): ?bool
    {
        return $this->data;
    }

    public function setData(?bool $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getOwningItem(): ?Item
    {
        return $this->owningItem;
    }

    public function setOwningItem(?Item $owningItem): self
    {
        $this->owningItem = $owningItem;

        return $this;
    }
}
