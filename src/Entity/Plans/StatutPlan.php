<?php

namespace App\Entity\Plans;

use App\Repository\Plans\StatutPlanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatutPlanRepository::class)
 */
class StatutPlan
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
    private $statut;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=PlanPassation::class, inversedBy="associationStatut")
     * @ORM\JoinColumn(nullable=false)
     */
    private $planPassation;

    /**
     * @ORM\OneToMany(targetEntity=LienPlan::class, mappedBy="statutPlan", orphanRemoval=true)
     */
    private $associationLien;

    public function __construct()
    {
        $this->associationLien = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

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

    public function getPlanPassation(): ?PlanPassation
    {
        return $this->planPassation;
    }

    public function setPlanPassation(?PlanPassation $planPassation): self
    {
        $this->planPassation = $planPassation;

        return $this;
    }

    /**
     * @return Collection|LienPlan[]
     */
    public function getAssociationLien(): Collection
    {
        return $this->associationLien;
    }

    public function addAssociationLien(LienPlan $associationLien): self
    {
        if (!$this->associationLien->contains($associationLien)) {
            $this->associationLien[] = $associationLien;
            $associationLien->setStatutPlan($this);
        }

        return $this;
    }

    public function removeAssociationLien(LienPlan $associationLien): self
    {
        if ($this->associationLien->removeElement($associationLien)) {
            // set the owning side to null (unless already changed)
            if ($associationLien->getStatutPlan() === $this) {
                $associationLien->setStatutPlan(null);
            }
        }

        return $this;
    }
}
