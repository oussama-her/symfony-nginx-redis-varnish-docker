<?php

namespace App\Entity;

use App\Repository\SymfonyReleaseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SymfonyReleaseRepository::class)]
class SymfonyRelease
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $isStable = false;

    #[ORM\Column]
    private ?bool $isLongTermSupport = false;

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

    public function isIsStable(): ?bool
    {
        return $this->isStable;
    }

    public function setIsStable(bool $isStable): self
    {
        $this->isStable = $isStable;

        return $this;
    }

    public function isIsLongTermSupport(): ?bool
    {
        return $this->isLongTermSupport;
    }

    public function setIsLongTermSupport(bool $isLongTermSupport): self
    {
        $this->isLongTermSupport = $isLongTermSupport;

        return $this;
    }
}
