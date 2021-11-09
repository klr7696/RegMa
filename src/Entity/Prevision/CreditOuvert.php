<?php

namespace App\Entity\Prevision;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Nomenclatures\CompteNature;
use App\Entity\Plans\AutorisationMarche;
use App\Repository\Prevision\CreditOuvertRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     shortName= "ouverts",
 *      itemOperations={
 *                  "get"={"openapi_context"={"summary"="Affiche les informations d'un Credit Ouvert "}},
 *     "delete"={"openapi_context"={"summary"="Supprime un Credit Ouvert"}},
 *     "put"={"openapi_context"={"summary"="Modifie les informations un Credit Ouvert"}},
 *
 *
 *
 *   },
 * collectionOperations={
 *                      "get"={ "order"={"id"="DESC"},
 *                              "openapi_context"={"summary"="Affiche les informations des registres"}}
 *                               ,"inscription"={ "method"="post", "path"="/ouverts/inscription",
 *     "openapi_context"={"summary"="Crée un Credit Ouvert"},},
 *
 *     "actualisation"={"method"="post","path"="/ouverts/actualise",
 *     "controller"="App\Controller\Previsions\ActualiseOuvertController",
 *     "openapi_context"={"summary"="Actualise un Credit Ouvert"},
 *     "denormalization_context"={"groups"={"oactualise:write"}},
 *       "validation_groups"={"oactualise"}
 *     }
 *
 * },
 *
 * normalizationContext={
 *                       "groups"={"ouvert_detail:read"}, "openapi_definition_name"= "Read"
 * },
 * denormalizationContext={
 *                        "groups"={"ouvert_detail:write"}, "openapi_definition_name"= "Write",
 *     "disable_type_enforcement"=true
 * },
 *     subresourceOperations={
 *     "api_ressources_association_credits_get_subresource"={
 *     "normalization_context"={"groups"={"ressouvre:read"}}
 *     },
 *     "association_allocations_get_subresource"={"path"="/ouverts/{id}/allocations",
 *     "openapi_context"={"summary"="Liste les allocations d'un credit ouvert sur un registre"}
 *     },
 *
 *     }
 * )
 * @ORM\Entity(repositoryClass=CreditOuvertRepository::class)
 */
class CreditOuvert
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"ouvert_detail:read","ressouvre:read","autoalloc:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Groups({"ouvert_detail:read","ouvert_detail:write","oactualise:write",
     *     "bailleurs_detail:read","ressouvre:read","autoalloc:read"})
     * @Assert\Type(type="numeric",message="le montant est incorrect")
     */
    private $montantInscription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"ouvert_detail:read","ouvert_detail:write",
     *     "oactualise:write","ressouvre:read"})
     */
    private $descriptionInscription;

    /**
     * @ORM\ManyToOne(targetEntity=RessourceFinanciere::class, inversedBy="associationCredit")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"ouvert_detail:read","ouvert_detail:write","oactualise:write","autoalloc:read"})
     *
     */
    private $ressourceFinanciere;

    /**
     * @ORM\OneToMany(targetEntity=AllocationCredit::class, mappedBy="creditOuvert", orphanRemoval=true)
     * @Groups({"ouvert_detail:read"})
     * @ApiSubresource()
     */
    private $associationAllocation;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Groups({"ouvert_detail:read","ressouvre:read"})
     */
    private $estValide =true;

    /**
     * @ORM\ManyToOne(targetEntity=CompteNature::class, inversedBy="associationCreditOuvert")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"ouvert_detail:read","ouvert_detail:write","oactualise:write","ressouvre:read"})
     */
    private $compteNature;

    /**
     * @ORM\OneToOne(targetEntity=CreditOuvert::class, cascade={"persist", "remove"})
     * @Groups({"ouvert_detail:read","oactualise:write","ressouvre:read"})
     */
    private $actualiseCredit;

    /**
     * @ORM\OneToMany(targetEntity=AutorisationMarche::class, mappedBy="associationCredit")
     */
    private $autorisationMarches;

    public function __construct()
    {
        $this->associationAllocation = new ArrayCollection();
        $this->autorisationMarches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantInscription(): ?float
    {
        return $this->montantInscription;
    }

    public function setMontantInscription($montantInscription): self
    {
        $this->montantInscription = $montantInscription;

        return $this;
    }

    public function getDescriptionInscription(): ?string
    {
        return $this->descriptionInscription;
    }

    public function setDescriptionInscription(?string $descriptionInscription): self
    {
        $this->descriptionInscription = $descriptionInscription;

        return $this;
    }

    public function getRessourceFinanciere(): ?RessourceFinanciere
    {
        return $this->ressourceFinanciere;
    }

    public function setRessourceFinanciere(?RessourceFinanciere $ressourceFinanciere): self
    {
        $this->ressourceFinanciere = $ressourceFinanciere;

        return $this;
    }

    /**
     * @return Collection|AllocationCredit[]
     */
    public function getAssociationAllocation(): Collection
    {
        return $this->associationAllocation;
    }

    public function addAssociationAllocation(AllocationCredit $associationAllocation): self
    {
        if (!$this->associationAllocation->contains($associationAllocation)) {
            $this->associationAllocation[] = $associationAllocation;
            $associationAllocation->setCreditOuvert($this);
        }

        return $this;
    }

    public function removeAssociationAllocation(AllocationCredit $associationAllocation): self
    {
        if ($this->associationAllocation->removeElement($associationAllocation)) {
            // set the owning side to null (unless already changed)
            if ($associationAllocation->getCreditOuvert() === $this) {
                $associationAllocation->setCreditOuvert(null);
            }
        }

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

    public function getCompteNature(): ?CompteNature
    {
        return $this->compteNature;
    }

    public function setCompteNature(?CompteNature $compteNature): self
    {
        $this->compteNature = $compteNature;

        return $this;
    }

    public function getActualiseCredit(): ?self
    {
        return $this->actualiseCredit;
    }

    public function setActualiseCredit(?self $actualiseCredit): self
    {
        $this->actualiseCredit = $actualiseCredit;

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
            $autorisationMarch->setAssociationCredit($this);
        }

        return $this;
    }

    public function removeAutorisationMarch(AutorisationMarche $autorisationMarch): self
    {
        if ($this->autorisationMarches->removeElement($autorisationMarch)) {
            // set the owning side to null (unless already changed)
            if ($autorisationMarch->getAssociationCredit() === $this) {
                $autorisationMarch->setAssociationCredit(null);
            }
        }

        return $this;
    }
}
