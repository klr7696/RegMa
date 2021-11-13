<?php

namespace App\Entity\Prevision;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use App\Entity\Plans\AutorisationMarche;
use App\Repository\Prevision\BailleurFondsRepository;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ApiResource(
 *    shortName= "bailleurs",
 *      itemOperations={
 *     "get"={"openapi_context"={"summary"="Affiche les informations d'un bailleur de fonds"}}
 * ,"put"={"openapi_context"={"summary"="Modifie un bailleur de fonds"}},
 *     "delete"={"openapi_context"={"summary"="Supprime un bailleur de fonds"}}
 *   },
 *     collectionOperations={
 *     "actifressource"={"method"="get", "path"="/bailleurs/actifressource",
 * "normalization_context"={"groups"={"actifressource:read"}},
 *     "openapi_context"={"summary"="Affiche les ressources du registre en cours"}
 *     },
 *
 *     "get" ={
 *     "openapi_context"={"summary"="Affiche les informations des bailleurs de fonds"}}
 *     ,"post"={"openapi_context"={"summary"="Crée un bailleur de fonds"}}
 * },
 *
 *      normalizationContext={"groups"={"bailleurs_detail:read"}, "openapi_definition_name"= "Read"},
 *      denormalizationContext={"groups"={"bailleurs_detail:write"}, "openapi_definition_name"= "Write"},
 *     subresourceOperations={
 *     "association_ressources_get_subresource"= {
 *     "method"= "get",
 *     "path"="/bailleurs/{id}/ressources"
 *     }
 *     }
 * )
 * @ORM\Entity(repositoryClass=BailleurFondsRepository::class)
 *@ApiFilter(SearchFilter::class, properties={"sigleBailleur"="exact",
 *     })
 *
 *@ApiFilter(BooleanFilter::class,
 *     properties={"associationRessource.statutRegistre.exerciceRegistre.estOuvert","associationRessource.estValide",
 *     "associationRessource.statutRegistre.estEnCours","associationRessource.statutRegistre.estActualisable"})
 */
class BailleurFonds
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"actifressource:read","resencours:read","regisress:read",
     *     "autoalloc:read","ress_actualise","bailleurs_detail:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"bailleurs_detail:read","bailleurs_detail:write",
     *     "actifressource:read","resencours:read","regisress:read",
     *     "autoalloc:read","ress_actualise"})
     */
    private $designationBailleur;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"bailleurs_detail:read","bailleurs_detail:write",
     *     "actifressource:read","resencours:read","regisress:read",
     *     "ress_actualise"})
     *
     */
    private $sigleBailleur;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"bailleurs_detail:read","bailleurs_detail:write"})
     */
    private $categorieBailleur;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"bailleurs_detail:read","bailleurs_detail:write"})
     */
    private $codeBailleur;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"bailleurs_detail:read","bailleurs_detail:write",
     *     "actifressource:read","resencours:read","regisress:read",
     *     "autoalloc:read","ress_actualise"})
     */
    private $sourceFinancement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"bailleurs_detail:read","bailleurs_detail:write"})
     */
    private $descriptionBailleur;

    /**
     * @ORM\OneToMany(targetEntity=RessourceFinanciere::class, mappedBy="bailleurFonds", orphanRemoval=true)
     * @Groups({"actifressource:read"})
     * @ApiSubresource(maxDepth=1)
     *
     */
    private $associationRessource;

    /**
     * @ORM\ManyToMany(targetEntity=AutorisationMarche::class, mappedBy="associationBailleur")
     */
    private $autorisationMarches;

    public function __construct()
    {
        $this->associationRessource = new ArrayCollection();
        $this->autorisationMarches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignationBailleur(): ?string
    {
        return $this->designationBailleur;
    }

    public function setDesignationBailleur(string $designationBailleur): self
    {
        $this->designationBailleur = $designationBailleur;

        return $this;
    }

    public function getSigleBailleur(): ?string
    {
        return $this->sigleBailleur;
    }

    public function setSigleBailleur(string $sigleBailleur): self
    {
        $this->sigleBailleur = $sigleBailleur;

        return $this;
    }

    public function getCategorieBailleur(): ?string
    {
        return $this->categorieBailleur;
    }

    public function setCategorieBailleur(string $categorieBailleur): self
    {
        $this->categorieBailleur = $categorieBailleur;

        return $this;
    }

    public function getCodeBailleur(): ?string
    {
        return $this->codeBailleur;
    }

    public function setCodeBailleur(string $codeBailleur): self
    {
        $this->codeBailleur = $codeBailleur;

        return $this;
    }

    public function getSourceFinancement(): ?string
    {
        return $this->sourceFinancement;
    }

    public function setSourceFinancement(string $sourceFinancement): self
    {
        $this->sourceFinancement = $sourceFinancement;

        return $this;
    }

    public function getDescriptionBailleur(): ?string
    {
        return $this->descriptionBailleur;
    }

    public function setDescriptionBailleur(?string $descriptionBailleur): self
    {
        $this->descriptionBailleur = $descriptionBailleur;

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
            $associationRessource->setBailleurFonds($this);
        }

        return $this;
    }

    public function removeAssociationRessource(RessourceFinanciere $associationRessource): self
    {
        if ($this->associationRessource->removeElement($associationRessource)) {
            // set the owning side to null (unless already changed)
            if ($associationRessource->getBailleurFonds() === $this) {
                $associationRessource->setBailleurFonds(null);
            }
        }

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
            $autorisationMarch->addAssociationBailleur($this);
        }

        return $this;
    }

    public function removeAutorisationMarch(AutorisationMarche $autorisationMarch): self
    {
        if ($this->autorisationMarches->removeElement($autorisationMarch)) {
            $autorisationMarch->removeAssociationBailleur($this);
        }

        return $this;
    }
}
