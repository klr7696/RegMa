<?php

namespace App\Entity\Nomenclatures;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Entity\Prevision\ExerciceRegistre;
use App\Repository\Nomenclatures\NomenclatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=NomenclatureRepository::class)
 * @ApiResource(
 *     shortName= "nomenclatures",
 *     itemOperations={
 *     "get"={"openapi_context"={"summary"="Affiche les informations d'une nomenclature"}}
 *     , "patch"={"openapi_context"={"summary"="Actualise les informations d'une nomenclature existante"}}
 * },
 *     collectionOperations={
 *     "get"={"openapi_context"={"summary"="Affiche les informations des nomenclatures"}}
 * ,"post"={"openapi_context"={"summary"="Crée une nomenclature"}}
 * },
 *
 *      normalizationContext={"groups"={"nomen_detail:read","nomen_compte:read"}, "openapi_definition_name"= "Read"},
 *      denormalizationContext={"groups"={"nomen_detail:write"}, "openapi_definition_name"= "Write"},
 *      subresourceOperations={
 *              "assiociation_compte_natures_get_subresource"= {"path" ="/nomenclatures/{id}/natures",
 *              "openapi_context"={"summary"="liste les comptes nature de la nomenclature"}
 *     },
 *     "association_compte_fonctions_get_subresource"={"path" ="/nomenclatures/{id}/fonctions",
 *              "openapi_context"={"summary"="liste les comptes fonctions de la nomenclature"}
 *             }
 *     },
 *
 *
 * )
 *
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
     * @Groups({"nomen_detail:read","nomen_detail:write"})
     */
    private $anneeApplication;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Groups({"nomen_detail:read","nomen_detail:write"})
     */
    private $decretAdoption;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"nomen_detail:read","nomen_detail:write"})
     */
    private $dateAdoption;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Groups({"nomen_detail:read","nomen_detail:write"})
     */
    private $decretApplication;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"nomen_detail:read","nomen_detail:write"})
     */
    private $dateApplication;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"nomen_detail:read","nomen_detail:write"})
     */
    private $descriptionNomenclature;



    /**
     * @ORM\OneToMany(targetEntity=CompteNature::class, mappedBy="nomenclature", orphanRemoval=true)
     * @Groups({"nomen_detail:read"})
     * @ApiSubresource(maxDepth=1)
     */
    private $assiociationCompteNature;

    /**
     * @ORM\OneToMany(targetEntity=CompteFonction::class, mappedBy="nomenclature", orphanRemoval=true)
     * @Groups({"nomen_detail:read"})
     * @ApiSubresource(maxDepth=1)
     */
    private $associationCompteFonction;

    /**
     * @ORM\OneToMany(targetEntity=ExerciceRegistre::class, mappedBy="nomenclature", orphanRemoval=true)
     */
    private $associationExercice;

    public function __construct()
    {
        $this->assiociationCompteNature = new ArrayCollection();
        $this->associationCompteFonction = new ArrayCollection();
        $this->associationExercice = new ArrayCollection();
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

    public function getDescriptionNomenclature(): ?string
    {
        return $this->descriptionNomenclature;
    }

    public function setDescriptionNomenclature(?string $descriptionNomenclature): self
    {
        $this->descriptionNomenclature = $descriptionNomenclature;

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

    /**
     * @return Collection|ExerciceRegistre[]
     */
    public function getAssociationExercice(): Collection
    {
        return $this->associationExercice;
    }

    public function addAssociationExercice(ExerciceRegistre $associationExercice): self
    {
        if (!$this->associationExercice->contains($associationExercice)) {
            $this->associationExercice[] = $associationExercice;
            $associationExercice->setNomenclature($this);
        }

        return $this;
    }

    public function removeAssociationExercice(ExerciceRegistre $associationExercice): self
    {
        if ($this->associationExercice->removeElement($associationExercice)) {
            // set the owning side to null (unless already changed)
            if ($associationExercice->getNomenclature() === $this) {
                $associationExercice->setNomenclature(null);
            }
        }

        return $this;
    }
}
