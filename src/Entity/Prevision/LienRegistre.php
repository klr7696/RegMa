<?php

namespace App\Entity\Prevision;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Prevision\LienRegistreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=LienRegistreRepository::class)
 */
class LienRegistre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionMotif;

    /**
     * @ORM\OneToOne(targetEntity=RessourceFinanciere::class, mappedBy="associationRessourceActuel", cascade={"persist", "remove"})
     */
    private $ressourceFinanciere;

    /**
     * @ORM\OneToOne(targetEntity=RessourceFinanciere::class, inversedBy="lienRegistre", cascade={"persist", "remove"})
     */
    private $associationRessourceModifier;

    /**
     * @ORM\OneToOne(targetEntity=CreditOuvert::class, mappedBy="associationCreditActuel", cascade={"persist", "remove"})
     */
    private $creditOuvert;

    /**
     * @ORM\OneToOne(targetEntity=AllocationCredit::class, mappedBy="associationAllocationActuel", cascade={"persist", "remove"})
     */
    private $allocationCredit;

    /**
     * @ORM\OneToOne(targetEntity=CreditOuvert::class, inversedBy="lienRegistre", cascade={"persist", "remove"})
     */
    private $associationCreditModifier;

    /**
     * @ORM\OneToOne(targetEntity=AllocationCredit::class, inversedBy="lienRegistre", cascade={"persist", "remove"})
     */
    private $associationAllocationModifier;

    /**
     * @ORM\ManyToOne(targetEntity=StatutRegistre::class, inversedBy="associationActualisation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $statutRegistre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptionMotif(): ?string
    {
        return $this->descriptionMotif;
    }

    public function setDescriptionMotif(?string $descriptionMotif): self
    {
        $this->descriptionMotif = $descriptionMotif;

        return $this;
    }

    public function getRessourceFinanciere(): ?RessourceFinanciere
    {
        return $this->ressourceFinanciere;
    }

    public function setRessourceFinanciere(?RessourceFinanciere $ressourceFinanciere): self
    {
        // unset the owning side of the relation if necessary
        if ($ressourceFinanciere === null && $this->ressourceFinanciere !== null) {
            $this->ressourceFinanciere->setAssociationRessourceActuel(null);
        }

        // set the owning side of the relation if necessary
        if ($ressourceFinanciere !== null && $ressourceFinanciere->getAssociationRessourceActuel() !== $this) {
            $ressourceFinanciere->setAssociationRessourceActuel($this);
        }

        $this->ressourceFinanciere = $ressourceFinanciere;

        return $this;
    }

    public function getAssociationRessourceModifier(): ?RessourceFinanciere
    {
        return $this->associationRessourceModifier;
    }

    public function setAssociationRessourceModifier(?RessourceFinanciere $associationRessourceModifier): self
    {
        $this->associationRessourceModifier = $associationRessourceModifier;

        return $this;
    }

    public function getCreditOuvert(): ?CreditOuvert
    {
        return $this->creditOuvert;
    }

    public function setCreditOuvert(?CreditOuvert $creditOuvert): self
    {
        // unset the owning side of the relation if necessary
        if ($creditOuvert === null && $this->creditOuvert !== null) {
            $this->creditOuvert->setAssociationCreditActuel(null);
        }

        // set the owning side of the relation if necessary
        if ($creditOuvert !== null && $creditOuvert->getAssociationCreditActuel() !== $this) {
            $creditOuvert->setAssociationCreditActuel($this);
        }

        $this->creditOuvert = $creditOuvert;

        return $this;
    }

    public function getAllocationCredit(): ?AllocationCredit
    {
        return $this->allocationCredit;
    }

    public function setAllocationCredit(?AllocationCredit $allocationCredit): self
    {
        // unset the owning side of the relation if necessary
        if ($allocationCredit === null && $this->allocationCredit !== null) {
            $this->allocationCredit->setAssociationAllocationActuel(null);
        }

        // set the owning side of the relation if necessary
        if ($allocationCredit !== null && $allocationCredit->getAssociationAllocationActuel() !== $this) {
            $allocationCredit->setAssociationAllocationActuel($this);
        }

        $this->allocationCredit = $allocationCredit;

        return $this;
    }

    public function getAssociationCreditModifier(): ?CreditOuvert
    {
        return $this->associationCreditModifier;
    }

    public function setAssociationCreditModifier(?CreditOuvert $associationCreditModifier): self
    {
        $this->associationCreditModifier = $associationCreditModifier;

        return $this;
    }

    public function getAssociationAllocationModifier(): ?AllocationCredit
    {
        return $this->associationAllocationModifier;
    }

    public function setAssociationAllocationModifier(?AllocationCredit $associationAllocationModifier): self
    {
        $this->associationAllocationModifier = $associationAllocationModifier;

        return $this;
    }

    public function getStatutRegistre(): ?StatutRegistre
    {
        return $this->statutRegistre;
    }

    public function setStatutRegistre(?StatutRegistre $statutRegistre): self
    {
        $this->statutRegistre = $statutRegistre;

        return $this;
    }
}
