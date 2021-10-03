<?php

namespace App\Entity\Prevision;

use App\Entity\Administration\MairieCommunale;
use App\Entity\Nomenclatures\CompteNature;
use App\Entity\Plans\AutorisationMarche;
use App\Repository\Prevision\AllocationCreditRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AllocationCreditRepository::class)
 */
class AllocationCredit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $montantAllouer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptionAllocation;

    /**
     * @ORM\ManyToOne(targetEntity=CreditOuvert::class, inversedBy="associationAllocation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $creditOuvert;

    /**
     * @ORM\OneToOne(targetEntity=LienRegistre::class, inversedBy="allocationCredit", cascade={"persist", "remove"})
     */
    private $associationAllocationActuel;

    /**
     * @ORM\OneToOne(targetEntity=LienRegistre::class, mappedBy="associationAllocationModifier", cascade={"persist", "remove"})
     */
    private $lienRegistre;

    /**
     * @ORM\ManyToOne(targetEntity=MairieCommunale::class, inversedBy="associationAllocation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mairieCommunale;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estValide;

    /**
     * @ORM\ManyToOne(targetEntity=AutorisationMarche::class, inversedBy="associationAllocation")
     */
    private $autorisationMarche;

    /**
     * @ORM\ManyToOne(targetEntity=CompteNature::class, inversedBy="associationAllocation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $compteNature;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantAllouer(): ?float
    {
        return $this->montantAllouer;
    }

    public function setMontantAllouer(float $montantAllouer): self
    {
        $this->montantAllouer = $montantAllouer;

        return $this;
    }

    public function getDescriptionAllocation(): ?string
    {
        return $this->descriptionAllocation;
    }

    public function setDescriptionAllocation(?string $descriptionAllocation): self
    {
        $this->descriptionAllocation = $descriptionAllocation;

        return $this;
    }

    public function getCreditOuvert(): ?CreditOuvert
    {
        return $this->creditOuvert;
    }

    public function setCreditOuvert(?CreditOuvert $creditOuvert): self
    {
        $this->creditOuvert = $creditOuvert;

        return $this;
    }

    public function getAssociationAllocationActuel(): ?LienRegistre
    {
        return $this->associationAllocationActuel;
    }

    public function setAssociationAllocationActuel(?LienRegistre $associationAllocationActuel): self
    {
        $this->associationAllocationActuel = $associationAllocationActuel;

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
            $this->lienRegistre->setAssociationAllocationModifier(null);
        }

        // set the owning side of the relation if necessary
        if ($lienRegistre !== null && $lienRegistre->getAssociationAllocationModifier() !== $this) {
            $lienRegistre->setAssociationAllocationModifier($this);
        }

        $this->lienRegistre = $lienRegistre;

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

    public function getEstValide(): ?bool
    {
        return $this->estValide;
    }

    public function setEstValide(bool $estValide): self
    {
        $this->estValide = $estValide;

        return $this;
    }

    public function getAutorisationMarche(): ?AutorisationMarche
    {
        return $this->autorisationMarche;
    }

    public function setAutorisationMarche(?AutorisationMarche $autorisationMarche): self
    {
        $this->autorisationMarche = $autorisationMarche;

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
}
