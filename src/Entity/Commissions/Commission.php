<?php

namespace App\Entity\Commissions;

use App\Repository\Commissions\CommissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommissionRepository::class)
 */
class Commission
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeCommission;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $referenceConvocation;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $objetConvocation;

    /**
     * @ORM\Column(type="date")
     */
    private $dateConvocation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionConvocation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNotification;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDebutSession;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateFinSession;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $syntheseSessionOuverture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heureDebutSession;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heureFinSessionOuverture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heureDebutSessionFermeture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heureFinSessionFermeture;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $syntheseFermeture;

    /**
     * @ORM\OneToMany(targetEntity=ParticipantCommission::class, mappedBy="commission", orphanRemoval=true)
     */
    private $associationParticipant;

    public function __construct()
    {
        $this->associationParticipant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeCommission(): ?string
    {
        return $this->typeCommission;
    }

    public function setTypeCommission(string $typeCommission): self
    {
        $this->typeCommission = $typeCommission;

        return $this;
    }

    public function getReferenceConvocation(): ?string
    {
        return $this->referenceConvocation;
    }

    public function setReferenceConvocation(string $referenceConvocation): self
    {
        $this->referenceConvocation = $referenceConvocation;

        return $this;
    }

    public function getObjetConvocation(): ?string
    {
        return $this->objetConvocation;
    }

    public function setObjetConvocation(string $objetConvocation): self
    {
        $this->objetConvocation = $objetConvocation;

        return $this;
    }

    public function getDateConvocation(): ?\DateTimeInterface
    {
        return $this->dateConvocation;
    }

    public function setDateConvocation(\DateTimeInterface $dateConvocation): self
    {
        $this->dateConvocation = $dateConvocation;

        return $this;
    }

    public function getDescriptionConvocation(): ?string
    {
        return $this->descriptionConvocation;
    }

    public function setDescriptionConvocation(?string $descriptionConvocation): self
    {
        $this->descriptionConvocation = $descriptionConvocation;

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

    public function getDateDebutSession(): ?\DateTimeInterface
    {
        return $this->dateDebutSession;
    }

    public function setDateDebutSession(?\DateTimeInterface $dateDebutSession): self
    {
        $this->dateDebutSession = $dateDebutSession;

        return $this;
    }

    public function getDateFinSession(): ?\DateTimeInterface
    {
        return $this->dateFinSession;
    }

    public function setDateFinSession(?\DateTimeInterface $dateFinSession): self
    {
        $this->dateFinSession = $dateFinSession;

        return $this;
    }

    public function getSyntheseSessionOuverture(): ?string
    {
        return $this->syntheseSessionOuverture;
    }

    public function setSyntheseSessionOuverture(?string $syntheseSessionOuverture): self
    {
        $this->syntheseSessionOuverture = $syntheseSessionOuverture;

        return $this;
    }

    public function getHeureDebutSession(): ?\DateTimeInterface
    {
        return $this->heureDebutSession;
    }

    public function setHeureDebutSession(?\DateTimeInterface $heureDebutSession): self
    {
        $this->heureDebutSession = $heureDebutSession;

        return $this;
    }

    public function getHeureFinSessionOuverture(): ?\DateTimeInterface
    {
        return $this->heureFinSessionOuverture;
    }

    public function setHeureFinSessionOuverture(?\DateTimeInterface $heureFinSessionOuverture): self
    {
        $this->heureFinSessionOuverture = $heureFinSessionOuverture;

        return $this;
    }

    public function getHeureDebutSessionFermeture(): ?\DateTimeInterface
    {
        return $this->heureDebutSessionFermeture;
    }

    public function setHeureDebutSessionFermeture(?\DateTimeInterface $heureDebutSessionFermeture): self
    {
        $this->heureDebutSessionFermeture = $heureDebutSessionFermeture;

        return $this;
    }

    public function getHeureFinSessionFermeture(): ?\DateTimeInterface
    {
        return $this->heureFinSessionFermeture;
    }

    public function setHeureFinSessionFermeture(?\DateTimeInterface $heureFinSessionFermeture): self
    {
        $this->heureFinSessionFermeture = $heureFinSessionFermeture;

        return $this;
    }

    public function getSyntheseFermeture(): ?string
    {
        return $this->syntheseFermeture;
    }

    public function setSyntheseFermeture(?string $syntheseFermeture): self
    {
        $this->syntheseFermeture = $syntheseFermeture;

        return $this;
    }

    /**
     * @return Collection|ParticipantCommission[]
     */
    public function getAssociationParticipant(): Collection
    {
        return $this->associationParticipant;
    }

    public function addAssociationParticipant(ParticipantCommission $associationParticipant): self
    {
        if (!$this->associationParticipant->contains($associationParticipant)) {
            $this->associationParticipant[] = $associationParticipant;
            $associationParticipant->setCommission($this);
        }

        return $this;
    }

    public function removeAssociationParticipant(ParticipantCommission $associationParticipant): self
    {
        if ($this->associationParticipant->removeElement($associationParticipant)) {
            // set the owning side to null (unless already changed)
            if ($associationParticipant->getCommission() === $this) {
                $associationParticipant->setCommission(null);
            }
        }

        return $this;
    }
}
