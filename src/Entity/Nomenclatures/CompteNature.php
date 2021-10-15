<?php

namespace App\Entity\Nomenclatures;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Entity\Operations\Engagement;
use App\Entity\Operations\Imputation;
use App\Entity\Operations\Mandatement;
use App\Entity\Plans\AutorisationMarche;
use App\Entity\Prevision\AllocationCredit;
use App\Entity\Prevision\CreditOuvert;
use App\Repository\Nomenclatures\CompteNatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CompteNatureRepository::class)
 * @ApiResource(
 *     itemOperations={
 *     "get"={"openapi_context"={"summary"="Affiche les informations d'un compte nature"}}
 * ,"patch"={"openapi_context"={"summary"="Actualise les informations d'un compte nature"}}
 *   },
 *     collectionOperations={
 *     "get" ={"openapi_context"={"summary"="Affiche les informations des comptes natures"}}
 *     ,"post"={"openapi_context"={"summary"="Crée un compte nature"}}
 * },
 *     shortName= "natures",
 *     normalizationContext={"groups"={"nature_detail:read","nomen_detail:read"}, "swager_definition_name"= "Read"},
 *     denormalizationContext={"groups"={"nature_detail:write"}, "swager_definition_name"= "Write"},
 *     subresourceOperations={
 *             "api_nomenclatures_assiociation_compte_natures_get_subresource"= {
 *              "normalization_context"={"groups"={"nomen_nature:read"}},
 *
 *
 *      }
 *
 *     },
 *     subresourceOperations={
 *     "sous_compte_natures_get_subresource"={

 *                          "path"="/natures/{id}/sousnatures",
 *                          "openapi_context"={"summary"="liste les sous comptes d'un compte nature"}
 *     },
 *     "api_natures_sous_compte_natures_get_subresource"={
 *     "normalization_context"={"groups"={"sousnature:read"}}
 * },

 *     }
 *
 * )
 * @ApiFilter(SearchFilter::class, properties={"numeroCompteNature":"exact","sectionCompteNature":"exact","hierachieCompteNature":"exact"} )
 * @UniqueEntity("numeroCompteNature")
 * @UniqueEntity("libelleCompteNature")
 */
