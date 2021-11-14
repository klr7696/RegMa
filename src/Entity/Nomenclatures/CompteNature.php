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
use phpDocumentor\Reflection\Types\This;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CompteNatureRepository::class)
 * @ApiResource(
 *
 * itemOperations={
 *                    "get"={"openapi_context"={"summary"="Affiche les informations d'un compte nature"}}
 * ,
 *     "delete"={"openapi_context"={"summary"="Supprime les informations d'un compte nature"}},
 *     "put"={ "openapi_context"={"summary"="Modifie les informations d'un compte nature"}}
 *
 *     , "patch"={
 *     "input_formats"={"json"={"application/vnd.api+json",
 *     "application/merge-patch+json","application/json","application/ld+json"},
 *

 *     },
 *    "openapi_context"={"summary"="Abroge une nomenclature existante"},
 *
 *                      }
 *
 *
 * },
 *
 * collectionOperations={
 *     "get" ={"openapi_context"={"summary"="Affiche les informations des comptes natures"}},
 *
 *     "chapitres"={ "method"="post",    "path"="/natures/chapitres",
 *                  "denormalization_context"={"groups"={"chapitre:write"},"disable_type_enforcement"=true},
 *                  "openapi_context"={"summary"="Crée un Chapitre de type compte nature"}
 *            },
 *     "sousnatures"={ "method"="post",    "path"="/natures/sousnatures",
 *                  "denormalization_context"={"groups"={"sousnatures:write"},"disable_type_enforcement"=true},
 *                  "openapi_context"={"summary"="Crée un Article ou un paragraphe de type compte nature"}
 *             },
 * },
 * shortName= "natures",
 *
 * normalizationContext={"groups"={"nature_detail:read","nomen_detail:read"}, "openapi_definition_name"= "Read"},
 *
 * denormalizationContext={"groups"={"nature_detail:write"}, "openapi_definition_name"= "Write",
 *     "disable_type_enforcement"=true},
 *
 * subresourceOperations={
 *             "api_nomenclatures_assiociation_compte_natures_get_subresource"=
 *               {
 *                    "normalization_context"={"groups"={"nomen_nature:read"}},
 *                }
 *
 *     },
 *     subresourceOperations={
 *     "sous_compte_natures_get_subresource"={

 *                          "path"="/natures/{id}/sousnatures",
 *                          "openapi_context"={"summary"="liste les sous comptes d'un compte nature"}
 *     },
 *     "api_natures_sous_compte_natures_get_subresource"={
 *     "normalization_context"={"groups"={"sousnatures:read"}}
 * },

 *  }
 *
 * )
 * @ApiFilter(SearchFilter::class, properties={"numeroCompteNature"="exact","sectionCompteNature"="exact","hierachieCompteNature"="exact",
 * "sousCompteNature.creditAffect","sousCompteNature.autoAffect","creditAffect","autoAffect"} )
 * @UniqueEntity({"numeroCompteNature","libelleCompteNature"},message="le compte en creation comporte des erreurs")
 *
 */
