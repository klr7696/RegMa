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
 *     "desactiver"={"method"="patch", "path"="/registats/desactive/{id}", "controller"="App\Controller\DesactiveStatutController",
 *     "input_formats"={"json"={"application/vnd.api+json",
 *     "application/merge-patch+json","application/json","application/ld+json"}},
 *     "denormalization_context"={"groups"={"desactive:write"}
 *     },
 *       "validation_groups"={"desactive"},
 *
 *                    "openapi_context"={"summary"="assure la desactivation du d'etat du registre"},
 *                      },
 *
 *     "cloturerRegistre"={"method"="patch", "path"="/registres/cloture/{id}",
 *     "controller"="App\Controller\Previsions\ClotureRegistreController",
 *     "input_formats"={"json"={"application/vnd.api+json",
 *     "application/merge-patch+json","application/json","application/ld+json"}},
 *     "denormalization_context"={"groups"={"registre_cloture:write"}
 *     },
 *       "validation_groups"={"registre_cloture"},
 *
 *                    "openapi_context"={"summary"="clôturer un statut d'un registre "},
 *                      },
 *      },
 *
 *
 *     collectionOperations={
 *
 *     "definir"={ "method"="post", "path"="/registats/definis",
 *     "openapi_context"={"summary"="defini le statut primitif pour un registre"},},
 *
 *     "changer"={"method"="post","path"="/registres/changerstatut",
 *     "controller"="App\Controller\Previsions\ChangeStatutController",
 *     "openapi_context"={"summary"="defini le statut d'un registre"},
 *     "denormalization_context"={"groups"={"change:write"}, "disable_type_enforcement"=true},
 *       "validation_groups"={"change"}
 *     },
 *
 *      "registreOuvert"={"method"="get", "path"="/registres/ouvert","datetime_format"="Y-m-d",
 *     "order"={"id"="DESC"},
 * "normalization_context"={"groups"={"registre_ouvert:read"}},
 *     "openapi_context"={"summary"="Affiche le registre en cours pour un registre en cours.
 * Utiliser au niveau des ressources=estEncours=true&exerciceRegistre.estOuvert=true
 *    pour changer le statut d’un registre=estEncours=true&exerciceRegistre.estOuvert=true&statut=Primitif
 *     pour actualiser une ressource estActualisable=true&exerciceRegistre.estOuvert=true"}
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
 * @ApiFilter(BooleanFilter::class, properties={"estEncours","estActualisable","exerciceRegistre.estOuvert","exerciceRegistre.estCloture"})
 * @ApiFilter(SearchFilter::class, properties={"statut"="start"})
 * @UniqueEntity({"statut","exerciceRegistre"},message="le statut existe deja")
 */
class StatutRegistre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"registat_detail:read","registre_ouvert:read",
     *     "actifressource:read","resencours:read","autoencours:read","infos:read",
     *     "regisress:read"})
     *
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"registat_detail:read","registat_detail:write","actifregistre:read",
     *     "registre_ouvert:read","resencours:read","autoencours:read",
     *     "infos:read","regisress:read","change:write","registreouvre:write"})
     *
     * @Assert\Choice(choices={"Primitif","Primitif modificatif","Supplémentaire"}, message= "saisir des informations correctes",
     *     groups={"Default","change"})
     */
    private $statut;
    /**
     * @ORM\Column(type="boolean")
     * @Groups({"registat_detail:read","desactive:write","actifregistre:read",
     *     "registre_ouvert:read","resencours:read","autoencours:read",
     *     "infos:read","registre_cloture:write"})
     * @Assert\NotNull(groups={"desactive","registre_cloture"})
     */
    private $estEnCours=true;
    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"registat_detail:read","change:write"})
     */
    private $dateApprobation;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"registat_detail:read","desactive:write","registre_ouvert:read",
     *     "actifressource:read","resencours:read","autoencours:read",
     *     "infos:read","registre_cloture:write"})
     * @Assert\NotNull(groups={"desactive","registre_cloture"})
     *
     */
    private $estActualisable= false;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"registat_detail:read","change:write"})
     *
     */
    private $descriptionStatut;

    /**
     * @ORM\ManyToOne(targetEntity=ExerciceRegistre::class, inversedBy="associationStatut",cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"registat_detail:read","registat_detail:write"})
     * @Groups({"registre_ouvert:read","actifressource:read","change:write","registre_cloture:write"})
     *
     */
    private $exerciceRegistre;

    /**
     * @ORM\OneToMany(targetEntity=RessourceFinanciere::class, mappedBy="statutRegistre", orphanRemoval=true)
     * @Groups({"infos:read"})
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
     * @Groups({"desactive:write","change:write"})
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
