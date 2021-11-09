<?php

namespace App\Entity\Plans;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Entity\Administration\MairieCommunale;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use App\Entity\Nomenclatures\CompteNature;
use App\Entity\Prevision\AllocationCredit;
use App\Entity\Prevision\BailleurFonds;
use App\Entity\Prevision\CreditOuvert;
use App\Entity\Prevision\ExerciceRegistre;
use App\Entity\Prevision\StatutRegistre;
use App\Repository\Plans\AutorisationMarcheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     shortName= "autorisations",
 *     itemOperations={
 *                  "get"={"openapi_context"={"summary"="Affiche les informations d'une autorisation "}},
 *     "delete"={"openapi_context"={"summary"="Supprime une autorisation"}},
 *     "put"={"openapi_context"={"summary"="Modifie les informations d'une autorisation"}},
 *
 *
 *
 *   },
 * collectionOperations={
 *                      "get"={ "order"={"id"="DESC"},
 *                              "openapi_context"={"summary"="Affiche les informations des autorisations"},
 *     },
 *
 * "autoencours"={ "method"="get", "path"="/autorisations/encours",
 *     "normalization_context"={"groups"={"autoencours:read"}},
 *     "order"={"id"="DESC"},
 *                              "openapi_context"={"summary"="Affiche les informations des autorisations"},
 *     }
 *
 *     ,"inscription"={ "method"="post", "path"="/autorisations/inscription",
 *     "openapi_context"={"summary"="Crée une autorisation"},},
 *
 *     "actualisation"={"method"="post","path"="/autorisations/actualise",
 *     "controller"="App\Controller\Plans\ActualiseAutorisationController"
 *     ,"openapi_context"={"summary"="Actualise une autorisation"},
 *     "denormalization_context"={"groups"={"auactualise:write"}, "disable_type_enforcement"=true},
 *       "validation_groups"={"auactualise"}
 *     }
 *
 * },
 *
 * normalizationContext={
 *                       "groups"={"autorisation_detail:read"}, "openapi_definition_name"= "Read"
 * },
 * denormalizationContext={
 *                        "groups"={"autorisation_detail:write"}, "openapi_definition_name"= "Write",
 *     "disable_type_enforcement"=true
 * },
 *     subresourceOperations={

 *      "association_allocations_get_subresource"={"path"="/autorisations/{id}/allocations",
 *     "openapi_context"={"summary"="liste les allocations d'une autorisation"},
 *    }
 *     }
 * )
 * @ORM\Entity(repositoryClass=AutorisationMarcheRepository::class)
 * @ApiFilter(BooleanFilter::class, properties={"associationRegistre.estOuvert","associationStatut.estEncours","estValide"})
 */
