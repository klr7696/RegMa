<?php

namespace App\Entity\Nomenclatures;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Nomenclatures\CompteFonctionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CompteFonctionRepository::class)
 */
class CompteFonction
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
    private $numeroCompteFonction;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelleCompteFonction;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $hiearachieCompteFonction;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptionCompteFonction;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $creationAt;

    /**
     * @ORM\ManyToOne(targetEntity=Nomenclature::class, inversedBy="associationCompteFonction")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nomenclature;

    /**
     * @ORM\ManyToOne(targetEntity=CompteFonction::class, inversedBy="compteFonction")
     */
    private $sousCompteFonction;

    /**
     * @ORM\OneToMany(targetEntity=CompteFonction::class, mappedBy="sousCompteFonction")
     */
    private $compteFonction;

    public function __construct()
    {
        $this->compteFonction = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCompteFonction(): ?int
    {
        return $this->numeroCompteFonction;
    }

    public function setNumeroCompteFonction(int $numeroCompteFonction): self
    {
        $this->numeroCompteFonction = $numeroCompteFonction;

        return $this;
    }

    public function getLibelleCompteFonction(): ?string
    {
        return $this->libelleCompteFonction;
    }

    public function setLibelleCompteFonction(string $libelleCompteFonction): self
    {
        $this->libelleCompteFonction = $libelleCompteFonction;

        return $this;
    }

    public function getHiearachieCompteFonction(): ?string
    {
        return $this->hiearachieCompteFonction;
    }

    public function setHiearachieCompteFonction(string $hiearachieCompteFonction): self
    {
        $this->hiearachieCompteFonction = $hiearachieCompteFonction;

        return $this;
    }

    public function getDescriptionCompteFonction(): ?string
    {
        return $this->descriptionCompteFonction;
    }

    public function setDescriptionCompteFonction(?string $descriptionCompteFonction): self
    {
        $this->descriptionCompteFonction = $descriptionCompteFonction;

        return $this;
    }

    public function getCreationAt(): ?\DateTimeImmutable
    {
        return $this->creationAt;
    }

    public function setCreationAt(\DateTimeImmutable $creationAt): self
    {
        $this->creationAt = $creationAt;

        return $this;
    }

    public function getNomenclature(): ?Nomenclature
    {
        return $this->nomenclature;
    }

    public function setNomenclature(?Nomenclature $nomenclature): self
    {
        $this->nomenclature = $nomenclature;

        return $this;
    }

    public function getSousCompteFonction(): ?self
    {
        return $this->sousCompteFonction;
    }

    public function setSousCompteFonction(?self $sousCompteFonction): self
    {
        $this->sousCompteFonction = $sousCompteFonction;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getCompteFonction(): Collection
    {
        return $this->compteFonction;
    }

    public function addCompteFonction(self $compteFonction): self
    {
        if (!$this->compteFonction->contains($compteFonction)) {
            $this->compteFonction[] = $compteFonction;
            $compteFonction->setSousCompteFonction($this);
        }

        return $this;
    }

    public function removeCompteFonction(self $compteFonction): self
    {
        if ($this->compteFonction->removeElement($compteFonction)) {
            // set the owning side to null (unless already changed)
            if ($compteFonction->getSousCompteFonction() === $this) {
                $compteFonction->setSousCompteFonction(null);
            }
        }

        return $this;
    }
}
