<?php

namespace App\Entity\Projets;

use App\Repository\Projets\ModePassationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModePassationRepository::class)
 */
class ModePassation
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
    private $designationMode;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $abbreviationMode;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $categorieMode;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $naturePrestation;

    /**
     * @ORM\Column(type="float")
     */
    private $seuilsMinimum;

    /**
     * @ORM\Column(type="float")
     */
    private $seuilsMaximum;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptionMode;

    /**
     * @ORM\OneToMany(targetEntity=ProjetMarche::class, mappedBy="modePassation", orphanRemoval=true)
     */
    private $associationPhase;

    public function __construct()
    {
        $this->associationPhase = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignationMode(): ?string
    {
        return $this->designationMode;
    }

    public function setDesignationMode(string $designationMode): self
    {
        $this->designationMode = $designationMode;

        return $this;
    }

    public function getAbbreviationMode(): ?string
    {
        return $this->abbreviationMode;
    }

    public function setAbbreviationMode(string $abbreviationMode): self
    {
        $this->abbreviationMode = $abbreviationMode;

        return $this;
    }

    public function getCategorieMode(): ?string
    {
        return $this->categorieMode;
    }

    public function setCategorieMode(string $categorieMode): self
    {
        $this->categorieMode = $categorieMode;

        return $this;
    }

    public function getNaturePrestation(): ?string
    {
        return $this->naturePrestation;
    }

    public function setNaturePrestation(string $naturePrestation): self
    {
        $this->naturePrestation = $naturePrestation;

        return $this;
    }

    public function getSeuilsMinimum(): ?float
    {
        return $this->seuilsMinimum;
    }

    public function setSeuilsMinimum(float $seuilsMinimum): self
    {
        $this->seuilsMinimum = $seuilsMinimum;

        return $this;
    }

    public function getSeuilsMaximum(): ?float
    {
        return $this->seuilsMaximum;
    }

    public function setSeuilsMaximum(float $seuilsMaximum): self
    {
        $this->seuilsMaximum = $seuilsMaximum;

        return $this;
    }

    public function getDescriptionMode(): ?string
    {
        return $this->descriptionMode;
    }

    public function setDescriptionMode(?string $descriptionMode): self
    {
        $this->descriptionMode = $descriptionMode;

        return $this;
    }

    /**
     * @return Collection|ProjetMarche[]
     */
    public function getAssociationPhase(): Collection
    {
        return $this->associationPhase;
    }

    public function addAssociationPhase(ProjetMarche $associationPhase): self
    {
        if (!$this->associationPhase->contains($associationPhase)) {
            $this->associationPhase[] = $associationPhase;
            $associationPhase->setModePassation($this);
        }

        return $this;
    }

    public function removeAssociationPhase(ProjetMarche $associationPhase): self
    {
        if ($this->associationPhase->removeElement($associationPhase)) {
            // set the owning side to null (unless already changed)
            if ($associationPhase->getModePassation() === $this) {
                $associationPhase->setModePassation(null);
            }
        }

        return $this;
    }
}
