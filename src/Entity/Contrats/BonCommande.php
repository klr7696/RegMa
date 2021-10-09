<?php

namespace App\Entity\Contrats;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Commissions\Commission;
use App\Entity\Operations\Mandatement;
use App\Repository\Contrats\BonCommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=BonCommandeRepository::class)
 */
class BonCommande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroBon;

    /**
     * @ORM\Column(type="float")
     */
    private $montantBon;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDemarrage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $delaiExecution;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateReceptionNormal;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateReceptionEffective;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estReceptioner;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lieuReception;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $montantPenalite;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $objetPenalite;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionReception;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionBon;

    /**
     * @ORM\OneToMany(targetEntity=ItemCommande::class, mappedBy="bonCommande", orphanRemoval=true)
     */
    private $assoiciationItem;

    /**
     * @ORM\ManyToOne(targetEntity=Contrat::class, inversedBy="associationBon")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contrat;

    /**
     * @ORM\OneToMany(targetEntity=Mandatement::class, mappedBy="bonCommande", orphanRemoval=true)
     */
    private $associationMandat;

    /**
     * @ORM\OneToMany(targetEntity=Commission::class, mappedBy="bonCommande")
     */
    private $associationCommission;

    public function __construct()
    {
        $this->assoiciationItem = new ArrayCollection();
        $this->associationMandat = new ArrayCollection();
        $this->associationCommission = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroBon(): ?int
    {
        return $this->numeroBon;
    }

    public function setNumeroBon(int $numeroBon): self
    {
        $this->numeroBon = $numeroBon;

        return $this;
    }

    public function getMontantBon(): ?float
    {
        return $this->montantBon;
    }

    public function setMontantBon(float $montantBon): self
    {
        $this->montantBon = $montantBon;

        return $this;
    }

    public function getDateDemarrage(): ?\DateTimeInterface
    {
        return $this->dateDemarrage;
    }

    public function setDateDemarrage(?\DateTimeInterface $dateDemarrage): self
    {
        $this->dateDemarrage = $dateDemarrage;

        return $this;
    }

    public function getDelaiExecution(): ?int
    {
        return $this->delaiExecution;
    }

    public function setDelaiExecution(?int $delaiExecution): self
    {
        $this->delaiExecution = $delaiExecution;

        return $this;
    }

    public function getDateReceptionNormal(): ?\DateTimeInterface
    {
        return $this->dateReceptionNormal;
    }

    public function setDateReceptionNormal(?\DateTimeInterface $dateReceptionNormal): self
    {
        $this->dateReceptionNormal = $dateReceptionNormal;

        return $this;
    }

    public function getDateReceptionEffective(): ?\DateTimeInterface
    {
        return $this->dateReceptionEffective;
    }

    public function setDateReceptionEffective(?\DateTimeInterface $dateReceptionEffective): self
    {
        $this->dateReceptionEffective = $dateReceptionEffective;

        return $this;
    }

    public function getEstReceptioner(): ?bool
    {
        return $this->estReceptioner;
    }

    public function setEstReceptioner(bool $estReceptioner): self
    {
        $this->estReceptioner = $estReceptioner;

        return $this;
    }

    public function getLieuReception(): ?string
    {
        return $this->lieuReception;
    }

    public function setLieuReception(?string $lieuReception): self
    {
        $this->lieuReception = $lieuReception;

        return $this;
    }

    public function getMontantPenalite(): ?float
    {
        return $this->montantPenalite;
    }

    public function setMontantPenalite(?float $montantPenalite): self
    {
        $this->montantPenalite = $montantPenalite;

        return $this;
    }

    public function getObjetPenalite(): ?string
    {
        return $this->objetPenalite;
    }

    public function setObjetPenalite(?string $objetPenalite): self
    {
        $this->objetPenalite = $objetPenalite;

        return $this;
    }

    public function getDescriptionReception(): ?string
    {
        return $this->descriptionReception;
    }

    public function setDescriptionReception(?string $descriptionReception): self
    {
        $this->descriptionReception = $descriptionReception;

        return $this;
    }

    public function getDescriptionBon(): ?string
    {
        return $this->descriptionBon;
    }

    public function setDescriptionBon(?string $descriptionBon): self
    {
        $this->descriptionBon = $descriptionBon;

        return $this;
    }

    /**
     * @return Collection|ItemCommande[]
     */
    public function getAssoiciationItem(): Collection
    {
        return $this->assoiciationItem;
    }

    public function addAssoiciationItem(ItemCommande $assoiciationItem): self
    {
        if (!$this->assoiciationItem->contains($assoiciationItem)) {
            $this->assoiciationItem[] = $assoiciationItem;
            $assoiciationItem->setBonCommande($this);
        }

        return $this;
    }

    public function removeAssoiciationItem(ItemCommande $assoiciationItem): self
    {
        if ($this->assoiciationItem->removeElement($assoiciationItem)) {
            // set the owning side to null (unless already changed)
            if ($assoiciationItem->getBonCommande() === $this) {
                $assoiciationItem->setBonCommande(null);
            }
        }

        return $this;
    }

    public function getContrat(): ?Contrat
    {
        return $this->contrat;
    }

    public function setContrat(?Contrat $contrat): self
    {
        $this->contrat = $contrat;

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
            $associationMandat->setBonCommande($this);
        }

        return $this;
    }

    public function removeAssociationMandat(Mandatement $associationMandat): self
    {
        if ($this->associationMandat->removeElement($associationMandat)) {
            // set the owning side to null (unless already changed)
            if ($associationMandat->getBonCommande() === $this) {
                $associationMandat->setBonCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commission[]
     */
    public function getAssociationCommission(): Collection
    {
        return $this->associationCommission;
    }

    public function addAssociationCommission(Commission $associationCommission): self
    {
        if (!$this->associationCommission->contains($associationCommission)) {
            $this->associationCommission[] = $associationCommission;
            $associationCommission->setBonCommande($this);
        }

        return $this;
    }

    public function removeAssociationCommission(Commission $associationCommission): self
    {
        if ($this->associationCommission->removeElement($associationCommission)) {
            // set the owning side to null (unless already changed)
            if ($associationCommission->getBonCommande() === $this) {
                $associationCommission->setBonCommande(null);
            }
        }

        return $this;
    }
}
