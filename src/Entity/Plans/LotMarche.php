<?php

namespace App\Entity\Plans;

use App\Entity\Projets\ProjetMarche;
use App\Entity\Soumissions\OffreMarche;
use App\Repository\Plans\LotMarcheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToOne(targetEntity=LienPlan::class, inversedBy="lotMarche", cascade={"persist", "remove"})
     */
    private $associationLotActuel;

    /**
     * @ORM\OneToOne(targetEntity=LienPlan::class, mappedBy="associationLotModifier", cascade={"persist", "remove"})
     */
    private $lienPlan;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estAnnuler;

    /**
     * @ORM\ManyToOne(targetEntity=ProjetMarche::class, inversedBy="associationLot")
     */
    private $projetMarche;

    /**
     * @ORM\OneToMany(targetEntity=OffreMarche::class, mappedBy="lotMarche", orphanRemoval=true)
     */
    private $associationOffre;

    public function __construct()
    {
        $this->associationOffre = new ArrayCollection();
    }

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

    public function getAssociationLotActuel(): ?LienPlan
    {
        return $this->associationLotActuel;
    }

    public function setAssociationLotActuel(?LienPlan $associationLotActuel): self
    {
        $this->associationLotActuel = $associationLotActuel;

        return $this;
    }

    public function getLienPlan(): ?LienPlan
    {
        return $this->lienPlan;
    }

    public function setLienPlan(?LienPlan $lienPlan): self
    {
        // unset the owning side of the relation if necessary
        if ($lienPlan === null && $this->lienPlan !== null) {
            $this->lienPlan->setAssociationLotModifier(null);
        }

        // set the owning side of the relation if necessary
        if ($lienPlan !== null && $lienPlan->getAssociationLotModifier() !== $this) {
            $lienPlan->setAssociationLotModifier($this);
        }

        $this->lienPlan = $lienPlan;

        return $this;
    }

    public function getEstAnnuler(): ?bool
    {
        return $this->estAnnuler;
    }

    public function setEstAnnuler(bool $estAnnuler): self
    {
        $this->estAnnuler = $estAnnuler;

        return $this;
    }

    public function getProjetMarche(): ?ProjetMarche
    {
        return $this->projetMarche;
    }

    public function setProjetMarche(?ProjetMarche $projetMarche): self
    {
        $this->projetMarche = $projetMarche;

        return $this;
    }

    /**
     * @return Collection|OffreMarche[]
     */
    public function getAssociationOffre(): Collection
    {
        return $this->associationOffre;
    }

    public function addAssociationOffre(OffreMarche $associationOffre): self
    {
        if (!$this->associationOffre->contains($associationOffre)) {
            $this->associationOffre[] = $associationOffre;
            $associationOffre->setLotMarche($this);
        }

        return $this;
    }

    public function removeAssociationOffre(OffreMarche $associationOffre): self
    {
        if ($this->associationOffre->removeElement($associationOffre)) {
            // set the owning side to null (unless already changed)
            if ($associationOffre->getLotMarche() === $this) {
                $associationOffre->setLotMarche(null);
            }
        }

        return $this;
    }
}
