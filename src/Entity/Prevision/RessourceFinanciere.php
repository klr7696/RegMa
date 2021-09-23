<?php

namespace App\Entity\Prevision;

use App\Repository\Prevision\RessourceFinanciereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RessourceFinanciereRepository::class)
 */
class RessourceFinanciere
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
    private $objetFinancement;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $modeFinancement;

    /**
     * @ORM\Column(type="float")
     */
    private $montantFinancement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptionFinancement;

    /**
     * @ORM\ManyToOne(targetEntity=ExerciceRegistre::class, inversedBy="associationRessource")
     * @ORM\JoinColumn(nullable=false)
     */
    private $exerciceRegistre;

    /**
     * @ORM\ManyToOne(targetEntity=BailleurFonds::class, inversedBy="associationRessource")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bailleurFonds;

    /**
     * @ORM\OneToMany(targetEntity=CreditOuvert::class, mappedBy="ressourceFinanciere", orphanRemoval=true)
     */
    private $associationCredit;

    public function __construct()
    {
        $this->associationCredit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjetFinancement(): ?string
    {
        return $this->objetFinancement;
    }

    public function setObjetFinancement(string $objetFinancement): self
    {
        $this->objetFinancement = $objetFinancement;

        return $this;
    }

    public function getModeFinancement(): ?string
    {
        return $this->modeFinancement;
    }

    public function setModeFinancement(string $modeFinancement): self
    {
        $this->modeFinancement = $modeFinancement;

        return $this;
    }

    public function getMontantFinancement(): ?float
    {
        return $this->montantFinancement;
    }

    public function setMontantFinancement(float $montantFinancement): self
    {
        $this->montantFinancement = $montantFinancement;

        return $this;
    }

    public function getDescriptionFinancement(): ?string
    {
        return $this->descriptionFinancement;
    }

    public function setDescriptionFinancement(?string $descriptionFinancement): self
    {
        $this->descriptionFinancement = $descriptionFinancement;

        return $this;
    }

    public function getExerciceRegistre(): ?ExerciceRegistre
    {
        return $this->exerciceRegistre;
    }

    public function setExerciceRegistre(?ExerciceRegistre $exerciceRegistre): self
    {
        $this->exerciceRegistre = $exerciceRegistre;

        return $this;
    }

    public function getBailleurFonds(): ?BailleurFonds
    {
        return $this->bailleurFonds;
    }

    public function setBailleurFonds(?BailleurFonds $bailleurFonds): self
    {
        $this->bailleurFonds = $bailleurFonds;

        return $this;
    }

    /**
     * @return Collection|CreditOuvert[]
     */
    public function getAssociationCredit(): Collection
    {
        return $this->associationCredit;
    }

    public function addAssociationCredit(CreditOuvert $associationCredit): self
    {
        if (!$this->associationCredit->contains($associationCredit)) {
            $this->associationCredit[] = $associationCredit;
            $associationCredit->setRessourceFinanciere($this);
        }

        return $this;
    }

    public function removeAssociationCredit(CreditOuvert $associationCredit): self
    {
        if ($this->associationCredit->removeElement($associationCredit)) {
            // set the owning side to null (unless already changed)
            if ($associationCredit->getRessourceFinanciere() === $this) {
                $associationCredit->setRessourceFinanciere(null);
            }
        }

        return $this;
    }
}
