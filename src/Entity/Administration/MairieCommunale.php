<?php

namespace App\Entity\Administration;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Plans\AutorisationMarche;
use App\Entity\Plans\PlanPassation;
use App\Entity\Prevision\AllocationCredit;
use App\Repository\Administration\MairieCommunaleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     itemOperations={
 *     "get"={"openapi_context"={"summary"="Affiche les informations d'une mairie"}}
 * ,"put"={"openapi_context"={"summary"="Modifie une mairie"}},
 *     "delete"={"openapi_context"={"summary"="Supprime une mairie"}}
 *
 *   },
 *     collectionOperations={
 *     "get" ={"openapi_context"={"summary"="Affiche les informations des mairies"}}
 *     ,"post"={"openapi_context"={"summary"="Crée une mairie"}}
 * },
 *     shortName= "mairie",
 *      normalizationContext={"groups"={"mairie_detail:read","nomen_compte:read"}, "openapi_definition_name"= "Read"},
 *      denormalizationContext={"groups"={"mairie_detail:write"}, "openapi_definition_name"= "Write"},
 * )
 * @ORM\Entity(repositoryClass=MairieCommunaleRepository::class)
 */
class MairieCommunale
{
    /**
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"mairie_detail:read","mairie_detail:write"})
     */
    private $designationMairie;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"mairie_detail:read","mairie_detail:write"})
     */
    private $abbreviationMairie;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"mairie_detail:read","mairie_detail:write"})
     */
    private $adresseMairie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"mairie_detail:read","mairie_detail:write"})
     */
    private $descriptionMairie;

    /**
     * @ORM\OneToMany(targetEntity=AllocationCredit::class, mappedBy="mairieCommunale", orphanRemoval=true)
     */
    private $associationAllocation;

    /**
     * @ORM\OneToMany(targetEntity=PlanPassation::class, mappedBy="mairieCommunale", orphanRemoval=true)
     */
    private $associationPlan;

    /**
     * @ORM\OneToMany(targetEntity=AutorisationMarche::class, mappedBy="mairieCommunale", orphanRemoval=true)
     */
    private $associationAutorisation;

    public function __construct()
    {
        $this->associationAllocation = new ArrayCollection();
        $this->associationPlan = new ArrayCollection();
        $this->associationAutorisation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignationMairie(): ?string
    {
        return $this->designationMairie;
    }

    public function setDesignationMairie(string $designationMairie): self
    {
        $this->designationMairie = $designationMairie;

        return $this;
    }

    public function getAbbreviationMairie(): ?string
    {
        return $this->abbreviationMairie;
    }

    public function setAbbreviationMairie(string $abbreviationMairie): self
    {
        $this->abbreviationMairie = $abbreviationMairie;

        return $this;
    }

    public function getAdresseMairie(): ?string
    {
        return $this->adresseMairie;
    }

    public function setAdresseMairie(string $adresseMairie): self
    {
        $this->adresseMairie = $adresseMairie;

        return $this;
    }

    public function getDescriptionMairie(): ?string
    {
        return $this->descriptionMairie;
    }

    public function setDescriptionMairie(?string $descriptionMairie): self
    {
        $this->descriptionMairie = $descriptionMairie;

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
            $associationAllocation->setMairieCommunale($this);
        }

        return $this;
    }

    public function removeAssociationAllocation(AllocationCredit $associationAllocation): self
    {
        if ($this->associationAllocation->removeElement($associationAllocation)) {
            // set the owning side to null (unless already changed)
            if ($associationAllocation->getMairieCommunale() === $this) {
                $associationAllocation->setMairieCommunale(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PlanPassation[]
     */
    public function getAssociationPlan(): Collection
    {
        return $this->associationPlan;
    }

    public function addAssociationPlan(PlanPassation $associationPlan): self
    {
        if (!$this->associationPlan->contains($associationPlan)) {
            $this->associationPlan[] = $associationPlan;
            $associationPlan->setMairieCommunale($this);
        }

        return $this;
    }

    public function removeAssociationPlan(PlanPassation $associationPlan): self
    {
        if ($this->associationPlan->removeElement($associationPlan)) {
            // set the owning side to null (unless already changed)
            if ($associationPlan->getMairieCommunale() === $this) {
                $associationPlan->setMairieCommunale(null);
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
            $associationAutorisation->setMairieCommunale($this);
        }

        return $this;
    }

    public function removeAssociationAutorisation(AutorisationMarche $associationAutorisation): self
    {
        if ($this->associationAutorisation->removeElement($associationAutorisation)) {
            // set the owning side to null (unless already changed)
            if ($associationAutorisation->getMairieCommunale() === $this) {
                $associationAutorisation->setMairieCommunale(null);
            }
        }

        return $this;
    }
}
