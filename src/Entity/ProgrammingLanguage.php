<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\ProgrammingLanguageController;
use App\Repository\ProgrammingLanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgrammingLanguageRepository::class)]
#[ApiResource(collectionOperations: [
    "get",
    "post" => ["security" => "is_granted('IS_AUTHENTICATED_FULLY')"],
    "api_languages_get" => ["route_name"=>"api_languages_get"],
    "api_languages_get_language_parts" => ["route_name"=>"api_languages_get_language_parts"],
    "api_languages_get_language_fields" => ["route_name"=>"api_languages_get_language_fields"]

],
itemOperations: [
    'get',
    "put" => ["security" => "is_granted('IS_AUTHENTICATED_FULLY')"],
    'delete' => ["security" => "is_granted('IS_AUTHENTICATED_FULLY')"],
    'patch' => ["security" => "is_granted('IS_AUTHENTICATED_FULLY')"] ,
    ]

)]
class ProgrammingLanguage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'programming_language', targetEntity: LanguagePart::class, orphanRemoval: true)]
    private $parts;

    public function __construct()
    {
        $this->parts = new ArrayCollection();
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
     * @return Collection|LanguagePart[]
     */
    public function getParts(): Collection
    {
        return $this->parts;
    }

    public function addPart(LanguagePart $part): self
    {
        if (!$this->parts->contains($part)) {
            $this->parts[] = $part;
            $part->setProgrammingLanguage($this);
        }

        return $this;
    }

    public function removePart(LanguagePart $part): self
    {
        if ($this->parts->removeElement($part)) {
            // set the owning side to null (unless already changed)
            if ($part->getProgrammingLanguage() === $this) {
                $part->setProgrammingLanguage(null);
            }
        }

        return $this;
    }
}
