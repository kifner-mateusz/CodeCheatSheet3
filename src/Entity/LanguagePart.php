<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\ProgrammingLanguageController;
use App\Repository\LanguagePartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguagePartRepository::class)]
#[ApiResource(collectionOperations: [
    "get",
    "post" => ["security" => "is_granted('IS_AUTHENTICATED_FULLY')"],
],
itemOperations: [
    'get',
    "put" => ["security" => "is_granted('IS_AUTHENTICATED_FULLY')"],
    'delete' => ["security" => "is_granted('IS_AUTHENTICATED_FULLY')"],
    'patch' => ["security" => "is_granted('IS_AUTHENTICATED_FULLY')"] ,
    ]

)]
class LanguagePart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'language_part', targetEntity: PartField::class, orphanRemoval: true)]
    private $fields;

    #[ORM\ManyToOne(targetEntity: ProgrammingLanguage::class, inversedBy: 'parts')]
    #[ORM\JoinColumn(nullable: false)]
    private $programming_language;

    public function __construct()
    {
        $this->fields = new ArrayCollection();
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
     * @return Collection|PartField[]
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }

    public function addField(PartField $field): self
    {
        if (!$this->fields->contains($field)) {
            $this->fields[] = $field;
            $field->setLanguagePart($this);
        }

        return $this;
    }

    public function removeField(PartField $field): self
    {
        if ($this->fields->removeElement($field)) {
            // set the owning side to null (unless already changed)
            if ($field->getLanguagePart() === $this) {
                $field->setLanguagePart(null);
            }
        }

        return $this;
    }

    public function getProgrammingLanguage(): ?ProgrammingLanguage
    {
        return $this->programming_language;
    }

    public function setProgrammingLanguage(?ProgrammingLanguage $programming_language): self
    {
        $this->programming_language = $programming_language;

        return $this;
    }
}
