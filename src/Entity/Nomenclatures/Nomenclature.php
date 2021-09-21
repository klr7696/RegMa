<?php

namespace App\Entity\Nomenclatures;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Nomenclatures\NomenclatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=NomenclatureRepository::class)
 */
class Nomenclature
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
    private $anneeApplication;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $decretAdoption;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateAdoption;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $decretApplication;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateApplication;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $referenceVisa;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateVisa;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $structureVisa;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptionNomenclature;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $creationAt;

    /**
     * @ORM\OneToMany(targetEntity=CompteNature::class, mappedBy="nomenclature", orphanRemoval=true)
     */
    private $assiociationCompteNature;

    /**
     * @ORM\OneToMany(targetEntity=CompteFonction::class, mappedBy="nomenclature", orphanRemoval=true)
     */
    private $associationCompteFonction;

    public function __construct()
    {
        $this->assiociationCompteNature = new ArrayCollection();
        $this->associationCompteFonction = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnneeApplication(): ?int
    {
        return $this->anneeApplication;
    }

    public function setAnneeApplication(int $anneeApplication): self
    {
        $this->anneeApplication = $anneeApplication;

        return $this;
    }

    public function getDecretAdoption(): ?string
    {
        return $this->decretAdoption;
    }

    public function setDecretAdoption(?string $decretAdoption): self
    {
        $this->decretAdoption = $decretAdoption;

        return $this;
    }

    public function getDateAdoption(): ?\DateTimeInterface
    {
        return $this->dateAdoption;
    }

    public function setDateAdoption(?\DateTimeInterface $dateAdoption): self
    {
        $this->dateAdoption = $dateAdoption;

        return $this;
    }

    public function getDecretApplication(): ?string
    {
        return $this->decretApplication;
    }

    public function setDecretApplication(?string $decretApplication): self
    {
        $this->decretApplication = $decretApplication;

        return $this;
    }

    public function getDateApplication(): ?\DateTimeInterface
    {
        return $this->dateApplication;
    }

    public function setDateApplication(?\DateTimeInterface $dateApplication): self
    {
        $this->dateApplication = $dateApplication;

        return $this;
    }

    public function getReferenceVisa(): ?string
    {
        return $this->referenceVisa;
    }

    public function setReferenceVisa(?string $referenceVisa): self
    {
        $this->referenceVisa = $referenceVisa;

        return $this;
    }

    public function getDateVisa(): ?\DateTimeInterface
    {
        return $this->dateVisa;
    }

    public function setDateVisa(?\DateTimeInterface $dateVisa): self
    {
        $this->dateVisa = $dateVisa;

        return $this;
    }

    public function getStructureVisa(): ?string
    {
        return $this->structureVisa;
    }

    public function setStructureVisa(?string $structureVisa): self
    {
        $this->structureVisa = $structureVisa;

        return $this;
    }

    public function getDescriptionNomenclature(): ?string
    {
        return $this->descriptionNomenclature;
    }

    public function setDescriptionNomenclature(?string $descriptionNomenclature): self
    {
        $this->descriptionNomenclature = $descriptionNomenclature;

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

    /**
     * @return Collection|CompteNature[]
     */
    public function getAssiociationCompteNature(): Collection
    {
        return $this->assiociationCompteNature;
    }

    public function addAssiociationCompteNature(CompteNature $assiociationCompteNature): self
    {
        if (!$this->assiociationCompteNature->contains($assiociationCompteNature)) {
            $this->assiociationCompteNature[] = $assiociationCompteNature;
            $assiociationCompteNature->setNomenclature($this);
        }

        return $this;
    }

    public function removeAssiociationCompteNature(CompteNature $assiociationCompteNature): self
    {
        if ($this->assiociationCompteNature->removeElement($assiociationCompteNature)) {
            // set the owning side to null (unless already changed)
            if ($assiociationCompteNature->getNomenclature() === $this) {
                $assiociationCompteNature->setNomenclature(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CompteFonction[]
     */
    public function getAssociationCompteFonction(): Collection
    {
        return $this->associationCompteFonction;
    }

    public function addAssociationCompteFonction(CompteFonction $associationCompteFonction): self
    {
        if (!$this->associationCompteFonction->contains($associationCompteFonction)) {
            $this->associationCompteFonction[] = $associationCompteFonction;
            $associationCompteFonction->setNomenclature($this);
        }

        return $this;
    }

    public function removeAssociationCompteFonction(CompteFonction $associationCompteFonction): self
    {
        if ($this->associationCompteFonction->removeElement($associationCompteFonction)) {
            // set the owning side to null (unless already changed)
            if ($associationCompteFonction->getNomenclature() === $this) {
                $associationCompteFonction->setNomenclature(null);
            }
        }

        return $this;
    }
}
