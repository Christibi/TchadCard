<?php

namespace App\Entity;

use App\Repository\ProvincesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProvincesRepository::class)]
class Provinces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Libelle = null;

    #[ORM\OneToMany(mappedBy: 'province', targetEntity: Education::class)]
    private Collection $education;

    #[ORM\OneToMany(mappedBy: 'provences', targetEntity: ElementDonneeValeur::class)]
    private Collection $elementDonneeValeurs;

    public function __construct()
    {
        $this->education = new ArrayCollection();
        $this->elementDonneeValeurs = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->Libelle;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(string $Libelle): self
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    /**
     * @return Collection<int, Education>
     */
    public function getEducation(): Collection
    {
        return $this->education;
    }

    public function addEducation(Education $education): self
    {
        if (!$this->education->contains($education)) {
            $this->education->add($education);
            $education->setProvince($this);
        }

        return $this;
    }

    public function removeEducation(Education $education): self
    {
        if ($this->education->removeElement($education)) {
            // set the owning side to null (unless already changed)
            if ($education->getProvince() === $this) {
                $education->setProvince(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ElementDonneeValeur>
     */
    public function getElementDonneeValeurs(): Collection
    {
        return $this->elementDonneeValeurs;
    }

    public function addElementDonneeValeur(ElementDonneeValeur $elementDonneeValeur): self
    {
        if (!$this->elementDonneeValeurs->contains($elementDonneeValeur)) {
            $this->elementDonneeValeurs->add($elementDonneeValeur);
            $elementDonneeValeur->setProvences($this);
        }

        return $this;
    }

    public function removeElementDonneeValeur(ElementDonneeValeur $elementDonneeValeur): self
    {
        if ($this->elementDonneeValeurs->removeElement($elementDonneeValeur)) {
            // set the owning side to null (unless already changed)
            if ($elementDonneeValeur->getProvences() === $this) {
                $elementDonneeValeur->setProvences(null);
            }
        }

        return $this;
    }
}
