<?php

namespace App\Entity\Prevision;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Entity\Nomenclatures\Nomenclature;
use App\Entity\Plans\AutorisationMarche;
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
 *     "get"={"normalization_context"={"groups"={"registre_detail:read"}},
 *            "openapi_context"={"summary"="Affiche les informations d'un registre "}},
 *
 *     "delete"={"openapi_context"={"summary"="Supprime un registre"}},
 *     "put"={"openapi_context"={"summary"="Modifie les informations d'un registre"}}
 *
 * },
 * collectionOperations={
 *
 *      "get"={"normalization_context"={"groups"={"registre_collect:read"}},
 *     "openapi_context"={"summary"="fournit les details d'un registre
 *  pour ouvrir un registre=estOuvert=false&estCloture=false"}, "datetime_format"="Y-m-d",
 *     "order"={"id"="DESC"}},
 *
 *     "actifnomen"={"method"="get", "path"="/registres/actifnomenclature",
 * "normalization_context"={"groups"={"actifnomen:read"}},
 *     "openapi_context"={"summary"="Affiche la nomenclature affectée au registre"}
 *     },
 *
 *      "ouvrir"={ "method"="post", "path"="/registres/ouvrir",
 *     "controller"="App\Controller\Previsions\OuvrirRegistreController",
 *     "openapi_context"={"summary"="permet l'ouverture d'un registre"},
 *     "denormalization_context"={"groups"={"registreouvre:write"},"disable_type_enforcement"=true}
 *     },
 *
 *
 *
 * },
 *
 *
 * denormalizationContext={
 *                        "groups"={"registre_detail:write"}, "openapi_definition_name"= "Write",
 *     "disable_type_enforcement"=true
 * },
 *     subresourceOperations={
 *      "association_statuts_get_subresource"={
 *     "path"="/registres/{id}/infos",
 *     "openapi_context"={"summary"="fournit les informations d'un registre"},
 *     },
 *
 *      "association_ressources_get_subresource"={
 *     "path"="/registres/{id}/ressources",
 *     "openapi_context"={"summary"="listes les ressources d'un registre"}
 *     },
        "autorisation_marches_get_subresource"={}
 *
 *     }
 *  )
 * @ORM\Entity(repositoryClass=ExerciceRegistreRepository::class)
 * @UniqueEntity("anneeExercice", message= "l'année de gestion existe déjà")
 * @ApiFilter(SearchFilter::class, properties={"associationStatut.statut"="exact"})
 * @ApiFilter(BooleanFilter::class, properties={"estOuvert"})
 */
class ExerciceRegistre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"registre_detail:read","actifnomen:read","registre_ouvert:read",
     *     "actifressource:read","resencours:read","autoencours:read","registre_collect:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="l'année est incorrect car vide")
     * @Assert\Type(type="numeric",message="l'année est incorrect")
     * @Assert\Length(min=4,max=4, exactMessage="l'année est incorrect")
     * @Groups({"registre_detail:write",
     *     "actifnomen:read",
     *     "registre_ouvert:read","registre_detail:read","resencours:read",
     *     "autoencours:read","registre_collect:read","registreouvre:write"
     * })
     *
     */
    private $anneeExercice;


    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"registre_detail:write","recup:read",
     *     "registre_collect:read","registreouvre:write"})
     */
    private $ordonateurExercice;
    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"registre_detail:write","registre_detail:read",
     *     "registre_collect:read","registreouvre:write"})
     */
    private $dateVote;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"registre_detail:write","registre_detail:read",
     *     "registre_collect:read","registreouvre:write"})
     */
    private $dateAdoption;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"registre_detail:write","registre_detail:read",
     *     "registre_collect:read","registreouvre:write"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Nomenclature::class, inversedBy="associationExercice")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"registre_detail:write",
     * "actifnomen:read","registre_detail:read",
     *     "registre_collect:read","registreouvre:write"})
     */
    private $nomenclature;
    /**
     * @ORM\OneToMany(targetEntity=StatutRegistre::class, mappedBy="exerciceRegistre", orphanRemoval=true,cascade={"persist", "remove"})
     * @Groups({"registreouvre:write"})
     * @ApiSubresource()
     */
    private $associationStatut;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Groups({ "registre_ouvert:read","registre_detail:read","actifressource:read",
     *     "resencours:read","autoencours:read","registre_collect:read","registre_cloture:write"})
     */
    private $estOuvert = true;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"registre_detail:read","registre_collect:read","registre_cloture:write"})
     * @Assert\NotBlank(groups={"cloture"}, message="veuillez saisir la date de cloture de l'exercice en cours")
     */
    private $dateCloture;

    /**
     * @ORM\OneToMany(targetEntity=RessourceFinanciere::class, mappedBy="exerciceRegistre", orphanRemoval=true)
     * @ApiSubresource(maxDepth=1)
     *
     */
    private $associationRessource;

    /**
     * @ORM\OneToMany(targetEntity=PlanPassation::class, mappedBy="exerciceRegistre", orphanRemoval=true)
     *
     */
    private $associationPlan;

    /**
     * @ORM\OneToMany(targetEntity=AutorisationMarche::class, mappedBy="associationRegistre", orphanRemoval=true)
     * @ApiSubresource(maxDepth=1)
     */
    private $autorisationMarches;




    public function __construct()
    {
        $this->associationRessource = new ArrayCollection();
        $this->associationStatut = new ArrayCollection();
        $this->associationPlan = new ArrayCollection();
        $this->autorisationMarches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnneeExercice(): ?int
    {
        return $this->anneeExercice;
    }

    public function setAnneeExercice($anneeExercice): self
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

    public function getDateVote(): ? \DateTimeInterface
    {
        return $this->dateVote;
    }

    public function setDateVote(?\DateTimeInterface $dateVote): self
    {
        $this->dateVote = $dateVote;

        return $this;
    }

    public function getDateAdoption(): ? \DateTimeInterface
    {
        return $this->dateAdoption;
    }

    public function setDateAdoption(?\DateTimeInterface $dateAdoption): self
    {
        $this->dateAdoption = $dateAdoption;

        return $this;
    }

    public function getDateCloture(): ? \DateTimeInterface
    {
        return $this->dateCloture;

    }

    public function setDateCloture(?\DateTimeInterface $dateCloture): self
    {
        $this->dateCloture = $dateCloture;

        return $this;
    }


    /**
     * @return Collection|AutorisationMarche[]
     */
    public function getAutorisationMarches(): Collection
    {
        return $this->autorisationMarches;
    }

    public function addAutorisationMarch(AutorisationMarche $autorisationMarch): self
    {
        if (!$this->autorisationMarches->contains($autorisationMarch)) {
            $this->autorisationMarches[] = $autorisationMarch;
            $autorisationMarch->setAssociationRegistre($this);
        }

        return $this;
    }

    public function removeAutorisationMarch(AutorisationMarche $autorisationMarch): self
    {
        if ($this->autorisationMarches->removeElement($autorisationMarch)) {
            // set the owning side to null (unless already changed)
            if ($autorisationMarch->getAssociationRegistre() === $this) {
                $autorisationMarch->setAssociationRegistre(null);
            }
        }

        return $this;
    }




}