class CompteNature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"nature_detail:read","nature_detail:write","nomen_nature:read","sousnature:read"})
     */
    private $numeroCompteNature;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"nature_detail:read","nature_detail:write","nomen_nature:read","sousnature:read"})
     */
    private $libelleCompteNature;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Assert\Choice(choices= {"FONCTIONNEMENT", "INVESTISSEMENT"})
     * @Groups({"nature_detail:read","nature_detail:write","nomen_nature:read"})
     */
    private $sectionCompteNature;

    /**
     * @ORM\Column(type="string", length=30)
     * @Groups({"nature_detail:read","nature_detail:write","nomen_nature:read","sousnature:read"})
     * @Assert\Choice(choices={"CHAPITRE","ARTICLE","PARAGRAPHE"})
     */
    private $hierachieCompteNature;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"nature_detail:read","nature_detail:write"})
     */
    private $descriptionCompteNature;


    /**
     * @ORM\ManyToOne(targetEntity=Nomenclature::class, inversedBy="assiociationCompteNature")
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $nomenclature;

    /**
     * @ORM\ManyToOne(targetEntity=CompteNature::class, inversedBy="sousCompteNature")
     * @Groups({"nature_detail:read","nature_detail:write"})
     */
    private $compteNature;

    /**
     * @ORM\OneToMany(targetEntity=CompteNature::class, mappedBy="compteNature")
     * @Groups({"nature_detail:read","nature_detail:write","nomen_nature:read"})
     * @ApiSubresource()
     */
    private $sousCompteNature;

    /**
     * @ORM\OneToMany(targetEntity=CreditOuvert::class, mappedBy="compteNature", orphanRemoval=true)
     */
    private $associationCreditOuvert;

    /**
     * @ORM\OneToMany(targetEntity=AutorisationMarche::class, mappedBy="compteNature", orphanRemoval=true)
     */
    private $associationAutorisation;

    /**
     * @ORM\OneToMany(targetEntity=AllocationCredit::class, mappedBy="compteNature", orphanRemoval=true)
     */
    private $associationAllocation;

    /**
     * @ORM\OneToMany(targetEntity=Engagement::class, mappedBy="compteNature", orphanRemoval=true)
     */
    private $associationEngagement;

    /**
     * @ORM\OneToMany(targetEntity=Mandatement::class, mappedBy="compteNature", orphanRemoval=true)
     */
    private $associationMandat;

    /**
     * @ORM\OneToMany(targetEntity=Imputation::class, mappedBy="compteNature", orphanRemoval=true)
     */
    private $associationImputation;

    public function __construct()
    {
        $this->sousCompteNature = new ArrayCollection();
        $this->associationCreditOuvert = new ArrayCollection();
        $this->associationAutorisation = new ArrayCollection();
        $this->associationAllocation = new ArrayCollection();
        $this->associationEngagement = new ArrayCollection();
        $this->associationMandat = new ArrayCollection();
        $this->associationImputation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCompteNature(): ?int
    {
        return $this->numeroCompteNature;
    }

    public function setNumeroCompteNature(int $numeroCompteNature): self
    {
        $this->numeroCompteNature = $numeroCompteNature;

        return $this;
    }

    public function getLibelleCompteNature(): ?string
    {
        return $this->libelleCompteNature;
    }

    public function setLibelleCompteNature(string $libelleCompteNature): self
    {
        $this->libelleCompteNature = $libelleCompteNature;

        return $this;
    }

    public function getSectionCompteNature(): ?string
    {
        return $this->sectionCompteNature;
    }

    public function setSectionCompteNature(string $sectionCompteNature): self
    {
        $this->sectionCompteNature = $sectionCompteNature;

        return $this;
    }

    public function getHierachieCompteNature(): ?string
    {
        return $this->hierachieCompteNature;
    }

    public function setHierachieCompteNature(string $hierachieCompteNature): self
    {
        $this->hierachieCompteNature = $hierachieCompteNature;

        return $this;
    }

    public function getDescriptionCompteNature(): ?string
    {
        return $this->descriptionCompteNature;
    }

    public function setDescriptionCompteNature(?string $descriptionCompteNature): self
    {
        $this->descriptionCompteNature = $descriptionCompteNature;

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

    public function getCompteNature(): ?self
    {
        return $this->compteNature;
    }

    public function setCompteNature(?self $compteNature): self
    {
        $this->compteNature = $compteNature;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSousCompteNature(): Collection
    {
        return $this->sousCompteNature;
    }

    public function addSousCompteNature(self $sousCompteNature): self
    {
        if (!$this->sousCompteNature->contains($sousCompteNature)) {
            $this->sousCompteNature[] = $sousCompteNature;
            $sousCompteNature->setCompteNature($this);
        }

        return $this;
    }

    public function removeSousCompteNature(self $sousCompteNature): self
    {
        if ($this->sousCompteNature->removeElement($sousCompteNature)) {
            // set the owning side to null (unless already changed)
            if ($sousCompteNature->getCompteNature() === $this) {
                $sousCompteNature->setCompteNature(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CreditOuvert[]
     */
    public function getAssociationCreditOuvert(): Collection
    {
        return $this->associationCreditOuvert;
    }

    public function addAssociationCreditOuvert(CreditOuvert $associationCreditOuvert): self
    {
        if (!$this->associationCreditOuvert->contains($associationCreditOuvert)) {
            $this->associationCreditOuvert[] = $associationCreditOuvert;
            $associationCreditOuvert->setCompteNature($this);
        }

        return $this;
    }

    public function removeAssociationCreditOuvert(CreditOuvert $associationCreditOuvert): self
    {
        if ($this->associationCreditOuvert->removeElement($associationCreditOuvert)) {
            // set the owning side to null (unless already changed)
            if ($associationCreditOuvert->getCompteNature() === $this) {
                $associationCreditOuvert->setCompteNature(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AutorisationMarche[]
     */
    public function getAssociationAutorisation(): Collection
    {
        return $this->associationAutorisation;
    }

    public function addAssociationAutorisation(AutorisationMarche $associationAutorisation): self
    {
        if (!$this->associationAutorisation->contains($associationAutorisation)) {
            $this->associationAutorisation[] = $associationAutorisation;
            $associationAutorisation->setCompteNature($this);
        }

        return $this;
    }

    public function removeAssociationAutorisation(AutorisationMarche $associationAutorisation): self
    {
        if ($this->associationAutorisation->removeElement($associationAutorisation)) {
            // set the owning side to null (unless already changed)
            if ($associationAutorisation->getCompteNature() === $this) {
                $associationAutorisation->setCompteNature(null);
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
            $associationAllocation->setCompteNature($this);
        }

        return $this;
    }

    public function removeAssociationAllocation(AllocationCredit $associationAllocation): self
    {
        if ($this->associationAllocation->removeElement($associationAllocation)) {
            // set the owning side to null (unless already changed)
            if ($associationAllocation->getCompteNature() === $this) {
                $associationAllocation->setCompteNature(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Engagement[]
     */
    public function getAssociationEngagement(): Collection
    {
        return $this->associationEngagement;
    }

    public function addAssociationEngagement(Engagement $associationEngagement): self
    {
        if (!$this->associationEngagement->contains($associationEngagement)) {
            $this->associationEngagement[] = $associationEngagement;
            $associationEngagement->setCompteNature($this);
        }

        return $this;
    }

    public function removeAssociationEngagement(Engagement $associationEngagement): self
    {
        if ($this->associationEngagement->removeElement($associationEngagement)) {
            // set the owning side to null (unless already changed)
            if ($associationEngagement->getCompteNature() === $this) {
                $associationEngagement->setCompteNature(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Mandatement[]
     */
    public function getAssociationMandat(): Collection
    {
        return $this->associationMandat;
    }

    public function addAssociationMandat(Mandatement $associationMandat): self
    {
        if (!$this->associationMandat->contains($associationMandat)) {
            $this->associationMandat[] = $associationMandat;
            $associationMandat->setCompteNature($this);
        }

        return $this;
    }

    public function removeAssociationMandat(Mandatement $associationMandat): self
    {
        if ($this->associationMandat->removeElement($associationMandat)) {
            // set the owning side to null (unless already changed)
            if ($associationMandat->getCompteNature() === $this) {
                $associationMandat->setCompteNature(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Imputation[]
     */
    public function getAssociationImputation(): Collection
    {
        return $this->associationImputation;
    }

    public function addAssociationImputation(Imputation $associationImputation): self
    {
        if (!$this->associationImputation->contains($associationImputation)) {
            $this->associationImputation[] = $associationImputation;
            $associationImputation->setCompteNature($this);
        }

        return $this;
    }

    public function removeAssociationImputation(Imputation $associationImputation): self
    {
        if ($this->associationImputation->removeElement($associationImputation)) {
            // set the owning side to null (unless already changed)
            if ($associationImputation->getCompteNature() === $this) {
                $associationImputation->setCompteNature(null);
            }
        }

        return $this;
    }


}
