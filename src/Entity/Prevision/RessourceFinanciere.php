<?php

namespace App\Entity\Prevision;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Operations\Imputation;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\Prevision\RessourceFinanciereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     shortName= "ressources",
 *
 *     itemOperations={
 *                  "get"={"openapi_context"={"summary"="Affiche les informations d'une ressource "}},
 *     "delete"={"openapi_context"={"summary"="Supprime une ressource"}},
 *     "put"={"openapi_context"={"summary"="Modifie les informations une ressource"}},
 *
 *     "desactiver"= {
 *     "method"="patch", "path"="/ressources/desactive/{id}", "controller"="App\Controller\DesactiveRessourceController",
 *     "input_formats"={"json"={"application/vnd.api+json","application/merge-patch+json","application/json","application/ld+json"}},
 * "denormalization_context"={"groups"={"desactive:write"}},
 *       "validation_groups"={"desactive"},
"openapi_context"={"summary"="desactive une ressource actualiser"},
 *                 },
 *
 *   },
 * collectionOperations={
 *                      "get"={ "order"={"id"="DESC"},
 *                              "openapi_context"={"summary"="Affiche les informations des registres"},
 *     }
 *                               ,"inscription"={ "method"="post", "path"="/ressources/inscription",
 *     "openapi_context"={"summary"="Crée une ressource"},},
 *
 *     "actualisation"={"method"="post","path"="/ressources/actualise","openapi_context"={"summary"="Actualise une ressource"},
 *     "denormalization_context"={"groups"={"actualise:write"}, "disable_type_enforcement"=true},
 *       "validation_groups"={"actualise"}
 *     }
 *
 * },
 *
 * normalizationContext={
 *                       "groups"={"ressource_detail:read"}, "openapi_definition_name"= "Read"
 * },
 * denormalizationContext={
 *                        "groups"={"ressource_detail:write"}, "openapi_definition_name"= "Write",
 *     "disable_type_enforcement"=true
 * },
 *     subresourceOperations={}
 * )
 * @ORM\Entity(repositoryClass=RessourceFinanciereRepository::class)
 */
