<?php

namespace App\Entity\Plans;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Contrats\Contrat;
use App\Repository\Plans\ExceptionMarcheRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     shortName= "exceptions",
 * denormalizationContext={"disable_type_enforcement"=true}
 * )
 * @ORM\Entity(repositoryClass=ExceptionMarcheRepository::class)
 */
class ExceptionMarche
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $typeException;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $objetException;

    /**
     * @ORM\Column(type="float")
     * @Assert\Type(type="numeric",message="montant incorrect")
     */
    private $montantException;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observationException;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(type="numeric",message="delai incorrect")
     */
    private $delaiExcecution;

    /**
     * @ORM\ManyToOne(targetEntity=PlanPassation::class, inversedBy="associationException")
     * @ORM\JoinColumn(nullable=false)
     */
    private $planPassation;

    /**
     * @ORM\ManyToOne(targetEntity=AutorisationMarche::class, inversedBy="associationException")
     * @ORM\JoinColumn(nullable=false)
     */
    private $autorisationMarche;

    /**
     * @ORM\ManyToOne(targetEntity=Contrat::class, inversedBy="associationException")
     */
    private $contrat;

    /**
     * @ORM\OneToOne(targetEntity=LienPlan::class, inversedBy="exceptionMarche", cascade={"persist", "remove"})
     */
    private $associationExceptionActuel;

    /**
     * @ORM\OneToOne(targetEntity=LienPlan::class, mappedBy="associationExceptionModifier", cascade={"persist", "remove"})
     */
    private $lienPlan;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeException(): ?string
    {
        return $this->typeException;
    }

    public function setTypeException(string $typeException): self
    {
        $this->typeException = $typeException;

        return $this;
    }

    public function getObjetException(): ?string
    {
        return $this->objetException;
    }

    public function setObjetException(?string $objetException): self
    {
        $this->objetException = $objetException;

        return $this;
    }

    public function getMontantException(): ?float
    {
        return $this->montantException;
    }

    public function setMontantException($montantException): self
    {
        $this->montantException = $montantException;

        return $this;
    }

    public function getObservationException(): ?string
    {
        return $this->observationException;
    }

    public function setObservationException(?string $observationException): self
    {
        $this->observationException = $observationException;

        return $this;
    }

    public function getDelaiExcecution(): ?int
    {
        return $this->delaiExcecution;
    }

    public function setDelaiExcecution($delaiExcecution): self
    {
        $this->delaiExcecution = $delaiExcecution;

        return $this;
    }

    public function getPlanPassation(): ?PlanPassation
    {
        return $this->planPassation;
    }

    public function setPlanPassation(?PlanPassation $planPassation): self
    {
        $this->planPassation = $planPassation;

        return $this;
    }

    public function getAutorisationMarche(): ?AutorisationMarche
    {
        return $this->autorisationMarche;
    }

    public function setAutorisationMarche(?AutorisationMarche $autorisationMarche): self
    {
        $this->autorisationMarche = $autorisationMarche;

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

    public function getAssociationExceptionActuel(): ?LienPlan
    {
        return $this->associationExceptionActuel;
    }

    public function setAssociationExceptionActuel(?LienPlan $associationExceptionActuel): self
    {
        $this->associationExceptionActuel = $associationExceptionActuel;

        return $this;
    }

    public function getLienPlan(): ?LienPlan
    {
        return $this->lienPlan;
    }

    public function setLienPlan(?LienPlan $lienPlan): self
    {
        // unset the owning side of the relation if necessary
        if ($lienPlan === null && $this->lienPlan !== null) {
            $this->lienPlan->setAssociationExceptionModifier(null);
        }

        // set the owning side of the relation if necessary
        if ($lienPlan !== null && $lienPlan->getAssociationExceptionModifier() !== $this) {
            $lienPlan->setAssociationExceptionModifier($this);
        }

        $this->lienPlan = $lienPlan;

        return $this;
    }
}
