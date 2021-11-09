<?php

namespace App\Entity\Prevision;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Administration\MairieCommunale;
use App\Entity\Nomenclatures\CompteNature;
use App\Entity\Plans\AutorisationMarche;
use App\Repository\Prevision\AllocationCreditRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     shortName= "allocations",
 *     itemOperations={
 *                  "get"={"openapi_context"={"summary"="Affiche les informations d'une allocation "}},
 *     "delete"={"openapi_context"={"summary"="Supprime une allocation"}},
 *     "put"={"openapi_context"={"summary"="Modifie les informations une allocation"}},
 *
 *
 *
 *   },
 * collectionOperations={
 *                      "get"={ "order"={"id"="DESC"},
 *                              "openapi_context"={"summary"="Affiche les informations des registres"}}
 *                               ,"inscription"={ "method"="post", "path"="/allocations/inscription",
 *     "openapi_context"={"summary"="Crée une allocation"},},
 *
 *     "actualisation"={"method"="post","path"="/allocations/actualise",
 *     "controller"="App\Controller\Previsions\ActualiseAllocationController",
 *     "openapi_context"={"summary"="Actualise une allocation"},
 *     "denormalization_context"={"groups"={"alactualise:write"},"disable_type_enforcement"=true},
 *       "validation_groups"={"alactualise"}
 *     }
 *
 * },
 *
 * normalizationContext={
 *                       "groups"={"allocation_detail:read"}, "openapi_definition_name"= "Read"
 * },
 * denormalizationContext={
 *                        "groups"={"allocation_detail:write"}, "openapi_definition_name"= "Write"
 * },
 *     subresourceOperations={
 *     "api_ouverts_association_allocations_get_subresource"={

 *     "normalization_context"={"groups"={"ouveralloc:read"}}
 *     },
 *     "api_autorisations_association_allocations_get_subresource"={
 *     "normalization_context"={"groups"={"autoalloc:read"}}
 *     }
 *     }
 * )
 * @ORM\Entity(repositoryClass=AllocationCreditRepository::class)
 */
class AllocationCredit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"allocation_detail:read","allocation_detail:write",
     *     "alactualise:write","ouveralloc:read","autoalloc:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Groups({"allocation_detail:read","allocation_detail:write",
     *     "alactualise:write","ouveralloc:read","autoalloc:read"})
     * @Assert\Type(type="numeric", message="le montant est incorrect")
     */
    private $montantAllouer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"allocation_detail:read","allocation_detail:write",
     *     "alactualise:write","ouveralloc:read","autoalloc:read"})
     */
    private $descriptionAllocation;

    /**
     * @ORM\ManyToOne(targetEntity=CreditOuvert::class, inversedBy="associationAllocation")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"allocation_detail:read","allocation_detail:write",
     *     "alactualise:write","bailleurs_detail:read","autoalloc:read"})
     *
     */
    private $creditOuvert;



    /**
     * @ORM\Column(type="boolean")
     *
     * @Groups({"allocation_detail:read","ouveralloc:read","autoalloc:read"})
     */
    private $estValide =true;

    /**
     * @ORM\ManyToOne(targetEntity=AutorisationMarche::class, inversedBy="associationAllocation")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"alactualise:write","allocation_detail:write","ouveralloc:read"})
     */
    private $autorisationMarche;

    /**
     * @ORM\OneToOne(targetEntity=AllocationCredit::class, cascade={"persist", "remove"})
     * @Groups({"alactualise:write","ouveralloc:read","autoalloc:read"})
     */
    private $actualiseAllocation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantAllouer(): ?float
    {
        return $this->montantAllouer;
    }

    public function setMontantAllouer($montantAllouer): self
    {
        $this->montantAllouer = $montantAllouer;

        return $this;
    }

    public function getDescriptionAllocation(): ?string
    {
        return $this->descriptionAllocation;
    }

    public function setDescriptionAllocation(?string $descriptionAllocation): self
    {
        $this->descriptionAllocation = $descriptionAllocation;

        return $this;
    }

    public function getCreditOuvert(): ?CreditOuvert
    {
        return $this->creditOuvert;
    }

    public function setCreditOuvert(?CreditOuvert $creditOuvert): self
    {
        $this->creditOuvert = $creditOuvert;

        return $this;
    }



    public function getEstValide(): ?bool
    {
        return $this->estValide;
    }

    public function setEstValide(bool $estValide): self
    {
        $this->estValide = $estValide;

        return $this;
    }

    public function getAutorisationMarche(): ?AutorisationMarche
    {
        return $this->autorisationMarche;
    }

    public function setAutorisationMarche(?AutorisationMarche $autorisationMarche): self
    {
        $this->autorisationMarche = $autorisationMarche;

        return $this;
    }

    public function getCompteNature(): ?CompteNature
    {
        return $this->compteNature;
    }

    public function setCompteNature(?CompteNature $compteNature): self
    {
        $this->compteNature = $compteNature;

        return $this;
    }

    public function getActualiseAllocation(): ?self
    {
        return $this->actualiseAllocation;
    }

    public function setActualiseAllocation(?self $actualiseAllocation): self
    {
        $this->actualiseAllocation = $actualiseAllocation;

        return $this;
    }
}
