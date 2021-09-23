<?php

namespace App\Entity\Administration;

use App\Repository\Administration\MairieCommunaleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MairieCommunaleRepository::class)
 */
class MairieCommunale
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
    private $designationMairie;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $abbreviationMairie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresseMairie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptionMairie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignationMairie(): ?string
    {
        return $this->designationMairie;
    }

    public function setDesignationMairie(string $designationMairie): self
    {
        $this->designationMairie = $designationMairie;

        return $this;
    }

    public function getAbbreviationMairie(): ?string
    {
        return $this->abbreviationMairie;
    }

    public function setAbbreviationMairie(string $abbreviationMairie): self
    {
        $this->abbreviationMairie = $abbreviationMairie;

        return $this;
    }

    public function getAdresseMairie(): ?string
    {
        return $this->adresseMairie;
    }

    public function setAdresseMairie(string $adresseMairie): self
    {
        $this->adresseMairie = $adresseMairie;

        return $this;
    }

    public function getDescriptionMairie(): ?string
    {
        return $this->descriptionMairie;
    }

    public function setDescriptionMairie(?string $descriptionMairie): self
    {
        $this->descriptionMairie = $descriptionMairie;

        return $this;
    }
}
