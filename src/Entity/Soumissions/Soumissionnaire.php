<?php

namespace App\Entity\Soumissions;

use App\Repository\Soumissions\SoumissionnaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SoumissionnaireRepository::class)
 */
class Soumissionnaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $numeroIfu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $designationEntreprise;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $sigleEntreprise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresseEntreprise;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $descriptionEntreprise;

    /**
     * @ORM\OneToMany(targetEntity=SoumissionMarche::class, mappedBy="soumissionnaire", orphanRemoval=true)
     */
    private $associationSoumission;

    /**
     * @ORM\OneToMany(targetEntity=OffreMarche::class, mappedBy="soumissionnaire", orphanRemoval=true)
     */
    private $associationOffre;

    public function __construct()
    {
        $this->associationSoumission = new ArrayCollection();
        $this->associationOffre = new ArrayCollection();
    }


    /**
     * @return Collection|SoumissionMarche[]
     */
    public function getAssociationSoumission(): Collection
    {
        return $this->associationSoumission;
    }

    public function addAssociationSoumission(SoumissionMarche $associationSoumission): self
    {
        if (!$this->associationSoumission->contains($associationSoumission)) {
            $this->associationSoumission[] = $associationSoumission;
            $associationSoumission->setSoumissionnaire($this);
        }

        return $this;
    }

    public function removeAssociationSoumission(SoumissionMarche $associationSoumission): self
    {
        if ($this->associationSoumission->removeElement($associationSoumission)) {
            // set the owning side to null (unless already changed)
            if ($associationSoumission->getSoumissionnaire() === $this) {
                $associationSoumission->setSoumissionnaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OffreMarche[]
     */
    public function getAssociationOffre(): Collection
    {
        return $this->associationOffre;
    }

    public function addAssociationOffre(OffreMarche $associationOffre): self
    {
        if (!$this->associationOffre->contains($associationOffre)) {
            $this->associationOffre[] = $associationOffre;
            $associationOffre->setSoumissionnaire($this);
        }

        return $this;
    }

    public function removeAssociationOffre(OffreMarche $associationOffre): self
    {
        if ($this->associationOffre->removeElement($associationOffre)) {
            // set the owning side to null (unless already changed)
            if ($associationOffre->getSoumissionnaire() === $this) {
                $associationOffre->setSoumissionnaire(null);
            }
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroIfu(): ?string
    {
        return $this->numeroIfu;
    }

    public function setNumeroIfu(string $numeroIfu): self
    {
        $this->numeroIfu = $numeroIfu;

        return $this;
    }

    public function getDesignationEntreprise(): ?string
    {
        return $this->designationEntreprise;
    }

    public function setDesignationEntreprise(string $designationEntreprise): self
    {
        $this->designationEntreprise = $designationEntreprise;

        return $this;
    }

    public function getSigleEntreprise(): ?string
    {
        return $this->sigleEntreprise;
    }

    public function setSigleEntreprise(?string $sigleEntreprise): self
    {
        $this->sigleEntreprise = $sigleEntreprise;

        return $this;
    }

    public function getAdresseEntreprise(): ?string
    {
        return $this->adresseEntreprise;
    }

    public function setAdresseEntreprise(string $adresseEntreprise): self
    {
        $this->adresseEntreprise = $adresseEntreprise;

        return $this;
    }

    public function getDescriptionEntreprise(): ?string
    {
        return $this->descriptionEntreprise;
    }

    public function setDescriptionEntreprise(?string $descriptionEntreprise): self
    {
        $this->descriptionEntreprise = $descriptionEntreprise;

        return $this;
    }
}