class CompteNature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"nature_detail:read","actifnomen:read","ressouvre:read","sousnatures:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer", length=4)
     * @Groups({"nature_detail:read","nature_detail:write"
     * ,"nomen_nature:read","sousnatures:read",
     * "chapitre:write","sousnatures:write","actifnomen:read",
     *     "ressouvre:read"})
     * @Assert\NotBlank(message=" veuillez entrer le numero du compte ")
     * @Assert\Type(type="numeric", message="le numero de compte nature est incorrect")
     */
    private $numeroCompteNature;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"nature_detail:read","nature_detail:write",
     *     "nomen_nature:read","sousnatures:read",
     * "chapitre:write","sousnatures:write","actifnomen:read","ressouvre:read"})
     * @Assert\NotBlank(message=" veuillez entrer le libelle")
     */
    private $libelleCompteNature;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Assert\Choice(choices= {"","Fonctionnement", "Investissement"})
     * @Groups({"nature_detail:read","nature_detail:write"
     * ,"nomen_nature:read","chapitre:write","actifnomen:read","ressouvre:read"
     *    })
     */
    private $sectionCompteNature;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Choice(choices={"Chapitre","Article","Paragraphe"})
     * @Groups({"nature_detail:read","nature_detail:write"
     * ,"nomen_nature:read","sousnatures:read",
     * "chapitre:write","sousnatures:write",
     *     "sousnatures:read","actifnomen:read","ressouvre:read"})
     *
     */
    private $hierachieCompteNature;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"nature_detail:read","nature_detail:write",
     * "chapitre:write","sousnatures:read","sousnatures:write"})
     */
    private $descriptionCompteNature;


    /**
     * @ORM\ManyToOne(targetEntity=Nomenclature::class, inversedBy="assiociationCompteNature")
     *
     * @Groups({"nature_detail:write","chapitre:write"})
     */
    private $nomenclature;

    /**
     * @ORM\ManyToOne(targetEntity=CompteNature::class, inversedBy="sousCompteNature")
     * @Groups({"nature_detail:read","nature_detail:write",
     * "sousnatures:write"})
     */
    private $compteNature;

    /**
     * @ORM\OneToMany(targetEntity=CompteNature::class, mappedBy="compteNature")
     * @Groups({"nature_detail:read","nature_detail:write","nomen_nature:read","actifnomen:read","actifnomen:read"})
     *
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

    /**
     * @ORM\Column(type="boolean")
     */
    private $creditAffect = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $autoAffect = false;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $actuelCompte =false;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $actuelAuto = false;



    public function __construct()
    {
        $this->sousCompteNature = new ArrayCollection();
        $this->associationCreditOuvert = new ArrayCollection();
        $this->associationAutorisation = new ArrayCollection();
        $this->associationEngagement = new ArrayCollection();
        $this->associationMandat = new ArrayCollection();
        $this->associationImputation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCompteNature(): ?string
    {
        return $this->numeroCompteNature;
    }

    public function setNumeroCompteNature(string $numeroCompteNature): self
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

    public function getCreditAffect(): ?bool
    {
        return $this->creditAffect;
    }

    public function setCreditAffect(bool $creditAffect): self
    {
        $this->creditAffect = $creditAffect;

        return $this;
    }

    public function getAutoAffect(): ?bool
    {
        return $this->autoAffect;
    }

    public function setAutoAffect(bool $autoAffect): self
    {
        $this->autoAffect = $autoAffect;

        return $this;
    }



    /**
     * @return int
     */
    public function compteValeurChap($nat): int
        {
        return array_reduce($nat->toArray(), function ($test, $sousnature)
            {
                return $test + ($sousnature->getCreditAffect() === true ? 1 : 0);

            },0);
        }


    /**
     * @return int
     */
    public function compteValeurAct($nat): int
    {
        return array_reduce($nat->toArray(), function ($test, $sousnature)
        {
            return $test + ($sousnature->getActuelCompte() === true ? 1 : 0);

        },0);
    }

    public function retourBoulChap(int $tout,int $art)
    {
        if ($tout === $art || $tout === 0){
            return true;
        } else return false;

    }


        public function chapitreTrue()
            {
                $tout= $this->sousCompteNature->count();
                $nat=$this->sousCompteNature;
                $art=$this->compteValeurChap($nat);
                $act =$this->compteValeurAct($nat);
                $affect= $this->retourBoulChap($tout,$art);
                if($affect === true)
                {
                  $this->setCreditAffect(true);
                }
                if ($art >= 1 || $tout === 0 || $act >= 1){
                    $this->setActuelCompte(true);
                }

            }
        public function articleTrue()
            {
                $nat=$this->getCompteNature()->getSousCompteNature();
                $tout= $this->getCompteNature()->getSousCompteNature()->count();
                $art=$this->compteValeurChap($nat);
                $act =$this->compteValeurAct($nat);
                $affect= $this->retourBoulChap($tout,$art);
                if($affect === true)
                {
                    $this->getCompteNature()->setCreditAffect(true);
                }
                if ($art >= 1 || $tout === 0 || $act >= 1){
                    $this->getCompteNature()->setActuelCompte(true);
                }
            }


                /**
                 * @return int
                 */
                public function compteValeurAut($nat): int
                {
                    return array_reduce($nat->toArray(), function ($test, $sousnature)
                    {
                        return $test + ($sousnature->getAutoAffect() === true ? 1 : 0);

                    },0);
                }


        /**
        * @return int
        */
    public function valeurAutoAct($nat): int
    {
        return array_reduce($nat->toArray(), function ($test, $sousnature)
        {
            return $test + ($sousnature->getActuelAuto() === true ? 1 : 0);

        },0);
    }


                public function chapitreAuto()
                {
                    $tout= $this->sousCompteNature->count();
                    $nat=$this->sousCompteNature;
                    $art=$this->compteValeurAut($nat);
                    $act=$this->valeurAutoAct($nat);
                    $affect= $this->retourBoulChap($tout,$art);
                    if($affect === true)
                    {
                        $this->setAutoAffect(true);
                    }
                    if ($art >= 1 || $tout === 0 || $act >= 1){
                        $this->setActuelAuto(true);
                    }

                }
                public function articleAuto()
                {
                    $nat=$this->getCompteNature()->getSousCompteNature();
                    $tout= $this->getCompteNature()->getSousCompteNature()->count();
                    $art=$this->compteValeurAut($nat);
                    $act=$this->valeurAutoAct($nat);
                    $affect= $this->retourBoulChap($tout,$art);
                    if($affect === true)
                    {
                        $this->getCompteNature()->setAutoAffect(true);
                    }
                    if ($art >= 1 || $tout === 0 || $act >= 1){
                        $this->getCompteNature()->setActuelAuto(true);
                    }
                }

                public function getActuelCompte(): ?bool
                {
                    return $this->actuelCompte;
                }

                public function setActuelCompte(?bool $actuelCompte): self
                {
                    $this->actuelCompte = $actuelCompte;

                    return $this;
                }

                public function getActuelAuto(): ?bool
                {
                    return $this->actuelAuto;
                }

                public function setActuelAuto(?bool $actuelAuto): self
                {
                    $this->actuelAuto = $actuelAuto;

                    return $this;
                }


 }