class AutorisationMarche
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"autorisation_detail:read","autorisation_detail:write","auactualise:write",
     *     "autoencours:read","ouveralloc:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"autorisation_detail:read","autorisation_detail:write","auactualise:write",
     *     "autoencours:read","ouveralloc:read"})
     */
    private $objetAutorisation;

    /**
     * @ORM\Column(type="float")
     * @Assert\Type(type="numeric",message="le montant est incorrecte")
     * @Groups({"autorisation_detail:read","autorisation_detail:write","auactualise:write",
     *     "autoencours:read","ouveralloc:read"})
     */
    private $montantAutorisation;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"autorisation_detail:read","autorisation_detail:write","auactualise:write","ouveralloc:read"})
     */
    private $explicationAutorisation;

    /**
     * @ORM\OneToMany(targetEntity=LotMarche::class, mappedBy="autorisationMarche", orphanRemoval=true)
     */
    private $associationLot;

    /**
     * @ORM\OneToMany(targetEntity=ExceptionMarche::class, mappedBy="autorisationMarche", orphanRemoval=true)
     */
    private $associationException;

    /**
     * @ORM\OneToMany(targetEntity=AllocationCredit::class, mappedBy="autorisationMarche")
     * @ApiSubresource()
     */
    private $associationAllocation;

    /**
     * @ORM\ManyToOne(targetEntity=MairieCommunale::class, inversedBy="associationAutorisation")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"autorisation_detail:read","autorisation_detail:write","auactualise:write",
     *     "autoencours:read","ouveralloc:read"})
     */
    private $mairieCommunale;

    /**
     * @ORM\ManyToOne(targetEntity=CompteNature::class, inversedBy="associationAutorisation")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"autorisation_detail:read","autorisation_detail:write","auactualise:write",
     *     "autoencours:read"})
     */
    private $compteNature;

    /**
     * @ORM\ManyToOne(targetEntity=ExerciceRegistre::class, inversedBy="autorisationMarches")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"autorisation_detail:read","autorisation_detail:write","auactualise:write",
     *     "autoencours:read"})
     */
    private $associationRegistre;

    /**
     * @ORM\ManyToOne(targetEntity=StatutRegistre::class, inversedBy="autorisationMarches")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"autorisation_detail:read","autorisation_detail:write","auactualise:write",
     *     "autoencours:read"})
     */
    private $associationStatut;

    /**
     * @ORM\ManyToMany(targetEntity=BailleurFonds::class, inversedBy="autorisationMarches")
     * @Groups({"autorisation_detail:read","autorisation_detail:write","auactualise:write",
     *     "autoencours:read"})
     */
    private $associationBailleur;

    /**
     * @ORM\ManyToOne(targetEntity=CreditOuvert::class, inversedBy="autorisationMarches")
     * @Groups({"autorisation_detail:read","autorisation_detail:write","auactualise:write"})
     */
    private $associationCredit;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Groups({"autorisation_detail:read"})
     */
    private $estValide =true;

    /**
     * @ORM\OneToOne(targetEntity=AutorisationMarche::class, cascade={"persist", "remove"})
     * @Groups({"autorisation_detail:read","auactualise:write"})
     */
    private $actualisationAutorisation;



    public function __construct()
    {
        $this->associationLot = new ArrayCollection();
        $this->associationException = new ArrayCollection();
        $this->associationAllocation = new ArrayCollection();
        $this->associationBailleur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjetAutorisation(): ?string
    {
        return $this->objetAutorisation;
    }

    public function setObjetAutorisation(string $objetAutorisation): self
    {
        $this->objetAutorisation = $objetAutorisation;

        return $this;
    }

    public function getMontantAutorisation(): ?float
    {
        return $this->montantAutorisation;
    }

    public function setMontantAutorisation($montantAutorisation): self
    {
        $this->montantAutorisation = $montantAutorisation;

        return $this;
    }

    public function getExplicationAutorisation(): ?string
    {
        return $this->explicationAutorisation;
    }

    public function setExplicationAutorisation(?string $explicationAutorisation): self
    {
        $this->explicationAutorisation = $explicationAutorisation;

        return $this;
    }

    /**
     * @return Collection|LotMarche[]
     */
    public function getAssociationLot(): Collection
    {
        return $this->associationLot;
    }

    public function addAssociationLot(LotMarche $associationLot): self
    {
        if (!$this->associationLot->contains($associationLot)) {
            $this->associationLot[] = $associationLot;
            $associationLot->setAutorisationMarche($this);
        }

        return $this;
    }

    public function removeAssociationLot(LotMarche $associationLot): self
    {
        if ($this->associationLot->removeElement($associationLot)) {
            // set the owning side to null (unless already changed)
            if ($associationLot->getAutorisationMarche() === $this) {
                $associationLot->setAutorisationMarche(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ExceptionMarche[]
     */
    public function getAssociationException(): Collection
    {
        return $this->associationException;
    }

    public function addAssociationException(ExceptionMarche $associationException): self
    {
        if (!$this->associationException->contains($associationException)) {
            $this->associationException[] = $associationException;
            $associationException->setAutorisationMarche($this);
        }

        return $this;
    }

    public function removeAssociationException(ExceptionMarche $associationException): self
    {
        if ($this->associationException->removeElement($associationException)) {
            // set the owning side to null (unless already changed)
            if ($associationException->getAutorisationMarche() === $this) {
                $associationException->setAutorisationMarche(null);
            }
        }

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
            $associationAllocation->setAutorisationMarche($this);
        }

        return $this;
    }

    public function removeAssociationAllocation(AllocationCredit $associationAllocation): self
    {
        if ($this->associationAllocation->removeElement($associationAllocation)) {
            // set the owning side to null (unless already changed)
            if ($associationAllocation->getAutorisationMarche() === $this) {
                $associationAllocation->setAutorisationMarche(null);
            }
        }

        return $this;
    }

    public function getMairieCommunale(): ?MairieCommunale
    {
        return $this->mairieCommunale;
    }

    public function setMairieCommunale(?MairieCommunale $mairieCommunale): self
    {
        $this->mairieCommunale = $mairieCommunale;

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

    public function getAssociationRegistre(): ?ExerciceRegistre
    {
        return $this->associationRegistre;
    }

    public function setAssociationRegistre(?ExerciceRegistre $associationRegistre): self
    {
        $this->associationRegistre = $associationRegistre;

        return $this;
    }

    public function getAssociationStatut(): ?StatutRegistre
    {
        return $this->associationStatut;
    }

    public function setAssociationStatut(?StatutRegistre $associationStatut): self
    {
        $this->associationStatut = $associationStatut;

        return $this;
    }

    /**
     * @return Collection|BailleurFonds[]
     */
    public function getAssociationBailleur(): Collection
    {
        return $this->associationBailleur;
    }

    public function addAssociationBailleur(BailleurFonds $associationBailleur): self
    {
        if (!$this->associationBailleur->contains($associationBailleur)) {
            $this->associationBailleur[] = $associationBailleur;
        }

        return $this;
    }

    public function removeAssociationBailleur(BailleurFonds $associationBailleur): self
    {
        $this->associationBailleur->removeElement($associationBailleur);

        return $this;
    }

    public function getAssociationCredit(): ?CreditOuvert
    {
        return $this->associationCredit;
    }

    public function setAssociationCredit(?CreditOuvert $associationCredit): self
    {
        $this->associationCredit = $associationCredit;

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

    public function getActualisationAutorisation(): ?self
    {
        return $this->actualisationAutorisation;
    }

    public function setActualisationAutorisation(?self $actualisationAutorisation): self
    {
        $this->actualisationAutorisation = $actualisationAutorisation;

        return $this;
    }


}
