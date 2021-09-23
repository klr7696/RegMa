<?php

namespace App\Entity\Prevision;

use App\Repository\Prevision\AllocationCreditRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AllocationCreditRepository::class)
 */
class AllocationCredit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $montantAllouer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptionAllocation;

    /**
     * @ORM\ManyToOne(targetEntity=CreditOuvert::class, inversedBy="associationAllocation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $creditOuvert;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantAllouer(): ?float
    {
        return $this->montantAllouer;
    }

    public function setMontantAllouer(float $montantAllouer): self
    {
        $this->montantAllouer = $montantAllouer;

        return $this;
    }

    public function getDescriptionAllocation(): ?string
    {
        return $this->descriptionAllocation;
    }

    public function setDescriptionAllocation(?string $descriptionAllocation): self
    {
        $this->descriptionAllocation = $descriptionAllocation;

        return $this;
    }

    public function getCreditOuvert(): ?CreditOuvert
    {
        return $this->creditOuvert;
    }

    public function setCreditOuvert(?CreditOuvert $creditOuvert): self
    {
        $this->creditOuvert = $creditOuvert;

        return $this;
    }
}
