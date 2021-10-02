<?php

namespace App\Entity\Prevision;

use App\Repository\Prevision\StatutRegistreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatutRegistreRepository::class)
 */
class StatutRegistre
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
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateCloture;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estCloturer;

    /**
     * @ORM\ManyToOne(targetEntity=ExerciceRegistre::class, inversedBy="associationStatut")
     * @ORM\JoinColumn(nullable=false)
     */
    private $exerciceRegistre;

    /**
     * @ORM\OneToMany(targetEntity=LienRegistre::class, mappedBy="statutRegistre", orphanRemoval=true)
     */
    private $associationActualisation;

    public function __construct()
    {
        $this->associationActualisation = new ArrayCollection();
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

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateCloture(): ?\DateTimeInterface
    {
        return $this->dateCloture;
    }

    public function setDateCloture(?\DateTimeInterface $dateCloture): self
    {
        $this->dateCloture = $dateCloture;

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

    public function getEstCloturer(): ?bool
    {
        return $this->estCloturer;
    }

    public function setEstCloturer(bool $estCloturer): self
    {
        $this->estCloturer = $estCloturer;

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

    /**
     * @return Collection|LienRegistre[]
     */
    public function getAssociationActualisation(): Collection
    {
        return $this->associationActualisation;
    }

    public function addAssociationActualisation(LienRegistre $associationActualisation): self
    {
        if (!$this->associationActualisation->contains($associationActualisation)) {
            $this->associationActualisation[] = $associationActualisation;
            $associationActualisation->setStatutRegistre($this);
        }

        return $this;
    }

    public function removeAssociationActualisation(LienRegistre $associationActualisation): self
    {
        if ($this->associationActualisation->removeElement($associationActualisation)) {
            // set the owning side to null (unless already changed)
            if ($associationActualisation->getStatutRegistre() === $this) {
                $associationActualisation->setStatutRegistre(null);
            }
        }

        return $this;
    }
}
