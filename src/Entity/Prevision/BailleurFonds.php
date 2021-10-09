<?php

namespace App\Entity\Prevision;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Prevision\BailleurFondsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=BailleurFondsRepository::class)
 */
class BailleurFonds
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
    private $designationBailleur;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $sigleBailleur;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $categorieBailleur;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $codeBailleur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sourceFinancement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptionBailleur;

    /**
     * @ORM\OneToMany(targetEntity=RessourceFinanciere::class, mappedBy="bailleurFonds", orphanRemoval=true)
     */
    private $associationRessource;

    public function __construct()
    {
        $this->associationRessource = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignationBailleur(): ?string
    {
        return $this->designationBailleur;
    }

    public function setDesignationBailleur(string $designationBailleur): self
    {
        $this->designationBailleur = $designationBailleur;

        return $this;
    }

    public function getSigleBailleur(): ?string
    {
        return $this->sigleBailleur;
    }

    public function setSigleBailleur(string $sigleBailleur): self
    {
        $this->sigleBailleur = $sigleBailleur;

        return $this;
    }

    public function getCategorieBailleur(): ?string
    {
        return $this->categorieBailleur;
    }

    public function setCategorieBailleur(string $categorieBailleur): self
    {
        $this->categorieBailleur = $categorieBailleur;

        return $this;
    }

    public function getCodeBailleur(): ?string
    {
        return $this->codeBailleur;
    }

    public function setCodeBailleur(string $codeBailleur): self
    {
        $this->codeBailleur = $codeBailleur;

        return $this;
    }

    public function getSourceFinancement(): ?string
    {
        return $this->sourceFinancement;
    }

    public function setSourceFinancement(string $sourceFinancement): self
    {
        $this->sourceFinancement = $sourceFinancement;

        return $this;
    }

    public function getDescriptionBailleur(): ?string
    {
        return $this->descriptionBailleur;
    }

    public function setDescriptionBailleur(?string $descriptionBailleur): self
    {
        $this->descriptionBailleur = $descriptionBailleur;

        return $this;
    }

    /**
     * @return Collection|RessourceFinanciere[]
     */
    public function getAssociationRessource(): Collection
    {
        return $this->associationRessource;
    }

    public function addAssociationRessource(RessourceFinanciere $associationRessource): self
    {
        if (!$this->associationRessource->contains($associationRessource)) {
            $this->associationRessource[] = $associationRessource;
            $associationRessource->setBailleurFonds($this);
        }

        return $this;
    }

    public function removeAssociationRessource(RessourceFinanciere $associationRessource): self
    {
        if ($this->associationRessource->removeElement($associationRessource)) {
            // set the owning side to null (unless already changed)
            if ($associationRessource->getBailleurFonds() === $this) {
                $associationRessource->setBailleurFonds(null);
            }
        }

        return $this;
    }
}
