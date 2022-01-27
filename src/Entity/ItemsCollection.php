<?php

namespace App\Entity;

use App\Repository\ItemsCollectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ItemsCollectionRepository::class)]

#[UniqueEntity(
    fields: ['name', 'owner'],
    message: 'There is a collection with this name by this user.',
    errorPath: 'name',
)]
#[ORM\HasLifecycleCallbacks()]
class ItemsCollection
{
    use \App\Entity\Timestamps;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'itemsCollections')]
    #[ORM\JoinColumn(nullable: false)]
    private $owner;


    #[ORM\ManyToOne(targetEntity: CollectionCategory::class, fetch: 'EAGER', inversedBy: 'collections')]
    #[ORM\JoinColumn(nullable: false)]
    private $Category;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $string_property_name_1;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $string_property_name_2;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $string_property_name_3;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $text_property_name_1;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $text_property_name_3;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $text_property_name_2;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $date_property_name_1;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $date_property_name_2;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $date_property_name_3;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $numeric_property_name_1;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $numeric_property_name_2;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $numeric_property_name_3;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $bool_property_name_1;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $bool_property_name_2;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $bool_property_name_3;

    #[ORM\OneToMany(mappedBy: 'parent_collection', targetEntity: Item::class, cascade: ["persist", "remove"], orphanRemoval: true)]
    private $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }



    public function getCategory(): ?CollectionCategory
    {
        return $this->Category;
    }

    public function setCategory(?CollectionCategory $Category): self
    {
        $this->Category = $Category;

        return $this;
    }

    public function getStringPropertyName1(): ?string
    {
        return $this->string_property_name_1;
    }

    public function setStringPropertyName1(?string $string_property_name_1): self
    {
        $this->string_property_name_1 = $string_property_name_1;

        return $this;
    }

    public function getStringPropertyName2(): ?string
    {
        return $this->string_property_name_2;
    }

    public function setStringPropertyName2(?string $string_property_name_2): self
    {
        $this->string_property_name_2 = $string_property_name_2;

        return $this;
    }

    public function getStringPropertyName3(): ?string
    {
        return $this->string_property_name_3;
    }

    public function setStringPropertyName3(?string $string_property_name_3): self
    {
        $this->string_property_name_3 = $string_property_name_3;

        return $this;
    }

    public function getTextPropertyName1(): ?string
    {
        return $this->text_property_name_1;
    }

    public function setTextPropertyName1(?string $text_property_name_1): self
    {
        $this->text_property_name_1 = $text_property_name_1;

        return $this;
    }

    public function getTextPropertyName3(): ?string
    {
        return $this->text_property_name_3;
    }

    public function setTextPropertyName3(?string $text_property_name_3): self
    {
        $this->text_property_name_3 = $text_property_name_3;

        return $this;
    }

    public function getTextPropertyName2(): ?string
    {
        return $this->text_property_name_2;
    }

    public function setTextPropertyName2(?string $text_property_name_2): self
    {
        $this->text_property_name_2 = $text_property_name_2;

        return $this;
    }

    public function getDatePropertyName1(): ?string
    {
        return $this->date_property_name_1;
    }

    public function setDatePropertyName1(?string $date_property_name_1): self
    {
        $this->date_property_name_1 = $date_property_name_1;

        return $this;
    }

    public function getDatePropertyName2(): ?string
    {
        return $this->date_property_name_2;
    }

    public function setDatePropertyName2(?string $date_property_name_2): self
    {
        $this->date_property_name_2 = $date_property_name_2;

        return $this;
    }

    public function getDatePropertyName3(): ?string
    {
        return $this->date_property_name_3;
    }

    public function setDatePropertyName3(?string $date_property_name_3): self
    {
        $this->date_property_name_3 = $date_property_name_3;

        return $this;
    }

    public function getNumericPropertyName1(): ?string
    {
        return $this->numeric_property_name_1;
    }

    public function setNumericPropertyName1(?string $numeric_property_name_1): self
    {
        $this->numeric_property_name_1 = $numeric_property_name_1;

        return $this;
    }

    public function getNumericPropertyName2(): ?string
    {
        return $this->numeric_property_name_2;
    }

    public function setNumericPropertyName2(?string $numeric_property_name_2): self
    {
        $this->numeric_property_name_2 = $numeric_property_name_2;

        return $this;
    }

    public function getNumericPropertyName3(): ?string
    {
        return $this->numeric_property_name_3;
    }

    public function setNumericPropertyName3(?string $numeric_property_name_3): self
    {
        $this->numeric_property_name_3 = $numeric_property_name_3;

        return $this;
    }

    public function getBoolPropertyName1(): ?string
    {
        return $this->bool_property_name_1;
    }

    public function setBoolPropertyName1(?string $bool_property_name_1): self
    {
        $this->bool_property_name_1 = $bool_property_name_1;

        return $this;
    }

    public function getBoolPropertyName2(): ?string
    {
        return $this->bool_property_name_2;
    }

    public function setBoolPropertyName2(?string $bool_property_name_2): self
    {
        $this->bool_property_name_2 = $bool_property_name_2;

        return $this;
    }

    public function getBoolPropertyName3(): ?string
    {
        return $this->bool_property_name_3;
    }

    public function setBoolPropertyName3(?string $bool_property_name_3): self
    {
        $this->bool_property_name_3 = $bool_property_name_3;

        return $this;
    }

    public function getStringProperties(): ?array
    {
        return array_filter([
            $this->string_property_name_1,
            $this->string_property_name_2,
            $this->string_property_name_3,
            ]);
    }

    public function getTextProperties(): ?array
    {
        return [
            $this->text_property_name_1,
            $this->text_property_name_2,
            $this->text_property_name_3,
        ];
    }

    public function getBoolProperties(): ?array
    {
        return [
            $this->bool_property_name_1,
            $this->bool_property_name_2,
            $this->bool_property_name_3,
        ];
    }

    public function getNumericProperties(): ?array
    {
        return [
            $this->numeric_property_name_1,
            $this->numeric_property_name_2,
            $this->numeric_property_name_3,
        ];
    }

    public function getDateProperties(): ?array
    {
        return array_filter([
            $this->date_property_name_1,
            $this->date_property_name_2,
            $this->date_property_name_3,
        ]);
    }

    /**
     * @return Collection|Item[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setParentCollection($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getParentCollection() === $this) {
                $item->setParentCollection(null);
            }
        }

        return $this;
    }
}
