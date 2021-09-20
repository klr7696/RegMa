<?php

namespace App\Entity\Nomenclatures;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Nomenclatures\CompteNatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CompteNatureRepository::class)
 */
class CompteNature
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
    private $numeroCompteNature;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelleCompteNature;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $sectionCompteNature;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $hierachieCompteNature;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptionCompteNature;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $creationAt;

    /**
     * @ORM\ManyToOne(targetEntity=Nomenclature::class, inversedBy="assiociationCompteNature")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nomenclature;

    /**
     * @ORM\ManyToOne(targetEntity=CompteNature::class, inversedBy="compteNature")
     */
    private $sousCompteNature;

    /**
     * @ORM\OneToMany(targetEntity=CompteNature::class, mappedBy="sousCompteNature")
     */
    private $compteNature;

    public function __construct()
    {
        $this->compteNature = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCompteNature(): ?int
    {
        return $this->numeroCompteNature;
    }

    public function setNumeroCompteNature(int $numeroCompteNature): self
    {
        $this->numeroCompteNature = $numeroCompteNature;

        return $this;
    }

    public function getLibelleCompteNature(): ?string
    {
        return $this->libelleCompteNature;
    }

    public function setLibelleCompteNature(string $libelleCompteNature): self
    {
        $this->libelleCompteNature = $libelleCompteNature;

        return $this;
    }

    public function getSectionCompteNature(): ?string
    {
        return $this->sectionCompteNature;
    }

    public function setSectionCompteNature(string $sectionCompteNature): self
    {
        $this->sectionCompteNature = $sectionCompteNature;

        return $this;
    }

    public function getHierachieCompteNature(): ?string
    {
        return $this->hierachieCompteNature;
    }

    public function setHierachieCompteNature(string $hierachieCompteNature): self
    {
        $this->hierachieCompteNature = $hierachieCompteNature;

        return $this;
    }

    public function getDescriptionCompteNature(): ?string
    {
        return $this->descriptionCompteNature;
    }

    public function setDescriptionCompteNature(?string $descriptionCompteNature): self
    {
        $this->descriptionCompteNature = $descriptionCompteNature;

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

    public function getSousCompteNature(): ?self
    {
        return $this->sousCompteNature;
    }

    public function setSousCompteNature(?self $sousCompteNature): self
    {
        $this->sousCompteNature = $sousCompteNature;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getCompteNature(): Collection
    {
        return $this->compteNature;
    }

    public function addCompteNature(self $compteNature): self
    {
        if (!$this->compteNature->contains($compteNature)) {
            $this->compteNature[] = $compteNature;
            $compteNature->setSousCompteNature($this);
        }

        return $this;
    }

    public function removeCompteNature(self $compteNature): self
    {
        if ($this->compteNature->removeElement($compteNature)) {
            // set the owning side to null (unless already changed)
            if ($compteNature->getSousCompteNature() === $this) {
                $compteNature->setSousCompteNature(null);
            }
        }

        return $this;
    }
}
