<?php

namespace App\Entity;

use App\Repository\TextFieldRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TextFieldRepository::class)]
class TextField
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private $data;

    #[ORM\ManyToOne(targetEntity: Item::class, inversedBy: 'textFields')]
    #[ORM\JoinColumn(nullable: false)]
    private $owning_item;

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

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(?string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getOwningItem(): ?Item
    {
        return $this->owning_item;
    }

    public function setOwningItem(?Item $owning_item): self
    {
        $this->owning_item = $owning_item;

        return $this;
    }
}
