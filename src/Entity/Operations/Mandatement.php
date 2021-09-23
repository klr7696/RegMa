<?php

namespace App\Entity\Operations;

use App\Repository\Operations\MandatementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MandatementRepository::class)
 */
class Mandatement
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
    private $typeOperation;

    /**
     * @ORM\Column(type="float")
     */
    private $montantOperation;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOperation;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $referenceOperation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $reglement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $compteCreance;

    /**
     * @ORM\ManyToOne(targetEntity=Engagement::class, inversedBy="associationMandat")
     * @ORM\JoinColumn(nullable=false)
     */
    private $engagement;

    /**
     * @ORM\ManyToOne(targetEntity=Mandatement::class, inversedBy="associationAnnulation")
     */
    private $emission;

    /**
     * @ORM\OneToMany(targetEntity=Mandatement::class, mappedBy="emission")
     */
    private $associationAnnulation;

    /**
     * @ORM\OneToMany(targetEntity=Imputation::class, mappedBy="mandatement")
     */
    private $associationImputation;

    public function __construct()
    {
        $this->associationAnnulation = new ArrayCollection();
        $this->associationImputation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeOperation(): ?string
    {
        return $this->typeOperation;
    }

    public function setTypeOperation(string $typeOperation): self
    {
        $this->typeOperation = $typeOperation;

        return $this;
    }

    public function getMontantOperation(): ?float
    {
        return $this->montantOperation;
    }

    public function setMontantOperation(float $montantOperation): self
    {
        $this->montantOperation = $montantOperation;

        return $this;
    }

    public function getDateOperation(): ?\DateTimeInterface
    {
        return $this->dateOperation;
    }

    public function setDateOperation(\DateTimeInterface $dateOperation): self
    {
        $this->dateOperation = $dateOperation;

        return $this;
    }

    public function getReferenceOperation(): ?string
    {
        return $this->referenceOperation;
    }

    public function setReferenceOperation(?string $referenceOperation): self
    {
        $this->referenceOperation = $referenceOperation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getReglement(): ?string
    {
        return $this->reglement;
    }

    public function setReglement(?string $reglement): self
    {
        $this->reglement = $reglement;

        return $this;
    }

    public function getCompteCreance(): ?string
    {
        return $this->compteCreance;
    }

    public function setCompteCreance(?string $compteCreance): self
    {
        $this->compteCreance = $compteCreance;

        return $this;
    }

    public function getEngagement(): ?Engagement
    {
        return $this->engagement;
    }

    public function setEngagement(?Engagement $engagement): self
    {
        $this->engagement = $engagement;

        return $this;
    }

    public function getEmission(): ?self
    {
        return $this->emission;
    }

    public function setEmission(?self $emission): self
    {
        $this->emission = $emission;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getAssociationAnnulation(): Collection
    {
        return $this->associationAnnulation;
    }

    public function addAssociationAnnulation(self $associationAnnulation): self
    {
        if (!$this->associationAnnulation->contains($associationAnnulation)) {
            $this->associationAnnulation[] = $associationAnnulation;
            $associationAnnulation->setEmission($this);
        }

        return $this;
    }

    public function removeAssociationAnnulation(self $associationAnnulation): self
    {
        if ($this->associationAnnulation->removeElement($associationAnnulation)) {
            // set the owning side to null (unless already changed)
            if ($associationAnnulation->getEmission() === $this) {
                $associationAnnulation->setEmission(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Imputation[]
     */
    public function getAssociationImputation(): Collection
    {
        return $this->associationImputation;
    }

    public function addAssociationImputation(Imputation $associationImputation): self
    {
        if (!$this->associationImputation->contains($associationImputation)) {
            $this->associationImputation[] = $associationImputation;
            $associationImputation->setMandatement($this);
        }

        return $this;
    }

    public function removeAssociationImputation(Imputation $associationImputation): self
    {
        if ($this->associationImputation->removeElement($associationImputation)) {
            // set the owning side to null (unless already changed)
            if ($associationImputation->getMandatement() === $this) {
                $associationImputation->setMandatement(null);
            }
        }

        return $this;
    }
}
