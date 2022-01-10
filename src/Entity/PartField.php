<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PartFieldRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartFieldRepository::class)]
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
class PartField
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $short;

    #[ORM\Column(type: 'string', length: 4096, nullable: true)]
    private $content;

    #[ORM\ManyToOne(targetEntity: LanguagePart::class, inversedBy: 'fields')]
    #[ORM\JoinColumn(nullable: false)]
    private $language_part;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShort(): ?string
    {
        return $this->short;
    }

    public function setShort(string $short): self
    {
        $this->short = $short;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getLanguagePart(): ?LanguagePart
    {
        return $this->language_part;
    }

    public function setLanguagePart(?LanguagePart $language_part): self
    {
        $this->language_part = $language_part;

        return $this;
    }
}
