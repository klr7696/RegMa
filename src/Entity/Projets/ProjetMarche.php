<?php

namespace App\Entity\Projets;

use App\Repository\Projets\ProjetMarcheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjetMarcheRepository::class)
 */
class ProjetMarche
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $objetMarche;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroProjet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $referenceProjet;

    /**
     * @ORM\Column(type="integer")
     */
    private $prioriteProjet;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $specificitéProjet;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $pieceFournir;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixDossier;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $propositionMinimum;

    /**
     * @ORM\ManyToOne(targetEntity=ModePassation::class, inversedBy="associationPhase")
     * @ORM\JoinColumn(nullable=false)
     */
    private $modePassation;

    /**
     * @ORM\OneToMany(targetEntity=PhaseMarche::class, mappedBy="projetMarche", orphanRemoval=true)
     */
    private $associationPhase;

    /**
     * @ORM\OneToMany(targetEntity=DecisionMarche::class, mappedBy="projetMarche")
     */
    private $associationDecision;

    public function __construct()
    {
        $this->associationPhase = new ArrayCollection();
        $this->associationDecision = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjetMarche(): ?string
    {
        return $this->objetMarche;
    }

    public function setObjetMarche(?string $objetMarche): self
    {
        $this->objetMarche = $objetMarche;

        return $this;
    }

    public function getNumeroProjet(): ?int
    {
        return $this->numeroProjet;
    }

    public function setNumeroProjet(int $numeroProjet): self
    {
        $this->numeroProjet = $numeroProjet;

        return $this;
    }

    public function getReferenceProjet(): ?string
    {
        return $this->referenceProjet;
    }

    public function setReferenceProjet(string $referenceProjet): self
    {
        $this->referenceProjet = $referenceProjet;

        return $this;
    }

    public function getPrioriteProjet(): ?int
    {
        return $this->prioriteProjet;
    }

    public function setPrioriteProjet(int $prioriteProjet): self
    {
        $this->prioriteProjet = $prioriteProjet;

        return $this;
    }

    public function getSpecificitéProjet(): ?string
    {
        return $this->specificitéProjet;
    }

    public function setSpecificitéProjet(?string $specificitéProjet): self
    {
        $this->specificitéProjet = $specificitéProjet;

        return $this;
    }

    public function getPieceFournir(): ?string
    {
        return $this->pieceFournir;
    }

    public function setPieceFournir(?string $pieceFournir): self
    {
        $this->pieceFournir = $pieceFournir;

        return $this;
    }

    public function getPrixDossier(): ?float
    {
        return $this->prixDossier;
    }

    public function setPrixDossier(?float $prixDossier): self
    {
        $this->prixDossier = $prixDossier;

        return $this;
    }

    public function getPropositionMinimum(): ?float
    {
        return $this->propositionMinimum;
    }

    public function setPropositionMinimum(?float $propositionMinimum): self
    {
        $this->propositionMinimum = $propositionMinimum;

        return $this;
    }

    public function getModePassation(): ?ModePassation
    {
        return $this->modePassation;
    }

    public function setModePassation(?ModePassation $modePassation): self
    {
        $this->modePassation = $modePassation;

        return $this;
    }

    /**
     * @return Collection|PhaseMarche[]
     */
    public function getAssociationPhase(): Collection
    {
        return $this->associationPhase;
    }

    public function addAssociationPhase(PhaseMarche $associationPhase): self
    {
        if (!$this->associationPhase->contains($associationPhase)) {
            $this->associationPhase[] = $associationPhase;
            $associationPhase->setProjetMarche($this);
        }

        return $this;
    }

    public function removeAssociationPhase(PhaseMarche $associationPhase): self
    {
        if ($this->associationPhase->removeElement($associationPhase)) {
            // set the owning side to null (unless already changed)
            if ($associationPhase->getProjetMarche() === $this) {
                $associationPhase->setProjetMarche(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DecisionMarche[]
     */
    public function getAssociationDecision(): Collection
    {
        return $this->associationDecision;
    }

    public function addAssociationDecision(DecisionMarche $associationDecision): self
    {
        if (!$this->associationDecision->contains($associationDecision)) {
            $this->associationDecision[] = $associationDecision;
            $associationDecision->setProjetMarche($this);
        }

        return $this;
    }

    public function removeAssociationDecision(DecisionMarche $associationDecision): self
    {
        if ($this->associationDecision->removeElement($associationDecision)) {
            // set the owning side to null (unless already changed)
            if ($associationDecision->getProjetMarche() === $this) {
                $associationDecision->setProjetMarche(null);
            }
        }

        return $this;
    }
}
