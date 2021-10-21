<?php

namespace App\Entity\Projets;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Contrats\Contrat;
use App\Repository\Projets\DecisionMarcheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     shortName= "decisions"
 * )
 * @ORM\Entity(repositoryClass=DecisionMarcheRepository::class)
 */
class DecisionMarche
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $objetDecision;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroDecision;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $referenceDecision;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDecision;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estPublier;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $journalPublication;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numeroPublication;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datePublication;

    /**
     * @ORM\ManyToOne(targetEntity=ProjetMarche::class, inversedBy="associationDecision")
     */
    private $projetMarche;

    /**
     * @ORM\ManyToOne(targetEntity=Contrat::class, inversedBy="associationDecision")
     */
    private $contrat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjetDecision(): ?string
    {
        return $this->objetDecision;
    }

    public function setObjetDecision(?string $objetDecision): self
    {
        $this->objetDecision = $objetDecision;

        return $this;
    }

    public function getNumeroDecision(): ?int
    {
        return $this->numeroDecision;
    }

    public function setNumeroDecision(int $numeroDecision): self
    {
        $this->numeroDecision = $numeroDecision;

        return $this;
    }

    public function getReferenceDecision(): ?string
    {
        return $this->referenceDecision;
    }

    public function setReferenceDecision(?string $referenceDecision): self
    {
        $this->referenceDecision = $referenceDecision;

        return $this;
    }

    public function getDateDecision(): ?\DateTimeInterface
    {
        return $this->dateDecision;
    }

    public function setDateDecision(?\DateTimeInterface $dateDecision): self
    {
        $this->dateDecision = $dateDecision;

        return $this;
    }

    public function getEstPublier(): ?bool
    {
        return $this->estPublier;
    }

    public function setEstPublier(bool $estPublier): self
    {
        $this->estPublier = $estPublier;

        return $this;
    }

    public function getJournalPublication(): ?string
    {
        return $this->journalPublication;
    }

    public function setJournalPublication(?string $journalPublication): self
    {
        $this->journalPublication = $journalPublication;

        return $this;
    }

    public function getNumeroPublication(): ?int
    {
        return $this->numeroPublication;
    }

    public function setNumeroPublication(?int $numeroPublication): self
    {
        $this->numeroPublication = $numeroPublication;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    public function setDatePublication(?\DateTimeInterface $datePublication): self
    {
        $this->datePublication = $datePublication;

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

    public function getContrat(): ?Contrat
    {
        return $this->contrat;
    }

    public function setContrat(?Contrat $contrat): self
    {
        $this->contrat = $contrat;

        return $this;
    }
}
