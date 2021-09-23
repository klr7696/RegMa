<?php

namespace App\Entity\Plans;

use App\Repository\Plans\LotMarcheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LotMarcheRepository::class)
 */
class LotMarche
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroLot;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $objetLot;

    /**
     * @ORM\Column(type="float")
     */
    private $montantLot;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observationLot;

    /**
     * @ORM\Column(type="integer")
     */
    private $delaiExecution;

    /**
     * @ORM\ManyToOne(targetEntity=PlanPassation::class, inversedBy="associationLot")
     * @ORM\JoinColumn(nullable=false)
     */
    private $planPassation;

    /**
     * @ORM\ManyToOne(targetEntity=AutorisationMarche::class, inversedBy="associationLot")
     * @ORM\JoinColumn(nullable=false)
     */
    private $autorisationMarche;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroLot(): ?int
    {
        return $this->numeroLot;
    }

    public function setNumeroLot(int $numeroLot): self
    {
        $this->numeroLot = $numeroLot;

        return $this;
    }

    public function getObjetLot(): ?string
    {
        return $this->objetLot;
    }

    public function setObjetLot(string $objetLot): self
    {
        $this->objetLot = $objetLot;

        return $this;
    }

    public function getMontantLot(): ?float
    {
        return $this->montantLot;
    }

    public function setMontantLot(float $montantLot): self
    {
        $this->montantLot = $montantLot;

        return $this;
    }

    public function getObservationLot(): ?string
    {
        return $this->observationLot;
    }

    public function setObservationLot(?string $observationLot): self
    {
        $this->observationLot = $observationLot;

        return $this;
    }

    public function getDelaiExecution(): ?int
    {
        return $this->delaiExecution;
    }

    public function setDelaiExecution(int $delaiExecution): self
    {
        $this->delaiExecution = $delaiExecution;

        return $this;
    }

    public function getPlanPassation(): ?PlanPassation
    {
        return $this->planPassation;
    }

    public function setPlanPassation(?PlanPassation $planPassation): self
    {
        $this->planPassation = $planPassation;

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
}
