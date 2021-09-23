<?php

namespace App\Entity\Plans;

use App\Repository\Plans\AutorisationMarcheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AutorisationMarcheRepository::class)
 */
class AutorisationMarche
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $objetAutorisation;

    /**
     * @ORM\Column(type="float")
     */
    private $montantAutorisation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $explicationAutorisation;

    /**
     * @ORM\OneToMany(targetEntity=LotMarche::class, mappedBy="autorisationMarche", orphanRemoval=true)
     */
    private $associationLot;

    /**
     * @ORM\OneToMany(targetEntity=ExceptionMarche::class, mappedBy="autorisationMarche", orphanRemoval=true)
     */
    private $associationException;

    public function __construct()
    {
        $this->associationLot = new ArrayCollection();
        $this->associationException = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjetAutorisation(): ?string
    {
        return $this->objetAutorisation;
    }

    public function setObjetAutorisation(string $objetAutorisation): self
    {
        $this->objetAutorisation = $objetAutorisation;

        return $this;
    }

    public function getMontantAutorisation(): ?float
    {
        return $this->montantAutorisation;
    }

    public function setMontantAutorisation(float $montantAutorisation): self
    {
        $this->montantAutorisation = $montantAutorisation;

        return $this;
    }

    public function getExplicationAutorisation(): ?string
    {
        return $this->explicationAutorisation;
    }

    public function setExplicationAutorisation(?string $explicationAutorisation): self
    {
        $this->explicationAutorisation = $explicationAutorisation;

        return $this;
    }

    /**
     * @return Collection|LotMarche[]
     */
    public function getAssociationLot(): Collection
    {
        return $this->associationLot;
    }

    public function addAssociationLot(LotMarche $associationLot): self
    {
        if (!$this->associationLot->contains($associationLot)) {
            $this->associationLot[] = $associationLot;
            $associationLot->setAutorisationMarche($this);
        }

        return $this;
    }

    public function removeAssociationLot(LotMarche $associationLot): self
    {
        if ($this->associationLot->removeElement($associationLot)) {
            // set the owning side to null (unless already changed)
            if ($associationLot->getAutorisationMarche() === $this) {
                $associationLot->setAutorisationMarche(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ExceptionMarche[]
     */
    public function getAssociationException(): Collection
    {
        return $this->associationException;
    }

    public function addAssociationException(ExceptionMarche $associationException): self
    {
        if (!$this->associationException->contains($associationException)) {
            $this->associationException[] = $associationException;
            $associationException->setAutorisationMarche($this);
        }

        return $this;
    }

    public function removeAssociationException(ExceptionMarche $associationException): self
    {
        if ($this->associationException->removeElement($associationException)) {
            // set the owning side to null (unless already changed)
            if ($associationException->getAutorisationMarche() === $this) {
                $associationException->setAutorisationMarche(null);
            }
        }

        return $this;
    }
}
