<?php

namespace App\Entity\Projets;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Projets\PhaseMarcheRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     shortName= "phases",
 * denormalizationContext={"disable_type_enforcement"=true}
 * )
 * @ORM\Entity(repositoryClass=PhaseMarcheRepository::class)
 */
class PhaseMarche
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
    private $typePhase;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $debutPublicite;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $finPublicite;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type(type="numeric",message="incorrect")
     */
    private $dureePublicite;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $debutRemiseOffre;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $finRemiseOffre;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type(type="numeric",message="incorrect")
     */
    private $dureeRemiseOffre;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDemarrage;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type(type="numeric",message="incorrect")
     */
    private $tempsEvaluation;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOuverturePlis;

    /**
     * @ORM\ManyToOne(targetEntity=ProjetMarche::class, inversedBy="associationPhase")
     * @ORM\JoinColumn(nullable=false)
     */
    private $projetMarche;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypePhase(): ?string
    {
        return $this->typePhase;
    }

    public function setTypePhase(string $typePhase): self
    {
        $this->typePhase = $typePhase;

        return $this;
    }

    public function getDebutPublicite(): ?\DateTimeInterface
    {
        return $this->debutPublicite;
    }

    public function setDebutPublicite(?\DateTimeInterface $debutPublicite): self
    {
        $this->debutPublicite = $debutPublicite;

        return $this;
    }

    public function getFinPublicite(): ?\DateTimeInterface
    {
        return $this->finPublicite;
    }

    public function setFinPublicite(?\DateTimeInterface $finPublicite): self
    {
        $this->finPublicite = $finPublicite;

        return $this;
    }

    public function getDureePublicite(): ?int
    {
        return $this->dureePublicite;
    }

    public function setDureePublicite($dureePublicite): self
    {
        $this->dureePublicite = $dureePublicite;

        return $this;
    }

    public function getDebutRemiseOffre(): ?\DateTimeInterface
    {
        return $this->debutRemiseOffre;
    }

    public function setDebutRemiseOffre(?\DateTimeInterface $debutRemiseOffre): self
    {
        $this->debutRemiseOffre = $debutRemiseOffre;

        return $this;
    }

    public function getFinRemiseOffre(): ?\DateTimeInterface
    {
        return $this->finRemiseOffre;
    }

    public function setFinRemiseOffre(?\DateTimeInterface $finRemiseOffre): self
    {
        $this->finRemiseOffre = $finRemiseOffre;

        return $this;
    }

    public function getDureeRemiseOffre(): ?int
    {
        return $this->dureeRemiseOffre;
    }

    public function setDureeRemiseOffre($dureeRemiseOffre): self
    {
        $this->dureeRemiseOffre = $dureeRemiseOffre;

        return $this;
    }

    public function getDateDemarrage(): ?\DateTimeInterface
    {
        return $this->dateDemarrage;
    }

    public function setDateDemarrage(\DateTimeInterface $dateDemarrage): self
    {
        $this->dateDemarrage = $dateDemarrage;

        return $this;
    }

    public function getTempsEvaluation(): ?int
    {
        return $this->tempsEvaluation;
    }

    public function setTempsEvaluation($tempsEvaluation): self
    {
        $this->tempsEvaluation = $tempsEvaluation;

        return $this;
    }

    public function getDateOuverturePlis(): ?\DateTimeInterface
    {
        return $this->dateOuverturePlis;
    }

    public function setDateOuverturePlis(\DateTimeInterface $dateOuverturePlis): self
    {
        $this->dateOuverturePlis = $dateOuverturePlis;

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
