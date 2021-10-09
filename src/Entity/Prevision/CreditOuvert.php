<?php

namespace App\Entity\Prevision;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Nomenclatures\CompteNature;
use App\Repository\Prevision\CreditOuvertRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CreditOuvertRepository::class)
 */
class CreditOuvert
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $montantInscription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptionInscription;

    /**
     * @ORM\ManyToOne(targetEntity=RessourceFinanciere::class, inversedBy="associationCredit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ressourceFinanciere;

    /**
     * @ORM\OneToMany(targetEntity=AllocationCredit::class, mappedBy="creditOuvert", orphanRemoval=true)
     */
    private $associationAllocation;

    /**
     * @ORM\OneToOne(targetEntity=LienRegistre::class, inversedBy="creditOuvert", cascade={"persist", "remove"})
     */
    private $associationCreditActuel;

    /**
     * @ORM\OneToOne(targetEntity=LienRegistre::class, mappedBy="associationCreditModifier", cascade={"persist", "remove"})
     */
    private $lienRegistre;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estValide;

    /**
     * @ORM\ManyToOne(targetEntity=CompteNature::class, inversedBy="associationCreditOuvert")
     * @ORM\JoinColumn(nullable=false)
     */
    private $compteNature;

    public function __construct()
    {
        $this->associationAllocation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantInscription(): ?float
    {
        return $this->montantInscription;
    }

    public function setMontantInscription(float $montantInscription): self
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

    public function getAssociationCreditActuel(): ?LienRegistre
    {
        return $this->associationCreditActuel;
    }

    public function setAssociationCreditActuel(?LienRegistre $associationCreditActuel): self
    {
        $this->associationCreditActuel = $associationCreditActuel;

        return $this;
    }

    public function getLienRegistre(): ?LienRegistre
    {
        return $this->lienRegistre;
    }

    public function setLienRegistre(?LienRegistre $lienRegistre): self
    {
        // unset the owning side of the relation if necessary
        if ($lienRegistre === null && $this->lienRegistre !== null) {
            $this->lienRegistre->setAssociationCreditModifier(null);
        }

        // set the owning side of the relation if necessary
        if ($lienRegistre !== null && $lienRegistre->getAssociationCreditModifier() !== $this) {
            $lienRegistre->setAssociationCreditModifier($this);
        }

        $this->lienRegistre = $lienRegistre;

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
}
