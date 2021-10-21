<?php

namespace App\Entity\Plans;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Administration\MairieCommunale;
use App\Entity\Prevision\ExerciceRegistre;
use App\Repository\Plans\PlanPassationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     shortName= "plans"
 * )
 * @ORM\Entity(repositoryClass=PlanPassationRepository::class)
 */
class PlanPassation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $presidentCommission;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $ordonnateurPlan;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $AdresseDepouillement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptionPlan;

    /**
     * @ORM\OneToMany(targetEntity=LotMarche::class, mappedBy="planPassation", orphanRemoval=true)
     */
    private $associationLot;

    /**
     * @ORM\OneToMany(targetEntity=ExceptionMarche::class, mappedBy="planPassation", orphanRemoval=true)
     */
    private $associationException;

    /**
     * @ORM\ManyToOne(targetEntity=MairieCommunale::class, inversedBy="associationPlan")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mairieCommunale;

    /**
     * @ORM\OneToMany(targetEntity=StatutPlan::class, mappedBy="planPassation", orphanRemoval=true)
     */
    private $associationStatut;

    /**
     * @ORM\ManyToOne(targetEntity=ExerciceRegistre::class, inversedBy="associationPlan")
     * @ORM\JoinColumn(nullable=false)
     */
    private $exerciceRegistre;

    public function __construct()
    {
        $this->associationLot = new ArrayCollection();
        $this->associationException = new ArrayCollection();
        $this->associationStatut = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPresidentCommission(): ?string
    {
        return $this->presidentCommission;
    }

    public function setPresidentCommission(?string $presidentCommission): self
    {
        $this->presidentCommission = $presidentCommission;

        return $this;
    }

    public function getOrdonnateurPlan(): ?string
    {
        return $this->ordonnateurPlan;
    }

    public function setOrdonnateurPlan(string $ordonnateurPlan): self
    {
        $this->ordonnateurPlan = $ordonnateurPlan;

        return $this;
    }

    public function getAdresseDepouillement(): ?string
    {
        return $this->AdresseDepouillement;
    }

    public function setAdresseDepouillement(?string $AdresseDepouillement): self
    {
        $this->AdresseDepouillement = $AdresseDepouillement;

        return $this;
    }

    public function getDescriptionPlan(): ?string
    {
        return $this->descriptionPlan;
    }

    public function setDescriptionPlan(?string $descriptionPlan): self
    {
        $this->descriptionPlan = $descriptionPlan;

        return $this;
    }

    /**
     * @return Collection|LotMarche[]
     */
    public function getAssociationLot(): Collection
    {
        return $this->associationLot;
    }

    public function addAssociationLot(LotMarche $associationLot): self
    {
        if (!$this->associationLot->contains($associationLot)) {
            $this->associationLot[] = $associationLot;
            $associationLot->setPlanPassation($this);
        }

        return $this;
    }

    public function removeAssociationLot(LotMarche $associationLot): self
    {
        if ($this->associationLot->removeElement($associationLot)) {
            // set the owning side to null (unless already changed)
            if ($associationLot->getPlanPassation() === $this) {
                $associationLot->setPlanPassation(null);
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
            $associationException->setPlanPassation($this);
        }

        return $this;
    }

    public function removeAssociationException(ExceptionMarche $associationException): self
    {
        if ($this->associationException->removeElement($associationException)) {
            // set the owning side to null (unless already changed)
            if ($associationException->getPlanPassation() === $this) {
                $associationException->setPlanPassation(null);
            }
        }

        return $this;
    }

    public function getMairieCommunale(): ?MairieCommunale
    {
        return $this->mairieCommunale;
    }

    public function setMairieCommunale(?MairieCommunale $mairieCommunale): self
    {
        $this->mairieCommunale = $mairieCommunale;

        return $this;
    }

    /**
     * @return Collection|StatutPlan[]
     */
    public function getAssociationStatut(): Collection
    {
        return $this->associationStatut;
    }

    public function addAssociationStatut(StatutPlan $associationStatut): self
    {
        if (!$this->associationStatut->contains($associationStatut)) {
            $this->associationStatut[] = $associationStatut;
            $associationStatut->setPlanPassation($this);
        }

        return $this;
    }

    public function removeAssociationStatut(StatutPlan $associationStatut): self
    {
        if ($this->associationStatut->removeElement($associationStatut)) {
            // set the owning side to null (unless already changed)
            if ($associationStatut->getPlanPassation() === $this) {
                $associationStatut->setPlanPassation(null);
            }
        }

        return $this;
    }

    public function getExerciceRegistre(): ?ExerciceRegistre
    {
        return $this->exerciceRegistre;
    }

    public function setExerciceRegistre(?ExerciceRegistre $exerciceRegistre): self
    {
        $this->exerciceRegistre = $exerciceRegistre;

        return $this;
    }
}
