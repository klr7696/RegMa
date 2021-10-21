<?php

namespace App\Entity\Prevision;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Entity\Nomenclatures\Nomenclature;
use App\Entity\Plans\PlanPassation;
use App\Repository\Prevision\ExerciceRegistreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      shortName= "registres",
 * itemOperations={
 *                  "get"={
 *
 *     "openapi_context"={"summary"="Affiche les informations d'un registre "}}
 *
 *                   , "patch"={
 *     "input_formats"={"json"={"application/vnd.api+json",
 *     "application/merge-patch+json","application/json","application/ld+json"}

 *     },
 *     "denormalization_context"={"groups"={"actualise:write"}
 *     },
 *       "validation_groups"={"statut"},
 *
 *                    "openapi_context"={"summary"="Abroge une nomenclature existante"},
 *                      },
 *
 *     "delete"={"openapi_context"={"summary"="Supprime un registre"}},
 *     "put"={"openapi_context"={"summary"="Modifie les informations d'un registre"}}
 *
 * },
 * collectionOperations={
 *                      "get"={
 *                              "openapi_context"={"summary"="Affiche les informations des registres"}}
 *                               ,"post"={"openapi_context"={"summary"="Crée un registre"}}
 * },
 *
 * normalizationContext={
 *                       "groups"={"registre_detail:read"}, "openapi_definition_name"= "Read"
 * },
 * denormalizationContext={
 *                        "groups"={"registre_detail:write"}, "openapi_definition_name"= "Write"
 * },
 *     subresourceOperations={}
 *  )
 * @ORM\Entity(repositoryClass=ExerciceRegistreRepository::class)
 * @UniqueEntity()
 */
class ExerciceRegistre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"registre_detail:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=4)
     * @Groups({"registre_detail:read","registre_detail:write"})
     */
    private $AnneeExercice;


    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"registre_detail:read","registre_detail:write"})
     */
    private $ordonateurExercice;
    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"registre_detail:read","registre_detail:write"})
     */
    private $dateVote;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"registre_detail:read","registre_detail:write"})
     */
    private $dateAdoption;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"registre_detail:read","registre_detail:write"})
     */
    private $description;
    /**
     * @ORM\ManyToOne(targetEntity=Nomenclature::class, inversedBy="associationExercice")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"registre_detail:read","registre_detail:write"})
     */
    private $nomenclature;
    /**
     * @ORM\OneToMany(targetEntity=StatutRegistre::class, mappedBy="exerciceRegistre", orphanRemoval=true)
     * @Groups({"registre_detail:read"})
     * @ApiSubresource()
     */
    private $associationStatut;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estEnCours =true;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"registre_detail:read"})
     */
    private $dateCloture;

    /**
     * @ORM\OneToMany(targetEntity=RessourceFinanciere::class, mappedBy="exerciceRegistre", orphanRemoval=true)
     */
    private $associationRessource;

    /**
     * @ORM\OneToMany(targetEntity=PlanPassation::class, mappedBy="exerciceRegistre", orphanRemoval=true)
     */
    private $associationPlan;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estAjoutable=true;



    public function __construct()
    {
        $this->associationRessource = new ArrayCollection();
        $this->associationStatut = new ArrayCollection();
        $this->associationPlan = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnneeExercice(): ?string
    {
        return $this->AnneeExercice;
    }

    public function setAnneeExercice(string $AnneeExercice): self
    {
        $this->AnneeExercice = $AnneeExercice;

        return $this;
    }
    public function getOrdonateurExercice(): ?string
    {
        return $this->ordonateurExercice;
    }

    public function setOrdonateurExercice(string $ordonateurExercice): self
    {
        $this->ordonateurExercice = $ordonateurExercice;

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



    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEstEnCours(): ?bool
    {
        return $this->estEnCours;
    }

    public function setEstEnCours(bool $estEnCours): self
    {
        $this->estEnCours = $estEnCours;

        return $this;
    }

    /**
     * @return Collection|StatutRegistre[]
     */
    public function getAssociationStatut(): Collection
    {
        return $this->associationStatut;
    }

    public function addAssociationStatut(StatutRegistre $associationStatut): self
    {
        if (!$this->associationStatut->contains($associationStatut)) {
            $this->associationStatut[] = $associationStatut;
            $associationStatut->setExerciceRegistre($this);
        }

        return $this;
    }

    public function removeAssociationStatut(StatutRegistre $associationStatut): self
    {
        if ($this->associationStatut->removeElement($associationStatut)) {
            // set the owning side to null (unless already changed)
            if ($associationStatut->getExerciceRegistre() === $this) {
                $associationStatut->setExerciceRegistre(null);
            }
        }

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

    /**
     * @return Collection|PlanPassation[]
     */
    public function getAssociationPlan(): Collection
    {
        return $this->associationPlan;
    }

    public function addAssociationPlan(PlanPassation $associationPlan): self
    {
        if (!$this->associationPlan->contains($associationPlan)) {
            $this->associationPlan[] = $associationPlan;
            $associationPlan->setExerciceRegistre($this);
        }

        return $this;
    }

    public function removeAssociationPlan(PlanPassation $associationPlan): self
    {
        if ($this->associationPlan->removeElement($associationPlan)) {
            // set the owning side to null (unless already changed)
            if ($associationPlan->getExerciceRegistre() === $this) {
                $associationPlan->setExerciceRegistre(null);
            }
        }

        return $this;
    }

    public function getDateVote(): ?string
    {
        return $this->dateVote->format('d/m/Y');
    }

    public function setDateVote(?\DateTimeInterface $dateVote): self
    {
        $this->dateVote = $dateVote;

        return $this;
    }

    public function getDateAdoption(): ?string
    {
        return $this->dateAdoption->format('d/m/Y');
    }

    public function setDateAdoption(?\DateTimeInterface $dateAdoption): self
    {
        $this->dateAdoption = $dateAdoption;

        return $this;
    }

    public function getDateCloture(): ?string
    {
        $cloture= $this->dateCloture;
        if($cloture !== NULL){
            return $cloture->format('d/m/Y');
        }
        return "";
    }

    public function setDateCloture(?\DateTimeInterface $dateCloture): self
    {
        $this->dateCloture = $dateCloture;

        return $this;
    }

    public function getEstAjoutable(): ?bool
    {
        return $this->estAjoutable;
    }

    public function setEstAjoutable(bool $estAjoutable): self
    {
        $this->estAjoutable = $estAjoutable;

        return $this;
    }
}
