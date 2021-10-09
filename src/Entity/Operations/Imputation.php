<?php

namespace App\Entity\Operations;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Nomenclatures\CompteNature;
use App\Entity\Prevision\RessourceFinanciere;
use App\Repository\Operations\ImputationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ImputationRepository::class)
 */
class Imputation
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
    private $typeImputation;

    /**
     * @ORM\Column(type="float")
     */
    private $montantImputation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionImputation;

    /**
     * @ORM\ManyToOne(targetEntity=Engagement::class, inversedBy="associationImputation")
     */
    private $engagement;

    /**
     * @ORM\ManyToOne(targetEntity=Mandatement::class, inversedBy="associationImputation")
     */
    private $mandatement;

    /**
     * @ORM\ManyToOne(targetEntity=RessourceFinanciere::class, inversedBy="associationImputation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ressourceFinanciere;

    /**
     * @ORM\ManyToOne(targetEntity=CompteNature::class, inversedBy="associationImputation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $compteNature;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeImputation(): ?string
    {
        return $this->typeImputation;
    }

    public function setTypeImputation(string $typeImputation): self
    {
        $this->typeImputation = $typeImputation;

        return $this;
    }

    public function getMontantImputation(): ?float
    {
        return $this->montantImputation;
    }

    public function setMontantImputation(float $montantImputation): self
    {
        $this->montantImputation = $montantImputation;

        return $this;
    }

    public function getDescriptionImputation(): ?string
    {
        return $this->descriptionImputation;
    }

    public function setDescriptionImputation(?string $descriptionImputation): self
    {
        $this->descriptionImputation = $descriptionImputation;

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

    public function getMandatement(): ?Mandatement
    {
        return $this->mandatement;
    }

    public function setMandatement(?Mandatement $mandatement): self
    {
        $this->mandatement = $mandatement;

        return $this;
    }

    public function getRessourceFinanciere(): ?RessourceFinanciere
    {
        return $this->ressourceFinanciere;
    }

    public function setRessourceFinanciere(?RessourceFinanciere $ressourceFinanciere): self
    {
        $this->ressourceFinanciere = $ressourceFinanciere;

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
