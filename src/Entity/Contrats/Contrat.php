<?php

namespace App\Entity\Contrats;

use App\Repository\Contrats\ContratRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContratRepository::class)
 */
class Contrat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $typeContrat;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $montantMinimum;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $montantMinimumLettre;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $montantMaximum;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $montantMaximumLettre;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroContrat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $referenceContrat;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateApprobation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNotification;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estApprouver;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionContrat;

    /**
     * @ORM\ManyToOne(targetEntity=Contrat::class, inversedBy="associationAvenant")
     */
    private $marche;

    /**
     * @ORM\OneToMany(targetEntity=Contrat::class, mappedBy="marche")
     */
    private $associationAvenant;

    /**
     * @ORM\OneToMany(targetEntity=BonCommande::class, mappedBy="contrat", orphanRemoval=true)
     */
    private $associationBon;

    public function __construct()
    {
        $this->associationAvenant = new ArrayCollection();
        $this->associationBon = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(string $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }

    public function getMontantMinimum(): ?float
    {
        return $this->montantMinimum;
    }

    public function setMontantMinimum(?float $montantMinimum): self
    {
        $this->montantMinimum = $montantMinimum;

        return $this;
    }

    public function getMontantMinimumLettre(): ?string
    {
        return $this->montantMinimumLettre;
    }

    public function setMontantMinimumLettre(?string $montantMinimumLettre): self
    {
        $this->montantMinimumLettre = $montantMinimumLettre;

        return $this;
    }

    public function getMontantMaximum(): ?float
    {
        return $this->montantMaximum;
    }

    public function setMontantMaximum(?float $montantMaximum): self
    {
        $this->montantMaximum = $montantMaximum;

        return $this;
    }

    public function getMontantMaximumLettre(): ?string
    {
        return $this->montantMaximumLettre;
    }

    public function setMontantMaximumLettre(?string $montantMaximumLettre): self
    {
        $this->montantMaximumLettre = $montantMaximumLettre;

        return $this;
    }

    public function getNumeroContrat(): ?int
    {
        return $this->numeroContrat;
    }

    public function setNumeroContrat(int $numeroContrat): self
    {
        $this->numeroContrat = $numeroContrat;

        return $this;
    }

    public function getReferenceContrat(): ?string
    {
        return $this->referenceContrat;
    }

    public function setReferenceContrat(string $referenceContrat): self
    {
        $this->referenceContrat = $referenceContrat;

        return $this;
    }

    public function getDateApprobation(): ?\DateTimeInterface
    {
        return $this->dateApprobation;
    }

    public function setDateApprobation(?\DateTimeInterface $dateApprobation): self
    {
        $this->dateApprobation = $dateApprobation;

        return $this;
    }

    public function getDateNotification(): ?\DateTimeInterface
    {
        return $this->dateNotification;
    }

    public function setDateNotification(?\DateTimeInterface $dateNotification): self
    {
        $this->dateNotification = $dateNotification;

        return $this;
    }

    public function getEstApprouver(): ?bool
    {
        return $this->estApprouver;
    }

    public function setEstApprouver(bool $estApprouver): self
    {
        $this->estApprouver = $estApprouver;

        return $this;
    }

    public function getDescriptionContrat(): ?string
    {
        return $this->descriptionContrat;
    }

    public function setDescriptionContrat(?string $descriptionContrat): self
    {
        $this->descriptionContrat = $descriptionContrat;

        return $this;
    }

    public function getMarche(): ?self
    {
        return $this->marche;
    }

    public function setMarche(?self $marche): self
    {
        $this->marche = $marche;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getAssociationAvenant(): Collection
    {
        return $this->associationAvenant;
    }

    public function addAssociationAvenant(self $associationAvenant): self
    {
        if (!$this->associationAvenant->contains($associationAvenant)) {
            $this->associationAvenant[] = $associationAvenant;
            $associationAvenant->setMarche($this);
        }

        return $this;
    }

    public function removeAssociationAvenant(self $associationAvenant): self
    {
        if ($this->associationAvenant->removeElement($associationAvenant)) {
            // set the owning side to null (unless already changed)
            if ($associationAvenant->getMarche() === $this) {
                $associationAvenant->setMarche(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BonCommande[]
     */
    public function getAssociationBon(): Collection
    {
        return $this->associationBon;
    }

    public function addAssociationBon(BonCommande $associationBon): self
    {
        if (!$this->associationBon->contains($associationBon)) {
            $this->associationBon[] = $associationBon;
            $associationBon->setContrat($this);
        }

        return $this;
    }

    public function removeAssociationBon(BonCommande $associationBon): self
    {
        if ($this->associationBon->removeElement($associationBon)) {
            // set the owning side to null (unless already changed)
            if ($associationBon->getContrat() === $this) {
                $associationBon->setContrat(null);
            }
        }

        return $this;
    }
}
