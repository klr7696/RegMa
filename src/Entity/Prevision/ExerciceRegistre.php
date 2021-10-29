<?php

namespace App\Entity\Prevision;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
//use ApiPlatform\Core\Bridge\Elasticsearch\DataProvider\Filter\TermFilter;
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
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *      shortName= "registres",
 * itemOperations={
 *                  "get"={ "normalization_context"={"registre_detail:read"},
 *     "openapi_context"={"summary"="Affiche les informations d'un registre "}},
 *
 *     "ouvrir"={"method"="patch", "path"="/registres/ouvre/{id}", "controller"="App\Controller\OuvrirRegistreController",
 *     "input_formats"={"json"={"application/vnd.api+json",
 *           "application/merge-patch+json","application/json","application/ld+json"}},
 *
 *     "denormalization_context"={"groups"={"ouvrir:write"}}
 *     ,
 *       "validation_groups"={"ouvrir"},
 *
 *                    "openapi_context"={"summary"="ouvre un registre pour un exercice"},
 *                 },
 *
 *    "cloturer"={"method"="patch", "path"="/registres/cloture/{id}", "controller"="App\Controller\ClotureRegistreController",
 *     "input_formats"={"json"={"application/vnd.api+json",
 *           "application/merge-patch+json","application/json","application/ld+json"}},
 *
 *     "denormalization_context"={"groups"={"cloture:write"}}
 *     ,
 *       "validation_groups"={"cloture"},
 *
 *                    "openapi_context"={"summary"="clôture un registre d'un exercice"},
 *                 },
 *
 *     "delete"={"openapi_context"={"summary"="Supprime un registre"}},
 *     "put"={"openapi_context"={"summary"="Modifie les informations d'un registre"}}
 *
 * },
 * collectionOperations={
 *     "actifnomen"={"method"="get", "path"="/registres/actifnomenclature",
 * "normalization_context"={"groups"={"actifnomen:read"}},
 *     "openapi_context"={"summary"="Affiche la nomenclature affectée au registre"}
 *     },
 *
 *      "actifregistre"={"method"="get", "path"="/registres/actif",
 * "normalization_context"={"groups"={"actifregistre:read"}},
 *     "openapi_context"={"summary"="Affiche le registre en cours"}
 *     },
 *
 *
 *
 *                      "get"={
 *     "order"={"id"="DESC","associationStatut.id"="DESC"},
 *     "openapi_context"={"summary"="Affiche les informations des registres"}
 *     }
 *                  ,"post"={"openapi_context"={"summary"="Crée un registre"}}
 * },
 *
 * normalizationContext={
 *                       "groups"={"recup:read"}, "openapi_definition_name"= "Read"
 * },
 * denormalizationContext={
 *                        "groups"={"registre_detail:write"}, "openapi_definition_name"= "Write"
 * },
 *     subresourceOperations={}
 *  )
 * @ORM\Entity(repositoryClass=ExerciceRegistreRepository::class)
 * @UniqueEntity("anneeExercice", message= "l'année de gestion existe déjà")
 * @ApiFilter(SearchFilter::class, properties={"associationStatut.statut"="partial"})
 * @ApiFilter(BooleanFilter::class, properties={"estEnCours","associationStatut.estCloturer","associationStatut.estAjoutable"})
 */
class ExerciceRegistre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"registre_detail:read","recup:read","actifnomen:read","actifregistre:read",
     *     "actifressource:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=4)
     * @Groups({"registre_detail:read","registre_detail:write","recup:read",
     *     "actifnomen:read","actifregistre:read",
     *     "actifressource:read"})
     * @Assert\NotBlank(message="ne peut pas être vide")
     * @Assert\Length(min=4, max=4, exactMessage="l'annee n'est pas valide")
     */
    private $anneeExercice;


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
     * @Groups({"registre_detail:read","registre_detail:write","recup:read",
     * "actifnomen:read"})
     */
    private $nomenclature;
    /**
     * @ORM\OneToMany(targetEntity=StatutRegistre::class, mappedBy="exerciceRegistre", orphanRemoval=true)
     * @Groups({"registre_detail:read","recup:read","actifregistre:read"})
     * @ApiSubresource()
     */
    private $associationStatut;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotNull(groups={"cloture","ouvrir"})
     * @Groups({"registre_detail:read","cloture:write","ouvrir:write","recup:read",
     * "actifregistre:read"})
     */
    private $estOuvert = false;
    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotNull(groups={"cloture"})
     * @Groups({"registre_detail:read","cloture:write","recup:read","actifregistre:read"})
     */
    private $estCloture= false;


    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"registre_detail:read","cloture:write"})
     * @Assert\NotBlank(groups={"cloture"}, message="veuillez saisir la date de cloture de l'exercice en cours")
     */
    private $dateCloture;

    /**
     * @ORM\OneToMany(targetEntity=RessourceFinanciere::class, mappedBy="exerciceRegistre", orphanRemoval=true)
     * @Groups({"recup:read"})
     */
    private $associationRessource;

    /**
     * @ORM\OneToMany(targetEntity=PlanPassation::class, mappedBy="exerciceRegistre", orphanRemoval=true)
     * @Groups({"recup:read"})
     */
    private $associationPlan;




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
        return $this->anneeExercice;
    }

    public function setAnneeExercice(string $anneeExercice): self
    {
        $this->anneeExercice = $anneeExercice;

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

    public function getEstOuvert(): ?bool
    {
        return $this->estOuvert;
    }

    public function setEstOuvert(bool $estOuvert): self
    {
        $this->estOuvert = $estOuvert;

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

    /**
     * @return Collection|StatutRegistre[]
     */
    public function getStatutTest(): Collection
    {
        return $this->statutTest;
    }

    public function getEstCloture(): ?bool
    {
        return $this->estCloture;
    }

    public function setEstCloture(bool $estCloture): self
    {
        $this->estCloture = $estCloture;

        return $this;
    }




}
