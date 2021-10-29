<?php

namespace App\Entity\Prevision;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Prevision\StatutRegistreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=StatutRegistreRepository::class)
 * @ApiResource(
 *     shortName= "registat",
 *     itemOperations={
 *     "get"={"openapi_context"={"summary"="Affiche les statuts"}},
 *     "put"={"openapi_context"={"summary"="Modifie les informations d'un registre"}},
 *
 *     "desactiver"={"method"="patch", "path"="/registat/desactive/{id}", "controller"="App\Controller\DesactiveStatutController",
 *     "input_formats"={"json"={"application/vnd.api+json",
 *     "application/merge-patch+json","application/json","application/ld+json"}},
 *     "denormalization_context"={"groups"={"desactive:write"}
 *     },
 *       "validation_groups"={"desactive"},
 *
 *                    "openapi_context"={"summary"="assure la desactivation du d'etat du registre"},
 *                      },
 *
 *     "cloturer"={"method"="patch", "path"="/registat/cloture/{id}","controller"="App\Controller\ClotureStatutController",
 *     "input_formats"={"json"={"application/vnd.api+json",
 *     "application/merge-patch+json","application/json","application/ld+json"}},
 *     "denormalization_context"={"groups"={"desactive:write"}
 *     },
 *       "validation_groups"={"desactive"},
 *
 *                    "openapi_context"={"summary"="clôturer un statut d'un registre "},
 *                      },
 *      },
 *
 *
 *     collectionOperations={
 *     "get"={ "order"={"id"="DESC"}, "openapi_context"={"summary"="affiche un statut registre"}},
 *     "post"={"openapi_context"={"summary"="Crée un statut registre"}}
 *     },
 *     normalizationContext={
 *                       "groups"={"registat_detail:read"}, "openapi_definition_name"= "Read"
 * },
 * denormalizationContext={
 *                        "groups"={"registat_detail:write"}, "openapi_definition_name"= "Write"
 * },
 *
 * )
 *
 */
class StatutRegistre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"registat_detail:read","registre_detail:read","actifregistre:read"})
     *
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"registat_detail:read","registat_detail:write","registre_detail:read","actifregistre:read",
     *     "actifressource:read"})
     * @Assert\Choice(choices={"Primitif","Primitif modificatif","Supplémentaire"}, message= "saisir des informations correctes")
     */
    private $statut;
    /**
     * @ORM\Column(type="boolean")
     * @Groups({"registat_detail:read","desactive:write","actifregistre:read"})
     * @Assert\NotNull(groups={"desactive"})
     */
    private $estEnCours=true;
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateApprobation;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"registat_detail:read","desactive:write","registre_detail:read","actifregistre:read"})
     * @Assert\NotNull(groups={"desactive"})
     *
     */
    private $estActualisable= false;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"registat_detail:read","registat_detail:write","registre_detail:read","test:write"})
     *
     */
    private $descriptionStatut;

    /**
     * @ORM\ManyToOne(targetEntity=ExerciceRegistre::class, inversedBy="associationStatut")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"registat_detail:read","registat_detail:write","actifressource:read"})
     */
    private $exerciceRegistre;

    /**
     * @ORM\OneToMany(targetEntity=RessourceFinanciere::class, mappedBy="statutRegistre", orphanRemoval=true)
     * @Groups({"actifressource:read"})
     */
    private $associationRessource;





    public function __construct()
    {
        $this->associationRessource = new ArrayCollection();
        $this->test = new ArrayCollection();
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

    /**
     * @return Collection|ExerciceRegistre[]
     */
    public function getTest(): Collection
    {
        return $this->test;
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


}
