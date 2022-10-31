<?php

namespace App\Entity;

use App\Repository\TchadCardTableRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TchadCardTableRepository::class)]
class TchadCardTable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $regions = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $idRegion = null;

    #[ORM\Column(nullable: true)]
    private ?int $populations = null;

    #[ORM\Column(nullable: true)]
    private ?int $threshold = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegions(): ?string
    {
        return $this->regions;
    }

    public function setRegions(?string $regions): self
    {
        $this->regions = $regions;

        return $this;
    }

    public function getIdRegion(): ?string
    {
        return $this->idRegion;
    }

    public function setIdRegion(?string $idRegion): self
    {
        $this->idRegion = $idRegion;

        return $this;
    }

    public function getPopulations(): ?int
    {
        return $this->populations;
    }

    public function setPopulations(?int $populations): self
    {
        $this->populations = $populations;

        return $this;
    }

    public function getThreshold(): ?int
    {
        return $this->threshold;
    }

    public function setThreshold(?int $threshold): self
    {
        $this->threshold = $threshold;

        return $this;
    }
}
