<?php

namespace App\Entity;

use App\Repository\ElementDonneeValeurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ElementDonneeValeurRepository::class)]
class ElementDonneeValeur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'elementDonneeValeurs')]
    private ?ElementDonnee $elementdonnee = null;

    #[ORM\ManyToOne(inversedBy: 'elementDonneeValeurs')]
    private ?Provinces $provences = null;

    #[ORM\Column(nullable: true)]
    private ?int $value = null;

    // #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    // private ?\DateTimeInterface $datedata = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $date = null;
    
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sexe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getElementdonnee(): ?ElementDonnee
    {
        return $this->elementdonnee;
    }

    public function setElementdonnee(?ElementDonnee $elementdonnee): self
    {
        $this->elementdonnee = $elementdonnee;

        return $this;
    }

    public function getProvences(): ?Provinces
    {
        return $this->provences;
    }

    public function setProvences(?Provinces $provences): self
    {
        $this->provences = $provences;

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(?int $value): self
    {
        $this->value = $value;

        return $this;
    }

    // public function getDatedata(): ?\DateTimeInterface
    // {
    //     return $this->datedata;
    // }

    // public function setDatedata(?\DateTimeInterface $datedata): self
    // {
    //     $this->datedata = $datedata;

    //     return $this;
    // }

    public function getDatedata(): ?string
    {
        return $this->date;
    }

    public function setDatedata(?string $date): self
    {
        $this->date = $date;

        return $this;
    }
    
    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }
}