class RessourceFinanciere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"ressource_detail:read","actifressource:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"ressource_detail:read","ressource_detail:write","actualise:write","bailleurs_detail:read","actifressource:read"})
     */
    private $objetFinancement;

    /**
     * @ORM\Column(type="string", length=100)
     *  @Groups({"ressource_detail:read","ressource_detail:write","actualise:write","actifressource:read"})
     */
    private $modeFinancement;

    /**
     * @ORM\Column(type="float")
     *  @Groups({"ressource_detail:read","ressource_detail:write","actualise:write","actifressource:read"})
     * @Assert\Type(type="numeric",message="veuillez entrer une somme correct")
     */
    private $montantFinancement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups({"ressource_detail:read","ressource_detail:write","actualise:write"})
     */
    private $descriptionFinancement;

    /**
     * @ORM\ManyToOne(targetEntity=ExerciceRegistre::class, inversedBy="associationRessource")
     * @ORM\JoinColumn(nullable=false)
     *  @Groups({"ressource_detail:read","ressource_detail:write","actualise:write"})
     */
    private $exerciceRegistre;

    /**
     * @ORM\ManyToOne(targetEntity=BailleurFonds::class, inversedBy="associationRessource")
     * @ORM\JoinColumn(nullable=false)
     *  @Groups({"ressource_detail:read","ressource_detail:write","actualise:write"})
     */
    private $bailleurFonds;

    /**
     * @ORM\OneToMany(targetEntity=CreditOuvert::class, mappedBy="ressourceFinanciere", orphanRemoval=true)
     * @Groups({"ressource_detail:read","bailleurs_detail:read"})
     *
     */
    private $associationCredit;

    /**
     * @ORM\OneToMany(targetEntity=Imputation::class, mappedBy="ressourceFinanciere", orphanRemoval=true)
     * @Groups({"ressource_detail:read"})
     */
    private $associationImputation;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"ressource_detail:read","desactive:write"})
     * @Assert\NotNull(groups={"desactive"})
     * @Groups({"actifressource:read"})
     */
    private $estValide= true;

    /**
     * @ORM\ManyToOne(targetEntity=StatutRegistre::class, inversedBy="associationRessource")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"ressource_detail:read","ressource_detail:write","actualise:write","actifressource:read"})
     */
    private $statutRegistre;

    /**
     * @ORM\OneToOne(targetEntity=RessourceFinanciere::class, inversedBy="ressourceFinanciere", cascade={"persist", "remove"})
     * @Groups({"ressource_detail:read","actualise:write"})
     */
    private $actualiseRessource;

    /**
     * @ORM\OneToOne(targetEntity=RessourceFinanciere::class, mappedBy="actualiseRessource", cascade={"persist", "remove"})
     *
     */
    private $ressourceFinanciere;

    public function __construct()
    {
        $this->associationCredit = new ArrayCollection();
        $this->associationImputation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjetFinancement(): ?string
    {
        return $this->objetFinancement;
    }

    public function setObjetFinancement(string $objetFinancement): self
    {
        $this->objetFinancement = $objetFinancement;

        return $this;
    }

    public function getModeFinancement(): ?string
    {
        return $this->modeFinancement;
    }

    public function setModeFinancement(string $modeFinancement): self
    {
        $this->modeFinancement = $modeFinancement;

        return $this;
    }

    public function getMontantFinancement(): ?float
    {
        return $this->montantFinancement;
    }

    public function setMontantFinancement($montantFinancement): self
    {
        $this->montantFinancement = $montantFinancement;

        return $this;
    }

    public function getDescriptionFinancement(): ?string
    {
        return $this->descriptionFinancement;
    }

    public function setDescriptionFinancement(?string $descriptionFinancement): self
    {
        $this->descriptionFinancement = $descriptionFinancement;

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

    public function getBailleurFonds(): ?BailleurFonds
    {
        return $this->bailleurFonds;
    }

    public function setBailleurFonds(?BailleurFonds $bailleurFonds): self
    {
        $this->bailleurFonds = $bailleurFonds;

        return $this;
    }

    /**
     * @return Collection|CreditOuvert[]
     */
    public function getAssociationCredit(): Collection
    {
        return $this->associationCredit;
    }

    public function addAssociationCredit(CreditOuvert $associationCredit): self
    {
        if (!$this->associationCredit->contains($associationCredit)) {
            $this->associationCredit[] = $associationCredit;
            $associationCredit->setRessourceFinanciere($this);
        }

        return $this;
    }

    public function removeAssociationCredit(CreditOuvert $associationCredit): self
    {
        if ($this->associationCredit->removeElement($associationCredit)) {
            // set the owning side to null (unless already changed)
            if ($associationCredit->getRessourceFinanciere() === $this) {
                $associationCredit->setRessourceFinanciere(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection|Imputation[]
     */
    public function getAssociationImputation(): Collection
    {
        return $this->associationImputation;
    }

    public function addAssociationImputation(Imputation $associationImputation): self
    {
        if (!$this->associationImputation->contains($associationImputation)) {
            $this->associationImputation[] = $associationImputation;
            $associationImputation->setRessourceFinanciere($this);
        }

        return $this;
    }

    public function removeAssociationImputation(Imputation $associationImputation): self
    {
        if ($this->associationImputation->removeElement($associationImputation)) {
            // set the owning side to null (unless already changed)
            if ($associationImputation->getRessourceFinanciere() === $this) {
                $associationImputation->setRessourceFinanciere(null);
            }
        }

        return $this;
    }

    public function getEstValide(): ?bool
    {
        return $this->estValide;
    }

    public function setEstValide(bool $estValide): self
    {
        $this->estValide = $estValide;

        return $this;
    }

    public function getStatutRegistre(): ?StatutRegistre
    {
        return $this->statutRegistre;
    }

    public function setStatutRegistre(?StatutRegistre $statutRegistre): self
    {
        $this->statutRegistre = $statutRegistre;

        return $this;
    }

    public function getActualiseRessource(): ?self
    {
        return $this->actualiseRessource;
    }

    public function setActualiseRessource(?self $actualiseRessource): self
    {
        $this->actualiseRessource = $actualiseRessource;

        return $this;
    }

    public function getRessourceFinanciere(): ?self
    {
        return $this->ressourceFinanciere;
    }

    public function setRessourceFinanciere(?self $ressourceFinanciere): self
    {
        // unset the owning side of the relation if necessary
        if ($ressourceFinanciere === null && $this->ressourceFinanciere !== null) {
            $this->ressourceFinanciere->setActualiseRessource(null);
        }

        // set the owning side of the relation if necessary
        if ($ressourceFinanciere !== null && $ressourceFinanciere->getActualiseRessource() !== $this) {
            $ressourceFinanciere->setActualiseRessource($this);
        }

        $this->ressourceFinanciere = $ressourceFinanciere;

        return $this;
    }
}
