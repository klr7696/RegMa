<?php

namespace App\Entity\Prevision;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use App\Entity\Plans\AutorisationMarche;
use App\Repository\Prevision\StatutRegistreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=StatutRegistreRepository::class)
 * @ApiResource(
 *     shortName= "registats",
 *     itemOperations={
 *     "get"={"openapi_context"={"summary"="Affiche les statuts"}},
 *     "put"={"openapi_context"={"summary"="Modifie les informations d'un registre"}},
 *
 *
 *
 *     "cloturerRegistre"={"method"="patch", "path"="/registres/cloture/{id}",
 *     "controller"="App\Controller\Previsions\ClotureRegistreController",
 *     "input_formats"={"json"={"application/vnd.api+json",
 *     "application/merge-patch+json","application/json","application/ld+json"}},
 *     "denormalization_context"={"groups"={"registre_cloture:write"}
 *     },
 *       "validation_groups"={"registre_cloture"},
 *
 *                    "openapi_context"={"summary"="clôture un registre "},
 *                      },
 *      },
 *
 *
 *     collectionOperations={
 *
 *     "changerStatut"={"method"="post","path"="/registats/changerstatut",
 *     "controller"="App\Controller\Previsions\ChangeStatutController",
 *     "openapi_context"={"summary"="defini le statut d'un registre"},
 *     "denormalization_context"={"groups"={"change_statut:write"}, "disable_type_enforcement"=true},
 *       "validation_groups"={"change_statut"}
 *     },
 *
 *      "registreOuvert"={"method"="get", "path"="/registats/registre_ouvert","datetime_format"="Y-m-d",
 *     "order"={"id"="DESC"},
 *     "normalization_context"={"groups"={"registre_ouvert:read"}},
 *     "openapi_context"={"summary"=" associer à estEncours=true&exerciceRegistre.estOuvert=true =Affiche le registre en cours
 *          on associe en plus statut=Primitif lors du changement de statut et statut=Supplémentaire lors de la cloture"
 *    }
 *     },
 *
 *     "RessourceActualisable"={"method"="get", "path"="/registats/ress_actualise","datetime_format"="Y-m-d",
 *     "normalization_context"={"groups"={"ress_actualise"}},
 *     "order"={"id"="DESC"},
 *
 *     "openapi_context"={"summary"="Affiche les ressources enregistrer à actualiser"}
 *     },
 *
 *     "get"={ "order"={"id"="DESC"}, "openapi_context"={"summary"="affiche un statut registre"}},
 *
 *     },
 *     normalizationContext={
 *                       "groups"={"registat_detail:read"}, "openapi_definition_name"= "Read"
 * },
 * denormalizationContext={
 *                        "groups"={"registat_detail:write"}, "openapi_definition_name"= "Write"
 * },
 *
 *     subresourceOperations={
 *      "api_registres_association_statuts_get_subresource"={
 *
 *
 *    "normalization_context"={"groups"={"infos:read"}}
 *
 *     }
 *     }
 * )
 * @ApiFilter(BooleanFilter::class, properties={"estEnCours","estActualisable","exerciceRegistre.estOuvert"})
 * @ApiFilter(SearchFilter::class, properties={"statut"="start"})
 * @UniqueEntity({"statut","exerciceRegistre"},message="le statut existe deja")
 */
