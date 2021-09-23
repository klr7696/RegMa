<?php

namespace App\Entity\Commissions;

use App\Repository\Commissions\ParticipantCommissionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParticipantCommissionRepository::class)
 */
class ParticipantCommission
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
    private $fonctionParticipant;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estpresent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $serviceRepresente;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=MembreCommission::class, inversedBy="associationParticipant")
     * @ORM\JoinColumn(nullable=false)
     */
    private $membreCommission;

    /**
     * @ORM\ManyToOne(targetEntity=Commission::class, inversedBy="associationParticipant")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commission;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFonctionParticipant(): ?string
    {
        return $this->fonctionParticipant;
    }

    public function setFonctionParticipant(string $fonctionParticipant): self
    {
        $this->fonctionParticipant = $fonctionParticipant;

        return $this;
    }

    public function getEstpresent(): ?bool
    {
        return $this->estpresent;
    }

    public function setEstpresent(bool $estpresent): self
    {
        $this->estpresent = $estpresent;

        return $this;
    }

    public function getServiceRepresente(): ?string
    {
        return $this->serviceRepresente;
    }

    public function setServiceRepresente(string $serviceRepresente): self
    {
        $this->serviceRepresente = $serviceRepresente;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMembreCommission(): ?MembreCommission
    {
        return $this->membreCommission;
    }

    public function setMembreCommission(?MembreCommission $membreCommission): self
    {
        $this->membreCommission = $membreCommission;

        return $this;
    }

    public function getCommission(): ?Commission
    {
        return $this->commission;
    }

    public function setCommission(?Commission $commission): self
    {
        $this->commission = $commission;

        return $this;
    }
}
