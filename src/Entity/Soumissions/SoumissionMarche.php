<?php

namespace App\Entity\Soumissions;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Projets\ProjetMarche;
use App\Repository\Soumissions\SoumissionMarcheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SoumissionMarcheRepository::class)
 */
class SoumissionMarche
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
    private $numeroRetrait;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $numeroQuittance;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nomRepresantantRetrait;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nomRepresantantDepot;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nomRepresantantAnnulation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactRetrait;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactDepot;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactAnnulation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateRetrait;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDepot;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateAnnulation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numeroDepot;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heureDepot;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estRecevable;

    /**
     * @ORM\ManyToOne(targetEntity=Soumissionnaire::class, inversedBy="associationSoumission")
     * @ORM\JoinColumn(nullable=false)
     */
    private $soumissionnaire;

    /**
     * @ORM\OneToMany(targetEntity=OffreMarche::class, mappedBy="soumissionMarche", orphanRemoval=true)
     */
    private $associationOffre;

    /**
     * @ORM\ManyToOne(targetEntity=ProjetMarche::class, inversedBy="associationSoumission")
     * @ORM\JoinColumn(nullable=false)
     */
    private $projetMarche;

    public function __construct()
    {
        $this->associationOffre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroRetrait(): ?int
    {
        return $this->numeroRetrait;
    }

    public function setNumeroRetrait(int $numeroRetrait): self
    {
        $this->numeroRetrait = $numeroRetrait;

        return $this;
    }

    public function getNumeroQuittance(): ?string
    {
        return $this->numeroQuittance;
    }

    public function setNumeroQuittance(string $numeroQuittance): self
    {
        $this->numeroQuittance = $numeroQuittance;

        return $this;
    }

    public function getNomRepresantantRetrait(): ?string
    {
        return $this->nomRepresantantRetrait;
    }

    public function setNomRepresantantRetrait(?string $nomRepresantantRetrait): self
    {
        $this->nomRepresantantRetrait = $nomRepresantantRetrait;

        return $this;
    }

    public function getNomRepresantantDepot(): ?string
    {
        return $this->nomRepresantantDepot;
    }

    public function setNomRepresantantDepot(?string $nomRepresantantDepot): self
    {
        $this->nomRepresantantDepot = $nomRepresantantDepot;

        return $this;
    }

    public function getNomRepresantantAnnulation(): ?string
    {
        return $this->nomRepresantantAnnulation;
    }

    public function setNomRepresantantAnnulation(?string $nomRepresantantAnnulation): self
    {
        $this->nomRepresantantAnnulation = $nomRepresantantAnnulation;

        return $this;
    }

    public function getContactRetrait(): ?string
    {
        return $this->contactRetrait;
    }

    public function setContactRetrait(?string $contactRetrait): self
    {
        $this->contactRetrait = $contactRetrait;

        return $this;
    }

    public function getContactDepot(): ?string
    {
        return $this->contactDepot;
    }

    public function setContactDepot(?string $contactDepot): self
    {
        $this->contactDepot = $contactDepot;

        return $this;
    }

    public function getContactAnnulation(): ?string
    {
        return $this->contactAnnulation;
    }

    public function setContactAnnulation(?string $contactAnnulation): self
    {
        $this->contactAnnulation = $contactAnnulation;

        return $this;
    }

    public function getDateRetrait(): ?\DateTimeInterface
    {
        return $this->dateRetrait;
    }

    public function setDateRetrait(?\DateTimeInterface $dateRetrait): self
    {
        $this->dateRetrait = $dateRetrait;

        return $this;
    }

    public function getDateDepot(): ?\DateTimeInterface
    {
        return $this->dateDepot;
    }

    public function setDateDepot(?\DateTimeInterface $dateDepot): self
    {
        $this->dateDepot = $dateDepot;

        return $this;
    }

    public function getDateAnnulation(): ?\DateTimeInterface
    {
        return $this->dateAnnulation;
    }

    public function setDateAnnulation(?\DateTimeInterface $dateAnnulation): self
    {
        $this->dateAnnulation = $dateAnnulation;

        return $this;
    }

    public function getNumeroDepot(): ?int
    {
        return $this->numeroDepot;
    }

    public function setNumeroDepot(int $numeroDepot): self
    {
        $this->numeroDepot = $numeroDepot;

        return $this;
    }

    public function getHeureDepot(): ?\DateTimeInterface
    {
        return $this->heureDepot;
    }

    public function setHeureDepot(?\DateTimeInterface $heureDepot): self
    {
        $this->heureDepot = $heureDepot;

        return $this;
    }

    public function getEstRecevable(): ?bool
    {
        return $this->estRecevable;
    }

    public function setEstRecevable(bool $estRecevable): self
    {
        $this->estRecevable = $estRecevable;

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

    /**
     * @return Collection|OffreMarche[]
     */
    public function getAssociationOffre(): Collection
    {
        return $this->associationOffre;
    }

    public function addAssociationOffre(OffreMarche $associationOffre): self
    {
        if (!$this->associationOffre->contains($associationOffre)) {
            $this->associationOffre[] = $associationOffre;
            $associationOffre->setSoumissionMarche($this);
        }

        return $this;
    }

    public function removeAssociationOffre(OffreMarche $associationOffre): self
    {
        if ($this->associationOffre->removeElement($associationOffre)) {
            // set the owning side to null (unless already changed)
            if ($associationOffre->getSoumissionMarche() === $this) {
                $associationOffre->setSoumissionMarche(null);
            }
        }

        return $this;
    }

    public function getProjetMarche(): ?ProjetMarche
    {
        return $this->projetMarche;
    }

    public function setProjetMarche(?ProjetMarche $projetMarche): self
    {
        $this->projetMarche = $projetMarche;

        return $this;
    }
}