class StatutRegistre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"registat_detail:read","registre_ouvert:read","ress_actualise",
     *     "actifressource:read","resencours:read","autoencours:read","infos:read",
     *     "regisress:read","bailleur_ressource:read","mairi_auto:read"})
     *
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"registat_detail:read","registat_detail:write","actifregistre:read",
     *     "registre_ouvert:read","resencours:read","autoencours:read",
     *     "infos:read","regisress:read","change_statut:write",
     *     "registreouvre:write","ress_actualise","bailleur_ressource:read"})
     *
     * @Assert\Choice(choices={"Primitif","Primitif modificatif","Supplémentaire"}, message= "saisir des informations correctes",
     *     groups={"Default","change_statut","mairi_auto:read"})
     */
    private $statut;
    /**
     * @ORM\Column(type="boolean")
     * @Groups({"registat_detail:read","actifregistre:read",
     *     "registre_ouvert:read","resencours:read","autoencours:read",
     *     "infos:read","registre_cloture:write","ress_actualise",
     *     "bailleur_ressource:read","mairi_auto:read","nature_credit:read"})
     * @Assert\NotNull(groups={"desactive","registre_cloture",})
     */
    private $estEnCours= true;
    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"registat_detail:read","change_statut:write"})
     */
    private $dateApprobation;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"registat_detail:read","registre_ouvert:read",
     *     "actifressource:read","resencours:read","autoencours:read",
     *     "infos:read","registre_cloture:write","ress_actualise",
     *     "bailleur_ressource:read","mairi_auto:read"})
     * @Assert\NotNull(groups={"registre_cloture"})
     *
     */
    private $estActualisable= false;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"registat_detail:read","change_statut:write"})
     *
     */
    private $descriptionStatut;

    /**
     * @ORM\ManyToOne(targetEntity=ExerciceRegistre::class, inversedBy="associationStatut",cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"registat_detail:read","registat_detail:write"})
     * @Groups({"registre_ouvert:read","actifressource:read","change_statut:write",
     *     "registre_cloture:write","ress_actualise"})
     *
     */
    private $exerciceRegistre;

    /**
     * @ORM\OneToMany(targetEntity=RessourceFinanciere::class, mappedBy="statutRegistre", orphanRemoval=true)
     * @Groups({"infos:read","ress_actualise"})
     */
    private $associationRessource;

    /**
     * @ORM\OneToMany(targetEntity=AutorisationMarche::class, mappedBy="associationStatut", orphanRemoval=true)
     */
    private $autorisationMarches;

    /**
     * @ORM\OneToOne(targetEntity=StatutRegistre::class, inversedBy="statutRegistre", cascade={"persist", "remove"})
     */
    private $statutClos;

    /**
     * @ORM\OneToOne(targetEntity=StatutRegistre::class, mappedBy="statutClos", cascade={"persist", "remove"})
     * @Groups({"change_statut:write","ress_actualise"})
     */
    private $statutRegistre;




    public function __construct()
    {
        $this->associationRessource = new ArrayCollection();
        $this->test = new ArrayCollection();
        $this->autorisationMarches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }


    public function getDescriptionStatut(): ?string
    {
        return $this->descriptionStatut;
    }

    public function setDescriptionStatut(?string $descriptionStatut): self
    {
        $this->descriptionStatut = $descriptionStatut;

        return $this;
    }

    public function getEstActualisable(): ?bool
    {
        return $this->estActualisable;
    }

    public function setEstActualisable(bool $estActualisable): self
    {
        $this->estActualisable = $estActualisable;

        return $this;
    }

    public function getExerciceRegistre(): ?ExerciceRegistre
    {
        return $this->exerciceRegistre;
    }

    public function setExerciceRegistre(?ExerciceRegistre $exerciceRegistre): self
    {
        $this->exerciceRegistre = $exerciceRegistre;

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
            $associationRessource->setStatutRegistre($this);
        }

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


    public function getDateApprobation(): ?\DateTimeInterface
    {
        return $this->dateApprobation;
    }

    public function setDateApprobation(?\DateTimeInterface $dateApprobation): self
    {
        $this->dateApprobation = $dateApprobation;

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
            $autorisationMarch->setAssociationStatut($this);
        }

        return $this;
    }

    public function removeAutorisationMarch(AutorisationMarche $autorisationMarch): self
    {
        if ($this->autorisationMarches->removeElement($autorisationMarch)) {
            // set the owning side to null (unless already changed)
            if ($autorisationMarch->getAssociationStatut() === $this) {
                $autorisationMarch->setAssociationStatut(null);
            }
        }

        return $this;
    }

    public function getStatutClos(): ?self
    {
        return $this->statutClos;
    }

    public function setStatutClos(?self $statutClos): self
    {
        $this->statutClos = $statutClos;

        return $this;
    }

    public function getStatutRegistre(): ?self
    {
        return $this->statutRegistre;
    }

    public function setStatutRegistre(?self $statutRegistre): self
    {
        // unset the owning side of the relation if necessary
        if ($statutRegistre === null && $this->statutRegistre !== null) {
            $this->statutRegistre->setStatutClos(null);
        }

        // set the owning side of the relation if necessary
        if ($statutRegistre !== null && $statutRegistre->getStatutClos() !== $this) {
            $statutRegistre->setStatutClos($this);
        }

        $this->statutRegistre = $statutRegistre;

        return $this;
    }

}
