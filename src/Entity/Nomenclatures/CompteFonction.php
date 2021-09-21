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
    private $hierachieCompteFonction;

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
     * @ORM\ManyToOne(targetEntity=CompteFonction::class, inversedBy="sousCompteFonction")
     */
    private $compteFonction;

    /**
     * @ORM\OneToMany(targetEntity=CompteFonction::class, mappedBy="compteFonction")
     */
    private $sousCompteFonction;

    public function __construct()
    {
        $this->sousCompteFonction = new ArrayCollection();
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

    public function getHierachieCompteFonction(): ?string
    {
        return $this->hierachieCompteFonction;
    }

    public function setHierachieCompteFonction(string $hierachieCompteFonction): self
    {
        $this->hierachieCompteFonction = $hierachieCompteFonction;

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

    public function getCompteFonction(): ?self
    {
        return $this->compteFonction;
    }

    public function setCompteFonction(?self $compteFonction): self
    {
        $this->compteFonction = $compteFonction;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSousCompteFonction(): Collection
    {
        return $this->sousCompteFonction;
    }

    public function addSousCompteFonction(self $sousCompteFonction): self
    {
        if (!$this->sousCompteFonction->contains($sousCompteFonction)) {
            $this->sousCompteFonction[] = $sousCompteFonction;
            $sousCompteFonction->setCompteFonction($this);
        }

        return $this;
    }

    public function removeSousCompteFonction(self $sousCompteFonction): self
    {
        if ($this->sousCompteFonction->removeElement($sousCompteFonction)) {
            // set the owning side to null (unless already changed)
            if ($sousCompteFonction->getCompteFonction() === $this) {
                $sousCompteFonction->setCompteFonction(null);
            }
        }

        return $this;
    }
}
