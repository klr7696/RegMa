<?php

namespace App\Entity\Plans;

use App\Repository\Plans\LienPlanRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LienPlanRepository::class)
 */
class LienPlan
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
    private $motifModification;



    /**
     * @ORM\OneToOne(targetEntity=ExceptionMarche::class, mappedBy="associationExceptionActuel", cascade={"persist", "remove"})
     */
    private $exceptionMarche;

    /**
     * @ORM\OneToOne(targetEntity=LotMarche::class, inversedBy="lienPlan", cascade={"persist", "remove"})
     */
    private $associationLotModifier;

    /**
     * @ORM\OneToOne(targetEntity=ExceptionMarche::class, inversedBy="lienPlan", cascade={"persist", "remove"})
     */
    private $associationExceptionModifier;

    /**
     * @ORM\ManyToOne(targetEntity=StatutPlan::class, inversedBy="associationLien")
     * @ORM\JoinColumn(nullable=false)
     */
    private $statutPlan;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotifModification(): ?string
    {
        return $this->motifModification;
    }

    public function setMotifModification(?string $motifModification): self
    {
        $this->motifModification = $motifModification;

        return $this;
    }



    public function getExceptionMarche(): ?ExceptionMarche
    {
        return $this->exceptionMarche;
    }

    public function setExceptionMarche(?ExceptionMarche $exceptionMarche): self
    {
        // unset the owning side of the relation if necessary
        if ($exceptionMarche === null && $this->exceptionMarche !== null) {
            $this->exceptionMarche->setAssociationExceptionActuel(null);
        }

        // set the owning side of the relation if necessary
        if ($exceptionMarche !== null && $exceptionMarche->getAssociationExceptionActuel() !== $this) {
            $exceptionMarche->setAssociationExceptionActuel($this);
        }

        $this->exceptionMarche = $exceptionMarche;

        return $this;
    }

    public function getAssociationLotModifier(): ?LotMarche
    {
        return $this->associationLotModifier;
    }

    public function setAssociationLotModifier(?LotMarche $associationLotModifier): self
    {
        $this->associationLotModifier = $associationLotModifier;

        return $this;
    }

    public function getAssociationExceptionModifier(): ?ExceptionMarche
    {
        return $this->associationExceptionModifier;
    }

    public function setAssociationExceptionModifier(?ExceptionMarche $associationExceptionModifier): self
    {
        $this->associationExceptionModifier = $associationExceptionModifier;

        return $this;
    }

    public function getStatutPlan(): ?StatutPlan
    {
        return $this->statutPlan;
    }

    public function setStatutPlan(?StatutPlan $statutPlan): self
    {
        $this->statutPlan = $statutPlan;

        return $this;
    }
}
