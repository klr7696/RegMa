<?php

namespace App\Entity\Contrats;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Contrats\ItemCommandeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     shortName= "items",
 *     denormalizationContext={"disable_type_enforcement"=true}
 * )
 * @ORM\Entity(repositoryClass=ItemCommandeRepository::class)
 */
class ItemCommande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $designationItem;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $uniteItem;

    /**
     * @ORM\Column(type="float")
     * @Assert\Type(type="numeric",message="incorrect")
     */
    private $prixUnitaireItem;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type(type="numeric",message="incorrect")
     */
    private $quantiteItem;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estConforme;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionItem;

    /**
     * @ORM\ManyToOne(targetEntity=BonCommande::class, inversedBy="assoiciationItem")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bonCommande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignationItem(): ?string
    {
        return $this->designationItem;
    }

    public function setDesignationItem(string $designationItem): self
    {
        $this->designationItem = $designationItem;

        return $this;
    }

    public function getUniteItem(): ?string
    {
        return $this->uniteItem;
    }

    public function setUniteItem(?string $uniteItem): self
    {
        $this->uniteItem = $uniteItem;

        return $this;
    }

    public function getPrixUnitaireItem(): ?float
    {
        return $this->prixUnitaireItem;
    }

    public function setPrixUnitaireItem($prixUnitaireItem): self
    {
        $this->prixUnitaireItem = $prixUnitaireItem;

        return $this;
    }

    public function getQuantiteItem(): ?int
    {
        return $this->quantiteItem;
    }

    public function setQuantiteItem($quantiteItem): self
    {
        $this->quantiteItem = $quantiteItem;

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

    public function getDescriptionItem(): ?string
    {
        return $this->descriptionItem;
    }

    public function setDescriptionItem(?string $descriptionItem): self
    {
        $this->descriptionItem = $descriptionItem;

        return $this;
    }

    public function getBonCommande(): ?BonCommande
    {
        return $this->bonCommande;
    }

    public function setBonCommande(?BonCommande $bonCommande): self
    {
        $this->bonCommande = $bonCommande;

        return $this;
    }
}
