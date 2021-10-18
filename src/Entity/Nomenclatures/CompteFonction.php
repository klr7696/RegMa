<?php

namespace App\Entity\Nomenclatures;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Operations\Engagement;
use App\Entity\Operations\Mandatement;
use App\Repository\Nomenclatures\CompteFonctionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CompteFonctionRepository::class)
 * @ApiResource(
 *     itemOperations={
 *     "get"={"openapi_context"={"summary"="Affiche les informations d'un compte fonction"}}
 * ,"patch"={"openapi_context"={"summary"="Actualise les informations d'un compte fonction"}},
 *     "delete"={"openapi_context"={"summary"="Supprime les informations d'un compte fonction"}},
 *     "put"={"openapi_context"={"summary"="Modifie les informations d'un compte fonction"}}
 *   },
 *
 *     collectionOperations={
 *     "get" ={"openapi_context"={"summary"="Affiche les informations des comptes fonctions"}},

 *     "divisions"={ "method"="post",    "path"="/fonctions/divisions",
 *                  "denormalization_context"={"groups"={"divisions:write"}},
 *                  "openapi_context"={"summary"="Crée une Division de type compte fonction"}
 *            },
 *     "sousfonctions"={ "method"="post",    "path"="/fonctions/sousfonctions",
 *                  "denormalization_context"={"groups"={"sousfonctions:write"}},
 *                  "openapi_context"={"summary"="Crée un Groupe ou une Classse de type compte fonction"}
 *             },
 * },
 *     shortName= "fonctions",
 *     normalizationContext={"groups"={"fonction_detail:read","nomen_detail:read"}, "openapi_definition_name"= "Read"},
 *     denormalizationContext={"groups"={"fonction_detail:write"}, "openapi_definition_name"= "Write"},
 *     subresourceOperations={
 *             "api_nomenclatures_assiociation_compte_fonctions_get_subresource"= {
 *              "normalization_context"={"groups"={"nomen_fonction:read"}},
 *
 *
 *
 *      }
 *
 *     },
 *subresourceOperations={
 *           "sous_compte_fonctions_get_subresource"={

 *                          "path"="/fonctions/{id}/sousfonctions",
 *                          "openapi_context"={"summary"="liste les sous comptes d'un compte fonction "}
 *     },
 *     "api_fonctions_sous_compte_fonctions_get_subresource"={
 *     "normalization_context"={"groups"={"sousfonctions:read"}}
 * },
 *     }
 *
 * )
 * @ApiFilter(SearchFilter::class, properties={"numeroCompteFonction":"exact","hierachieCompteFonction":"exact"} )
 * @UniqueEntity("numeroCompteFonction")
 * @UniqueEntity("libelleCompteFonction")
 */
class CompteFonction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"fonction_detail:read","fonction_detail:write",
     *     "nomen_fonction:read","sousfonctions:read",
     *     "divisions:write","sousfonctions:write"})
     */
    private $numeroCompteFonction;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"fonction_detail:read","fonction_detail:write",
     *     "nomen_fonction:read","sousfonctions:read",
     *     "divisions:write","sousfonctions:write"})
     */
    private $libelleCompteFonction;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Choice(choices= {"Division", "Groupe", "Classe"})
     * @Groups({"fonction_detail:read","fonction_detail:write",
     *     "nomen_fonction:read","sousfonctions:read",
     *    "divisions:write","sousfonctions:write" })
     *
     */
    private $hierachieCompteFonction;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"fonction_detail:read","fonction_detail:write",
     *     "nomen_fonction:read","sousfonctions:read",
     *     "divisions:write","sousfonctions:write"})
     */
    private $descriptionCompteFonction;


    /**
     * @ORM\ManyToOne(targetEntity=Nomenclature::class, inversedBy="associationCompteFonction")
     * @Groups({"fonction_detail:write",
     *     "nomen_fonction:read","divisions:write"})
     */
    private $nomenclature;

    /**
     * @ORM\ManyToOne(targetEntity=CompteFonction::class, inversedBy="sousCompteFonction")
     * @Groups({"fonction_detail:read","fonction_detail:write",
     *     "nomen_fonction:read","sousfonctions:write"})
     */
    private $compteFonction;

    /**
     * @ORM\OneToMany(targetEntity=CompteFonction::class, mappedBy="compteFonction")
     *@Groups({"fonction_detail:read","nomen_fonction:read","fonction_detail:write"})
     * @ApiSubresource()
     */
    private $sousCompteFonction;

    /**
     * @ORM\OneToMany(targetEntity=Engagement::class, mappedBy="compteFonction")
     */
    private $associationEngagement;

    /**
     * @ORM\OneToMany(targetEntity=Mandatement::class, mappedBy="compteFonction")
     */
    private $associationMandat;

    public function __construct()
    {
        $this->sousCompteFonction = new ArrayCollection();
        $this->associationEngagement = new ArrayCollection();
        $this->associationMandat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCompteFonction(): ?int
    {
        return $this->numeroCompteFonction;
    }

    public function setNumeroCompteFonction(int $numeroCompteFonction): self
    {
        $this->numeroCompteFonction = $numeroCompteFonction;

        return $this;
    }

    public function getLibelleCompteFonction(): ?string
    {
        return $this->libelleCompteFonction;
    }

    public function setLibelleCompteFonction(string $libelleCompteFonction): self
    {
        $this->libelleCompteFonction = $libelleCompteFonction;

        return $this;
    }

    public function getHierachieCompteFonction(): ?string
    {
        return $this->hierachieCompteFonction;
    }

    public function setHierachieCompteFonction(string $hierachieCompteFonction): self
    {
        $this->hierachieCompteFonction = $hierachieCompteFonction;

        return $this;
    }

    public function getDescriptionCompteFonction(): ?string
    {
        return $this->descriptionCompteFonction;
    }

    public function setDescriptionCompteFonction(?string $descriptionCompteFonction): self
    {
        $this->descriptionCompteFonction = $descriptionCompteFonction;

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

    public function getCompteFonction(): ?self
    {
        return $this->compteFonction;
    }

    public function setCompteFonction(?self $compteFonction): self
    {
        $this->compteFonction = $compteFonction;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSousCompteFonction(): Collection
    {
        return $this->sousCompteFonction;
    }

    public function addSousCompteFonction(self $sousCompteFonction): self
    {
        if (!$this->sousCompteFonction->contains($sousCompteFonction)) {
            $this->sousCompteFonction[] = $sousCompteFonction;
            $sousCompteFonction->setCompteFonction($this);
        }

        return $this;
    }

    public function removeSousCompteFonction(self $sousCompteFonction): self
    {
        if ($this->sousCompteFonction->removeElement($sousCompteFonction)) {
            // set the owning side to null (unless already changed)
            if ($sousCompteFonction->getCompteFonction() === $this) {
                $sousCompteFonction->setCompteFonction(null);
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
            $associationEngagement->setCompteFonction($this);
        }

        return $this;
    }

    public function removeAssociationEngagement(Engagement $associationEngagement): self
    {
        if ($this->associationEngagement->removeElement($associationEngagement)) {
            // set the owning side to null (unless already changed)
            if ($associationEngagement->getCompteFonction() === $this) {
                $associationEngagement->setCompteFonction(null);
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
            $associationMandat->setCompteFonction($this);
        }

        return $this;
    }

    public function removeAssociationMandat(Mandatement $associationMandat): self
    {
        if ($this->associationMandat->removeElement($associationMandat)) {
            // set the owning side to null (unless already changed)
            if ($associationMandat->getCompteFonction() === $this) {
                $associationMandat->setCompteFonction(null);
            }
        }

        return $this;
    }
}
