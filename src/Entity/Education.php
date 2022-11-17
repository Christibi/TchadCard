<?php

namespace App\Entity;

use App\Repository\EducationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EducationRepository::class)]
class Education
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $Nbrefe = null;

    #[ORM\Column(nullable: true)]
    private ?int $Nbreh = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Source = null;

    #[ORM\ManyToOne(inversedBy: 'education')]
    private ?Niveau $niveau = null;

    #[ORM\ManyToOne(inversedBy: 'education')]
    private ?Indicateur $indicateur = null;

    #[ORM\ManyToOne(inversedBy: 'education')]
    private ?Provinces $province = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $annee = null;

    #[ORM\ManyToOne(inversedBy: 'education')]
    private ?Status $status = null;

    #[ORM\ManyToOne(inversedBy: 'education')]
    private ?CategorieVulnerabilite $categorieVulnerabilite = null;

    #[ORM\ManyToOne(inversedBy: 'education')]
    private ?TrancheAge $trangeAge = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $milieu = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $langue = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbreFe(): ?int
    {
        return $this->Nbrefe;
    }

    public function setNbreFe(?int $Nbrefe): self
    {
        $this->Nbrefe = $Nbrefe;

        return $this;
    }

    public function getNbreH(): ?int
    {
        return $this->Nbreh;
    }

    public function setNbreH(?int $Nbreh): self
    {
        $this->Nbreh = $Nbreh;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->Source;
    }

    public function setSource(?string $Source): self
    {
        $this->Source = $Source;

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getIndicateur(): ?Indicateur
    {
        return $this->indicateur;
    }

    public function setIndicateur(?Indicateur $indicateur): self
    {
        $this->indicateur = $indicateur;

        return $this;
    }

    public function getProvince(): ?Provinces
    {
        return $this->province;
    }

    public function setProvince(?Provinces $province): self
    {
        $this->province = $province;

        return $this;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(?string $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCategorieVulnerabilite(): ?CategorieVulnerabilite
    {
        return $this->categorieVulnerabilite;
    }

    public function setCategorieVulnerabilite(?CategorieVulnerabilite $categorieVulnerabilite): self
    {
        $this->categorieVulnerabilite = $categorieVulnerabilite;

        return $this;
    }

    public function getTrangeAge(): ?TrancheAge
    {
        return $this->trangeAge;
    }

    public function setTrangeAge(?TrancheAge $trangeAge): self
    {
        $this->trangeAge = $trangeAge;

        return $this;
    }

    public function getMilieu(): ?string
    {
        return $this->milieu;
    }

    public function setMilieu(?string $milieu): self
    {
        $this->milieu = $milieu;

        return $this;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(?string $langue): self
    {
        $this->langue = $langue;

        return $this;
    }
}
