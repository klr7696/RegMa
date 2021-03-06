<?php

namespace App\Entity\Soumissions;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Contrats\Contrat;
use App\Entity\Plans\LotMarche;
use App\Repository\Soumissions\OffreMarcheRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     shortName= "offre",
 *     denormalizationContext={"disable_type_enforcement"=true}
 * )
 * @ORM\Entity(repositoryClass=OffreMarcheRepository::class)
 */
class OffreMarche
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type="numeric",message="incorrect")
     */
    private $montantMinimumOffre;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type="numeric",message="incorrect")
     */
    private $montantMinimumCorriger;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type="numeric",message="incorrect")
     */
    private $montantMinimumArreter;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type="numeric",message="incorrect")
     */
    private $montantMaximumOffre;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type="numeric",message="incorrect")
     */
    private $montantMaximumCorriger;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type="numeric",message="incorrect")
     */
    private $montantMaximumArreter;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type="numeric",message="incorrect")
     */
    private $differenceMinimum;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type="numeric",message="incorrect")
     */
    private $differenceMaximum;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type="numeric",message="incorrect")
     */
    private $garantiOffre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresseGarantie;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $compteReglement;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $pieceNonFournir;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estRecevable;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estTaxer;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estConforme;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(type="numeric",message="incorrect")
     */
    private $classementOffre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(type="numeric",message="incorrect")
     */
    private $delaiExecution;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(type="numeric",message="incorrect")
     */
    private $delaiEngagement;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $RemarqueOffre;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateTransmission;

    /**
     * @ORM\ManyToOne(targetEntity=Soumissionnaire::class, inversedBy="associationOffre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $soumissionnaire;

    /**
     * @ORM\ManyToOne(targetEntity=SoumissionMarche::class, inversedBy="associationOffre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $soumissionMarche;

    /**
     * @ORM\OneToOne(targetEntity=Contrat::class, inversedBy="offreMarche", cascade={"persist", "remove"})
     */
    private $associationContrat;

    /**
     * @ORM\ManyToOne(targetEntity=LotMarche::class, inversedBy="associationOffre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lotMarche;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantMinimumOffre(): ?float
    {
        return $this->montantMinimumOffre;
    }

    public function setMontantMinimumOffre($montantMinimumOffre): self
    {
        $this->montantMinimumOffre = $montantMinimumOffre;

        return $this;
    }

    public function getMontantMinimumCorriger(): ?float
    {
        return $this->montantMinimumCorriger;
    }

    public function setMontantMinimumCorriger($montantMinimumCorriger): self
    {
        $this->montantMinimumCorriger = $montantMinimumCorriger;

        return $this;
    }

    public function getMontantMinimumArreter(): ?float
    {
        return $this->montantMinimumArreter;
    }

    public function setMontantMinimumArreter($montantMinimumArreter): self
    {
        $this->montantMinimumArreter = $montantMinimumArreter;

        return $this;
    }

    public function getMontantMaximumOffre(): ?float
    {
        return $this->montantMaximumOffre;
    }

    public function setMontantMaximumOffre($montantMaximumOffre): self
    {
        $this->montantMaximumOffre = $montantMaximumOffre;

        return $this;
    }

    public function getMontantMaximumCorriger(): ?float
    {
        return $this->montantMaximumCorriger;
    }

    public function setMontantMaximumCorriger( $montantMaximumCorriger): self
    {
        $this->montantMaximumCorriger = $montantMaximumCorriger;

        return $this;
    }

    public function getMontantMaximumArreter(): ?float
    {
        return $this->montantMaximumArreter;
    }

    public function setMontantMaximumArreter($montantMaximumArreter): self
    {
        $this->montantMaximumArreter = $montantMaximumArreter;

        return $this;
    }

    public function getDifferenceMinimum(): ?float
    {
        return $this->differenceMinimum;
    }

    public function setDifferenceMinimum($differenceMinimum): self
    {
        $this->differenceMinimum = $differenceMinimum;

        return $this;
    }

    public function getDifferenceMaximum(): ?float
    {
        return $this->differenceMaximum;
    }

    public function setDifferenceMaximum($differenceMaximum): self
    {
        $this->differenceMaximum = $differenceMaximum;

        return $this;
    }

    public function getGarantiOffre(): ?float
    {
        return $this->garantiOffre;
    }

    public function setGarantiOffre($garantiOffre): self
    {
        $this->garantiOffre = $garantiOffre;

        return $this;
    }

    public function getAdresseGarantie(): ?string
    {
        return $this->adresseGarantie;
    }

    public function setAdresseGarantie(?string $adresseGarantie): self
    {
        $this->adresseGarantie = $adresseGarantie;

        return $this;
    }

    public function getCompteReglement(): ?string
    {
        return $this->compteReglement;
    }

    public function setCompteReglement(?string $compteReglement): self
    {
        $this->compteReglement = $compteReglement;

        return $this;
    }

    public function getPieceNonFournir(): ?string
    {
        return $this->pieceNonFournir;
    }

    public function setPieceNonFournir(?string $pieceNonFournir): self
    {
        $this->pieceNonFournir = $pieceNonFournir;

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

    public function getEstTaxer(): ?bool
    {
        return $this->estTaxer;
    }

    public function setEstTaxer(bool $estTaxer): self
    {
        $this->estTaxer = $estTaxer;

        return $this;
    }

    public function getEstConforme(): ?bool
    {
        return $this->estConforme;
    }

    public function setEstConforme(bool $estConforme): self
    {
        $this->estConforme = $estConforme;

        return $this;
    }

    public function getClassementOffre(): ?int
    {
        return $this->classementOffre;
    }

    public function setClassementOffre($classementOffre): self
    {
        $this->classementOffre = $classementOffre;

        return $this;
    }

    public function getDelaiExecution(): ?int
    {
        return $this->delaiExecution;
    }

    public function setDelaiExecution($delaiExecution): self
    {
        $this->delaiExecution = $delaiExecution;

        return $this;
    }

    public function getDelaiEngagement(): ?int
    {
        return $this->delaiEngagement;
    }

    public function setDelaiEngagement($delaiEngagement): self
    {
        $this->delaiEngagement = $delaiEngagement;

        return $this;
    }

    public function getRemarqueOffre(): ?string
    {
        return $this->RemarqueOffre;
    }

    public function setRemarqueOffre(?string $RemarqueOffre): self
    {
        $this->RemarqueOffre = $RemarqueOffre;

        return $this;
    }

    public function getDateTransmission(): ?\DateTimeInterface
    {
        return $this->dateTransmission;
    }

    public function setDateTransmission(?\DateTimeInterface $dateTransmission): self
    {
        $this->dateTransmission = $dateTransmission;

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

    public function getSoumissionMarche(): ?SoumissionMarche
    {
        return $this->soumissionMarche;
    }

    public function setSoumissionMarche(?SoumissionMarche $soumissionMarche): self
    {
        $this->soumissionMarche = $soumissionMarche;

        return $this;
    }

    public function getAssociationContrat(): ?Contrat
    {
        return $this->associationContrat;
    }

    public function setAssociationContrat(?Contrat $associationContrat): self
    {
        $this->associationContrat = $associationContrat;

        return $this;
    }

    public function getLotMarche(): ?LotMarche
    {
        return $this->lotMarche;
    }

    public function setLotMarche(?LotMarche $lotMarche): self
    {
        $this->lotMarche = $lotMarche;

        return $this;
    }
}
