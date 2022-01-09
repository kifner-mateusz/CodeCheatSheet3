<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\ProgrammingLanguageController;
use App\Repository\ProgrammingLanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgrammingLanguageRepository::class)]
#[ApiResource(itemOperations: [
    'get',
    // 'post',
    'put',
    'delete',
    'patch',
    // 'get_languages' => [
    //     'method' => 'get',
    //     'path' => '/languange',
    //     'controller' => ProgrammingLanguageController::class,
    
    // ]
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
