<?php

namespace App\Entity\Commissions;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Commissions\MembreCommissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     shortName= "membres"
 * )
 * @ORM\Entity(repositoryClass=MembreCommissionRepository::class)
 */
class MembreCommission
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
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomMembre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $serviceMembre;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $fonctionService;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contact;

    /**
     * @ORM\OneToMany(targetEntity=ParticipantCommission::class, mappedBy="membreCommission", orphanRemoval=true)
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

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(?string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getNomMembre(): ?string
    {
        return $this->nomMembre;
    }

    public function setNomMembre(string $nomMembre): self
    {
        $this->nomMembre = $nomMembre;

        return $this;
    }

    public function getServiceMembre(): ?string
    {
        return $this->serviceMembre;
    }

    public function setServiceMembre(string $serviceMembre): self
    {
        $this->serviceMembre = $serviceMembre;

        return $this;
    }

    public function getFonctionService(): ?string
    {
        return $this->fonctionService;
    }

    public function setFonctionService(?string $fonctionService): self
    {
        $this->fonctionService = $fonctionService;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(?string $contact): self
    {
        $this->contact = $contact;

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
            $associationParticipant->setMembreCommission($this);
        }

        return $this;
    }

    public function removeAssociationParticipant(ParticipantCommission $associationParticipant): self
    {
        if ($this->associationParticipant->removeElement($associationParticipant)) {
            // set the owning side to null (unless already changed)
            if ($associationParticipant->getMembreCommission() === $this) {
                $associationParticipant->setMembreCommission(null);
            }
        }

        return $this;
    }
}
