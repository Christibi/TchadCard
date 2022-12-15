<?php

namespace App\Entity;

use App\Repository\ElementDonneeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ElementDonneeRepository::class)]
class ElementDonnee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'elementdonnee', targetEntity: ElementDonneeValeur::class)]
    private Collection $elementDonneeValeurs;

    public function __construct()
    {
        $this->elementDonneeValeurs = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->libelle;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

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
            $elementDonneeValeur->setElementdonnee($this);
        }

        return $this;
    }

    public function removeElementDonneeValeur(ElementDonneeValeur $elementDonneeValeur): self
    {
        if ($this->elementDonneeValeurs->removeElement($elementDonneeValeur)) {
            // set the owning side to null (unless already changed)
            if ($elementDonneeValeur->getElementdonnee() === $this) {
                $elementDonneeValeur->setElementdonnee(null);
            }
        }

        return $this;
    }
}
