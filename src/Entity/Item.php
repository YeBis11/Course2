<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
#[ORM\HasLifecycleCallbacks()]
class Item
{
    use \App\Entity\Timestamps;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: ItemsCollection::class, inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    private $parent_collection;

    #[ORM\OneToMany(mappedBy: 'owningItem', targetEntity: StringField::class, cascade: ["persist", "remove"], fetch: 'EAGER', orphanRemoval: true )]
    private $stringFields;

    #[ORM\OneToMany(mappedBy: 'owning_item', targetEntity: TextField::class, cascade: ["persist", "remove"], fetch: 'EAGER', orphanRemoval: true)]
    private $textFields;

    #[ORM\OneToMany(mappedBy: 'owningItem', targetEntity: NumericField::class, cascade: ["persist", "remove"], fetch: 'EAGER', orphanRemoval: true)]
    private $numericFields;

    #[ORM\OneToMany(mappedBy: 'owningItem', targetEntity: DateField::class, cascade: ["persist", "remove"], fetch: 'EAGER', orphanRemoval: true)]
    private $dateFields;

    #[ORM\OneToMany(mappedBy: 'owningItem', targetEntity: BoolField::class, cascade: ["persist", "remove"], fetch: 'EAGER', orphanRemoval: true)]
    private $boolFields;

    public function __construct()
    {
        $this->stringFields = new ArrayCollection();
        $this->textFields = new ArrayCollection();
        $this->numericFields = new ArrayCollection();
        $this->dateFields = new ArrayCollection();
        $this->boolFields = new ArrayCollection();
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

    public function getParentCollection(): ?ItemsCollection
    {
        return $this->parent_collection;
    }

    public function setParentCollection(?ItemsCollection $parent_collection): self
    {
        $this->parent_collection = $parent_collection;

        return $this;
    }

    /**
     * @return Collection|StringField[]
     */
    public function getStringFields(): Collection
    {
        return $this->stringFields;
    }

    public function addStringField(StringField $stringField): self
    {
        if (!$this->stringFields->contains($stringField)) {
            $this->stringFields[] = $stringField;
            $stringField->setOwningItem($this);
        }

        return $this;
    }

    public function removeStringField(StringField $stringField): self
    {
        if ($this->stringFields->removeElement($stringField)) {
            // set the owning side to null (unless already changed)
            if ($stringField->getOwningItem() === $this) {
                $stringField->setOwningItem(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TextField[]
     */
    public function getTextFields(): Collection
    {
        return $this->textFields;
    }

    public function addTextField(TextField $textField): self
    {
        if (!$this->textFields->contains($textField)) {
            $this->textFields[] = $textField;
            $textField->setOwningItem($this);
        }

        return $this;
    }

    public function removeTextField(TextField $textField): self
    {
        if ($this->textFields->removeElement($textField)) {
            // set the owning side to null (unless already changed)
            if ($textField->getOwningItem() === $this) {
                $textField->setOwningItem(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NumericField[]
     */
    public function getNumericFields(): Collection
    {
        return $this->numericFields;
    }

    public function addNumericField(NumericField $numericField): self
    {
        if (!$this->numericFields->contains($numericField)) {
            $this->numericFields[] = $numericField;
            $numericField->setOwningItem($this);
        }

        return $this;
    }

    public function removeNumericField(NumericField $numericField): self
    {
        if ($this->numericFields->removeElement($numericField)) {
            // set the owning side to null (unless already changed)
            if ($numericField->getOwningItem() === $this) {
                $numericField->setOwningItem(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DateField[]
     */
    public function getDateFields(): Collection
    {
        return $this->dateFields;
    }

    public function addDateField(DateField $dateField): self
    {
        if (!$this->dateFields->contains($dateField)) {
            $this->dateFields[] = $dateField;
            $dateField->setOwningItem($this);
        }

        return $this;
    }

    public function removeDateField(DateField $dateField): self
    {
        if ($this->dateFields->removeElement($dateField)) {
            // set the owning side to null (unless already changed)
            if ($dateField->getOwningItem() === $this) {
                $dateField->setOwningItem(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BoolField[]
     */
    public function getBoolFields(): Collection
    {
        return $this->boolFields;
    }

    public function addBoolField(BoolField $boolField): self
    {
        if (!$this->boolFields->contains($boolField)) {
            $this->boolFields[] = $boolField;
            $boolField->setOwningItem($this);
        }

        return $this;
    }

    public function removeBoolField(BoolField $boolField): self
    {
        if ($this->boolFields->removeElement($boolField)) {
            // set the owning side to null (unless already changed)
            if ($boolField->getOwningItem() === $this) {
                $boolField->setOwningItem(null);
            }
        }

        return $this;
    }
}
