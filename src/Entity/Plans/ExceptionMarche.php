<?php

namespace App\Entity\Plans;

use App\Repository\Plans\ExceptionMarcheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExceptionMarcheRepository::class)
 */
class ExceptionMarche
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
    private $typeException;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $objetException;

    /**
     * @ORM\Column(type="float")
     */
    private $montantException;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observationException;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $delaiExcecution;

    /**
     * @ORM\ManyToOne(targetEntity=PlanPassation::class, inversedBy="associationException")
     * @ORM\JoinColumn(nullable=false)
     */
    private $planPassation;

    /**
     * @ORM\ManyToOne(targetEntity=AutorisationMarche::class, inversedBy="associationException")
     * @ORM\JoinColumn(nullable=false)
     */
    private $autorisationMarche;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeException(): ?string
    {
        return $this->typeException;
    }

    public function setTypeException(string $typeException): self
    {
        $this->typeException = $typeException;

        return $this;
    }

    public function getObjetException(): ?string
    {
        return $this->objetException;
    }

    public function setObjetException(?string $objetException): self
    {
        $this->objetException = $objetException;

        return $this;
    }

    public function getMontantException(): ?float
    {
        return $this->montantException;
    }

    public function setMontantException(float $montantException): self
    {
        $this->montantException = $montantException;

        return $this;
    }

    public function getObservationException(): ?string
    {
        return $this->observationException;
    }

    public function setObservationException(?string $observationException): self
    {
        $this->observationException = $observationException;

        return $this;
    }

    public function getDelaiExcecution(): ?int
    {
        return $this->delaiExcecution;
    }

    public function setDelaiExcecution(?int $delaiExcecution): self
    {
        $this->delaiExcecution = $delaiExcecution;

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
