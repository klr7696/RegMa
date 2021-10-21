<?php

namespace App\Entity\Plans;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Administration\MairieCommunale;
use App\Entity\Nomenclatures\CompteNature;
use App\Entity\Prevision\AllocationCredit;
use App\Entity\Prevision\LienRegistre;
use App\Repository\Plans\AutorisationMarcheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     shortName= "autorisations"
 * )
 * @ORM\Entity(repositoryClass=AutorisationMarcheRepository::class)
 */
class AutorisationMarche
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $objetAutorisation;

    /**
     * @ORM\Column(type="float")
     */
    private $montantAutorisation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $explicationAutorisation;

    /**
     * @ORM\OneToMany(targetEntity=LotMarche::class, mappedBy="autorisationMarche", orphanRemoval=true)
     */
    private $associationLot;

    /**
     * @ORM\OneToMany(targetEntity=ExceptionMarche::class, mappedBy="autorisationMarche", orphanRemoval=true)
     */
    private $associationException;

    /**
     * @ORM\OneToMany(targetEntity=AllocationCredit::class, mappedBy="autorisationMarche")
     */
    private $associationAllocation;

    /**
     * @ORM\ManyToOne(targetEntity=MairieCommunale::class, inversedBy="associationAutorisation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mairieCommunale;

    /**
     * @ORM\ManyToOne(targetEntity=CompteNature::class, inversedBy="associationAutorisation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $compteNature;

    /**
     * @ORM\OneToOne(targetEntity=LienRegistre::class, mappedBy="relation", cascade={"persist", "remove"})
     */
    private $lienRegistre;

    /**
     * @ORM\OneToOne(targetEntity=LienRegistre::class, inversedBy="autorisationMarche", cascade={"persist", "remove"})
     */
    private $relationModifier;

    public function __construct()
    {
        $this->associationLot = new ArrayCollection();
        $this->associationException = new ArrayCollection();
        $this->associationAllocation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjetAutorisation(): ?string
    {
        return $this->objetAutorisation;
    }

    public function setObjetAutorisation(string $objetAutorisation): self
    {
        $this->objetAutorisation = $objetAutorisation;

        return $this;
    }

    public function getMontantAutorisation(): ?float
    {
        return $this->montantAutorisation;
    }

    public function setMontantAutorisation(float $montantAutorisation): self
    {
        $this->montantAutorisation = $montantAutorisation;

        return $this;
    }

    public function getExplicationAutorisation(): ?string
    {
        return $this->explicationAutorisation;
    }

    public function setExplicationAutorisation(?string $explicationAutorisation): self
    {
        $this->explicationAutorisation = $explicationAutorisation;

        return $this;
    }

    /**
     * @return Collection|LotMarche[]
     */
    public function getAssociationLot(): Collection
    {
        return $this->associationLot;
    }

    public function addAssociationLot(LotMarche $associationLot): self
    {
        if (!$this->associationLot->contains($associationLot)) {
            $this->associationLot[] = $associationLot;
            $associationLot->setAutorisationMarche($this);
        }

        return $this;
    }

    public function removeAssociationLot(LotMarche $associationLot): self
    {
        if ($this->associationLot->removeElement($associationLot)) {
            // set the owning side to null (unless already changed)
            if ($associationLot->getAutorisationMarche() === $this) {
                $associationLot->setAutorisationMarche(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ExceptionMarche[]
     */
    public function getAssociationException(): Collection
    {
        return $this->associationException;
    }

    public function addAssociationException(ExceptionMarche $associationException): self
    {
        if (!$this->associationException->contains($associationException)) {
            $this->associationException[] = $associationException;
            $associationException->setAutorisationMarche($this);
        }

        return $this;
    }

    public function removeAssociationException(ExceptionMarche $associationException): self
    {
        if ($this->associationException->removeElement($associationException)) {
            // set the owning side to null (unless already changed)
            if ($associationException->getAutorisationMarche() === $this) {
                $associationException->setAutorisationMarche(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AllocationCredit[]
     */
    public function getAssociationAllocation(): Collection
    {
        return $this->associationAllocation;
    }

    public function addAssociationAllocation(AllocationCredit $associationAllocation): self
    {
        if (!$this->associationAllocation->contains($associationAllocation)) {
            $this->associationAllocation[] = $associationAllocation;
            $associationAllocation->setAutorisationMarche($this);
        }

        return $this;
    }

    public function removeAssociationAllocation(AllocationCredit $associationAllocation): self
    {
        if ($this->associationAllocation->removeElement($associationAllocation)) {
            // set the owning side to null (unless already changed)
            if ($associationAllocation->getAutorisationMarche() === $this) {
                $associationAllocation->setAutorisationMarche(null);
            }
        }

        return $this;
    }

    public function getMairieCommunale(): ?MairieCommunale
    {
        return $this->mairieCommunale;
    }

    public function setMairieCommunale(?MairieCommunale $mairieCommunale): self
    {
        $this->mairieCommunale = $mairieCommunale;

        return $this;
    }

    public function getCompteNature(): ?CompteNature
    {
        return $this->compteNature;
    }

    public function setCompteNature(?CompteNature $compteNature): self
    {
        $this->compteNature = $compteNature;

        return $this;
    }

    public function getLienRegistre(): ?LienRegistre
    {
        return $this->lienRegistre;
    }

    public function setLienRegistre(?LienRegistre $lienRegistre): self
    {
        // unset the owning side of the relation if necessary
        if ($lienRegistre === null && $this->lienRegistre !== null) {
            $this->lienRegistre->setRelation(null);
        }

        // set the owning side of the relation if necessary
        if ($lienRegistre !== null && $lienRegistre->getRelation() !== $this) {
            $lienRegistre->setRelation($this);
        }

        $this->lienRegistre = $lienRegistre;

        return $this;
    }

    public function getRelationModifier(): ?LienRegistre
    {
        return $this->relationModifier;
    }

    public function setRelationModifier(?LienRegistre $relationModifier): self
    {
        $this->relationModifier = $relationModifier;

        return $this;
    }
}
