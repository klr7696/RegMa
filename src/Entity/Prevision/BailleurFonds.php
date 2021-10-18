<?php

namespace App\Entity\Prevision;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Prevision\BailleurFondsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     itemOperations={
 *     "get"={"openapi_context"={"summary"="Affiche les informations d'un bailleur de fonds"}}
 * ,"patch"={"openapi_context"={"summary"="Actualise les informations d'un bailleur de fonds"}}
 *   },
 *     collectionOperations={
 *     "get" ={"openapi_context"={"summary"="Affiche les informations des bailleurs de fonds"}}
 *     ,"post"={"openapi_context"={"summary"="Crée un bailleur de fonds"}}
 * },
 *     shortName= "bailleurs",
 *      normalizationContext={"groups"={"bailleurs_detail:read"}, "openapi_definition_name"= "Read"},
 *      denormalizationContext={"groups"={"bailleurs_detail:write"}, "openapi_definition_name"= "Write"},
 * )
 * @ORM\Entity(repositoryClass=BailleurFondsRepository::class)
 */
class BailleurFonds
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"bailleurs_detail:read","bailleurs_detail:write"})
     */
    private $designationBailleur;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"bailleurs_detail:read","bailleurs_detail:write"})
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
     * @Groups({"bailleurs_detail:read","bailleurs_detail:write"})
     */
    private $sourceFinancement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"bailleurs_detail:read","bailleurs_detail:write"})
     */
    private $descriptionBailleur;

    /**
     * @ORM\OneToMany(targetEntity=RessourceFinanciere::class, mappedBy="bailleurFonds", orphanRemoval=true)
     * @Groups({"bailleurs_detail:read"})
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
}
