<?php

namespace App\Entity\Prevision;

use App\Repository\Prevision\ExerciceRegistreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExerciceRegistreRepository::class)
 */
class ExerciceRegistre
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
    private $AnneeExercice;

    /**
     * @ORM\OneToMany(targetEntity=RessourceFinanciere::class, mappedBy="exerciceRegistre", orphanRemoval=true)
     */
    private $associationRessource;

    public function __construct()
    {
        $this->associationRessource = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnneeExercice(): ?int
    {
        return $this->AnneeExercice;
    }

    public function setAnneeExercice(int $AnneeExercice): self
    {
        $this->AnneeExercice = $AnneeExercice;

        return $this;
    }

    /**
     * @return Collection|RessourceFinanciere[]
     */
    public function getAssociationRessource(): Collection
    {
        return $this->associationRessource;
    }

    public function addAssociationRessource(RessourceFinanciere $associationRessource): self
    {
        if (!$this->associationRessource->contains($associationRessource)) {
            $this->associationRessource[] = $associationRessource;
            $associationRessource->setExerciceRegistre($this);
        }

        return $this;
    }

    public function removeAssociationRessource(RessourceFinanciere $associationRessource): self
    {
        if ($this->associationRessource->removeElement($associationRessource)) {
            // set the owning side to null (unless already changed)
            if ($associationRessource->getExerciceRegistre() === $this) {
                $associationRessource->setExerciceRegistre(null);
            }
        }

        return $this;
    }
}
