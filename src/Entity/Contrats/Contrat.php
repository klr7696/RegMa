<?php

namespace App\Entity\Contrats;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Operations\Engagement;
use App\Entity\Plans\ExceptionMarche;
use App\Entity\Projets\DecisionMarche;
use App\Entity\Soumissions\OffreMarche;
use App\Entity\Soumissions\Soumissionnaire;
use App\Repository\Contrats\ContratRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     shortName= "contrats",
 *      denormalizationContext={"disable_type_enforcement"=true}
 * )
 * @ORM\Entity(repositoryClass=ContratRepository::class)
 */
class Contrat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $typeContrat;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type="numeric",message="incorrect")
     */
    private $montantMinimum;



    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type="numeric",message="incorrect")
     */
    private $montantMaximum;



    /**
     * @ORM\Column(type="integer")
     * @Assert\Type(type="numeric",message="incorrect")
     */
    private $numeroContrat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $referenceContrat;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateApprobation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNotification;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estApprouver;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionContrat;

    /**
     * @ORM\ManyToOne(targetEntity=Contrat::class, inversedBy="associationAvenant")
     */
    private $marche;

    /**
     * @ORM\OneToMany(targetEntity=Contrat::class, mappedBy="marche")
     */
    private $associationAvenant;

    /**
     * @ORM\OneToMany(targetEntity=BonCommande::class, mappedBy="contrat", orphanRemoval=true)
     */
    private $associationBon;

    /**
     * @ORM\OneToOne(targetEntity=Engagement::class, inversedBy="contrat", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $associationEngagement;

    /**
     * @ORM\OneToOne(targetEntity=OffreMarche::class, mappedBy="associationContrat", cascade={"persist", "remove"})
     */
    private $offreMarche;

    /**
     * @ORM\OneToMany(targetEntity=DecisionMarche::class, mappedBy="contrat")
     */
    private $associationDecision;

    /**
     * @ORM\OneToMany(targetEntity=ExceptionMarche::class, mappedBy="contrat")
     */
    private $associationException;

    /**
     * @ORM\ManyToOne(targetEntity=Soumissionnaire::class, inversedBy="associationContrat")
     */
    private $soumissionnaire;

    public function __construct()
    {
        $this->associationAvenant = new ArrayCollection();
        $this->associationBon = new ArrayCollection();
        $this->associationDecision = new ArrayCollection();
        $this->associationException = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(string $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }

    public function getMontantMinimum(): ?float
    {
        return $this->montantMinimum;
    }

    public function setMontantMinimum($montantMinimum): self
    {
        $this->montantMinimum = $montantMinimum;

        return $this;
    }



    public function getMontantMaximum(): ?float
    {
        return $this->montantMaximum;
    }

    public function setMontantMaximum($montantMaximum): self
    {
        $this->montantMaximum = $montantMaximum;

        return $this;
    }



    public function getNumeroContrat(): ?int
    {
        return $this->numeroContrat;
    }

    public function setNumeroContrat($numeroContrat): self
    {
        $this->numeroContrat = $numeroContrat;

        return $this;
    }

    public function getReferenceContrat(): ?string
    {
        return $this->referenceContrat;
    }

    public function setReferenceContrat(string $referenceContrat): self
    {
        $this->referenceContrat = $referenceContrat;

        return $this;
    }

    public function getDateApprobation(): ?\DateTimeInterface
    {
        return $this->dateApprobation;
    }

    public function setDateApprobation(?\DateTimeInterface $dateApprobation): self
    {
        $this->dateApprobation = $dateApprobation;

        return $this;
    }

    public function getDateNotification(): ?\DateTimeInterface
    {
        return $this->dateNotification;
    }

    public function setDateNotification(?\DateTimeInterface $dateNotification): self
    {
        $this->dateNotification = $dateNotification;

        return $this;
    }

    public function getEstApprouver(): ?bool
    {
        return $this->estApprouver;
    }

    public function setEstApprouver(bool $estApprouver): self
    {
        $this->estApprouver = $estApprouver;

        return $this;
    }

    public function getDescriptionContrat(): ?string
    {
        return $this->descriptionContrat;
    }

    public function setDescriptionContrat(?string $descriptionContrat): self
    {
        $this->descriptionContrat = $descriptionContrat;

        return $this;
    }

    public function getMarche(): ?self
    {
        return $this->marche;
    }

    public function setMarche(?self $marche): self
    {
        $this->marche = $marche;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getAssociationAvenant(): Collection
    {
        return $this->associationAvenant;
    }

    public function addAssociationAvenant(self $associationAvenant): self
    {
        if (!$this->associationAvenant->contains($associationAvenant)) {
            $this->associationAvenant[] = $associationAvenant;
            $associationAvenant->setMarche($this);
        }

        return $this;
    }

    public function removeAssociationAvenant(self $associationAvenant): self
    {
        if ($this->associationAvenant->removeElement($associationAvenant)) {
            // set the owning side to null (unless already changed)
            if ($associationAvenant->getMarche() === $this) {
                $associationAvenant->setMarche(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BonCommande[]
     */
    public function getAssociationBon(): Collection
    {
        return $this->associationBon;
    }

    public function addAssociationBon(BonCommande $associationBon): self
    {
        if (!$this->associationBon->contains($associationBon)) {
            $this->associationBon[] = $associationBon;
            $associationBon->setContrat($this);
        }

        return $this;
    }

    public function removeAssociationBon(BonCommande $associationBon): self
    {
        if ($this->associationBon->removeElement($associationBon)) {
            // set the owning side to null (unless already changed)
            if ($associationBon->getContrat() === $this) {
                $associationBon->setContrat(null);
            }
        }

        return $this;
    }

    public function getAssociationEngagement(): ?Engagement
    {
        return $this->associationEngagement;
    }

    public function setAssociationEngagement(Engagement $associationEngagement): self
    {
        $this->associationEngagement = $associationEngagement;

        return $this;
    }

    public function getOffreMarche(): ?OffreMarche
    {
        return $this->offreMarche;
    }

    public function setOffreMarche(?OffreMarche $offreMarche): self
    {
        // unset the owning side of the relation if necessary
        if ($offreMarche === null && $this->offreMarche !== null) {
            $this->offreMarche->setAssociationContrat(null);
        }

        // set the owning side of the relation if necessary
        if ($offreMarche !== null && $offreMarche->getAssociationContrat() !== $this) {
            $offreMarche->setAssociationContrat($this);
        }

        $this->offreMarche = $offreMarche;

        return $this;
    }

    /**
     * @return Collection|DecisionMarche[]
     */
    public function getAssociationDecision(): Collection
    {
        return $this->associationDecision;
    }

    public function addAssociationDecision(DecisionMarche $associationDecision): self
    {
        if (!$this->associationDecision->contains($associationDecision)) {
            $this->associationDecision[] = $associationDecision;
            $associationDecision->setContrat($this);
        }

        return $this;
    }

    public function removeAssociationDecision(DecisionMarche $associationDecision): self
    {
        if ($this->associationDecision->removeElement($associationDecision)) {
            // set the owning side to null (unless already changed)
            if ($associationDecision->getContrat() === $this) {
                $associationDecision->setContrat(null);
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
            $associationException->setContrat($this);
        }

        return $this;
    }

    public function removeAssociationException(ExceptionMarche $associationException): self
    {
        if ($this->associationException->removeElement($associationException)) {
            // set the owning side to null (unless already changed)
            if ($associationException->getContrat() === $this) {
                $associationException->setContrat(null);
            }
        }

        return $this;
    }

    public function getSoumissionnaire(): ?Soumissionnaire
    {
        return $this->soumissionnaire;
    }

    public function setSoumissionnaire(?Soumissionnaire $soumissionnaire): self
    {
        $this->soumissionnaire = $soumissionnaire;

        return $this;
    }
}
