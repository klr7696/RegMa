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
 *     "desactive"={"method"="patch", "path"="/registat/desactive/{id}",
 *     "input_formats"={"json"={"application/vnd.api+json",
 *     "application/merge-patch+json","application/json","application/ld+json"}},
 *     "denormalization_context"={"groups"={"desactive:write"}
 *     },
 *       "validation_groups"={"desactive"},
 *
 *                    "openapi_context"={"summary"="empêche d'ajouter une ressource financière à un exercice "},
 *                      },
 *
 *
 *     "ferme"={"method"="patch", "path"="/registat/ferme/{id}",
 *     "input_formats"={"json"={"application/vnd.api+json",
 *     "application/merge-patch+json","application/json","application/ld+json"}},
 *     "denormalization_context"={"groups"={"ferme:write"}
 *     },
 *       "validation_groups"={"ferme"},
 *
 *                    "openapi_context"={"summary"="clôturer un statut d'un registre "},
 *                      },
 *      },
 *
 *
 *     collectionOperations={
 *     "get"={"openapi_context"={"summary"="affiche un statut registre"}},
 *     "post"={"openapi_context"={"summary"="Crée un statut registre"}}
 *     },
 *     normalizationContext={
 *                       "groups"={"registat_detail:read"}, "openapi_definition_name"= "Read"
 * },
 * denormalizationContext={
 *                        "groups"={"registat_detail:write"}, "openapi_definition_name"= "Write"
 * },
 * )
 */
class StatutRegistre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"registat_detail:read","registre_detail:read"})
     *
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"registat_detail:read","registat_detail:write","registre_detail:read"})
     * @Assert\Choice(choices={"Primitif","Modificatif","Supplementaire"}, message= "saisir des informations correctes")
     */
    private $statut;
    /**
     * @ORM\Column(type="boolean")
     * @Groups({"desactive:write"})
     * @Assert\NotNull(groups={"desactive"})
     */
    private $estOuvert=true;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"ferme:write"})
     * @Assert\NotNull(groups={"ferme"})
     */
    private $estCloturer=false;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"registat_detail:read","registat_detail:write","registre_detail:read"})
     */
    private $descriptionStatut;

    /**
     * @ORM\ManyToOne(targetEntity=ExerciceRegistre::class, inversedBy="associationStatut")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"registat_detail:read","registat_detail:write"})
     */
    private $exerciceRegistre;

    /**
     * @ORM\OneToMany(targetEntity=RessourceFinanciere::class, mappedBy="statutRegistre", orphanRemoval=true)
     */
    private $associationRessource;

    public function __construct()
    {
        $this->associationRessource = new ArrayCollection();
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

    public function getEstCloturer(): ?bool
    {
        return $this->estCloturer;
    }

    public function setEstCloturer(bool $estCloturer): self
    {
        $this->estCloturer = $estCloturer;

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

    public function getEstOuvert(): ?bool
    {
        return $this->estOuvert;
    }

    public function setEstOuvert(bool $estOuvert): self
    {
        $this->estOuvert = $estOuvert;

        return $this;
    }
}
