<?php

namespace App\Entity;

use App\Enum\OrigineRecetteEnum;
use App\Enum\TypeRepasEnum;
use App\Enum\TypeSaveurEnum;
use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
class Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $instructions = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $temps_preparation = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $temps_cuisson = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $nombre_portions = null;

    #[ORM\Column(nullable: true, enumType: TypeRepasEnum::class)]
    private ?TypeRepasEnum $type_repas = null;

    #[ORM\Column(nullable: true, enumType: TypeSaveurEnum::class)]
    private ?TypeSaveurEnum $type_saveur = null;

    #[ORM\Column(nullable: true, enumType: OrigineRecetteEnum::class)]
    private ?OrigineRecetteEnum $origine = null;

    #[ORM\Column(nullable: true)]
    private ?bool $est_transportable = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_url = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $date_creation = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $date_modification = null;

    #[ORM\ManyToOne(inversedBy: 'recettes')]
    private ?Utilisateur $createur = null;

    /**
     * @var Collection<int, RegimeAlimentaire>
     */
    #[ORM\ManyToMany(targetEntity: RegimeAlimentaire::class, inversedBy: 'recettes')]
    private Collection $regimes;

    /**
     * @var Collection<int, Repas>
     */
    #[ORM\OneToMany(targetEntity: Repas::class, mappedBy: 'recette')]
    private Collection $repasList;

    /**
     * @var Collection<int, RecetteIngredient>
     */
    #[ORM\OneToMany(targetEntity: RecetteIngredient::class, mappedBy: 'recette')]
    private Collection $recetteIngredients;

    public function __construct()
    {
        $this->regimes = new ArrayCollection();
        $this->repasList = new ArrayCollection();
        $this->recetteIngredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getInstructions(): ?string
    {
        return $this->instructions;
    }

    public function setInstructions(?string $instructions): static
    {
        $this->instructions = $instructions;

        return $this;
    }

    public function getTempsPreparation(): ?int
    {
        return $this->temps_preparation;
    }

    public function setTempsPreparation(?int $temps_preparation): static
    {
        $this->temps_preparation = $temps_preparation;

        return $this;
    }

    public function getTempsCuisson(): ?int
    {
        return $this->temps_cuisson;
    }

    public function setTempsCuisson(?int $temps_cuisson): static
    {
        $this->temps_cuisson = $temps_cuisson;

        return $this;
    }

    public function getNombrePortions(): ?int
    {
        return $this->nombre_portions;
    }

    public function setNombrePortions(?int $nombre_portions): static
    {
        $this->nombre_portions = $nombre_portions;

        return $this;
    }

    public function getTypeRepas(): ?TypeRepasEnum
    {
        return $this->type_repas;
    }

    public function setTypeRepas(?TypeRepasEnum $type_repas): static
    {
        $this->type_repas = $type_repas;

        return $this;
    }

    public function getTypeSaveur(): ?TypeSaveurEnum
    {
        return $this->type_saveur;
    }

    public function setTypeSaveur(?TypeSaveurEnum $type_saveur): static
    {
        $this->type_saveur = $type_saveur;

        return $this;
    }

    public function getOrigine(): ?OrigineRecetteEnum
    {
        return $this->origine;
    }

    public function setOrigine(?OrigineRecetteEnum $origine): static
    {
        $this->origine = $origine;

        return $this;
    }

    public function isEstTransportable(): ?bool
    {
        return $this->est_transportable;
    }

    public function setEstTransportable(?bool $est_transportable): static
    {
        $this->est_transportable = $est_transportable;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(?string $image_url): static
    {
        $this->image_url = $image_url;

        return $this;
    }

    public function getDateCreation(): ?\DateTime
    {
        return $this->date_creation;
    }

    public function setDateCreation(?\DateTime $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getDateModification(): ?\DateTime
    {
        return $this->date_modification;
    }

    public function setDateModification(?\DateTime $date_modification): static
    {
        $this->date_modification = $date_modification;

        return $this;
    }

    public function getCreateur(): ?Utilisateur
    {
        return $this->createur;
    }

    public function setCreateur(?Utilisateur $createur): static
    {
        $this->createur = $createur;

        return $this;
    }

    /**
     * @return Collection<int, RegimeAlimentaire>
     */
    public function getRegimes(): Collection
    {
        return $this->regimes;
    }

    public function addRegime(RegimeAlimentaire $regime): static
    {
        if (!$this->regimes->contains($regime)) {
            $this->regimes->add($regime);
        }

        return $this;
    }

    public function removeRegime(RegimeAlimentaire $regime): static
    {
        $this->regimes->removeElement($regime);

        return $this;
    }

    /**
     * @return Collection<int, Repas>
     */
    public function getRepasList(): Collection
    {
        return $this->repasList;
    }

    public function addRepasList(Repas $repasList): static
    {
        if (!$this->repasList->contains($repasList)) {
            $this->repasList->add($repasList);
            $repasList->setRecette($this);
        }

        return $this;
    }

    public function removeRepasList(Repas $repasList): static
    {
        if ($this->repasList->removeElement($repasList)) {
            // set the owning side to null (unless already changed)
            if ($repasList->getRecette() === $this) {
                $repasList->setRecette(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RecetteIngredient>
     */
    public function getRecetteIngredients(): Collection
    {
        return $this->recetteIngredients;
    }

    public function addRecetteIngredient(RecetteIngredient $recetteIngredient): static
    {
        if (!$this->recetteIngredients->contains($recetteIngredient)) {
            $this->recetteIngredients->add($recetteIngredient);
            $recetteIngredient->setRecette($this);
        }

        return $this;
    }

    public function removeRecetteIngredient(RecetteIngredient $recetteIngredient): static
    {
        if ($this->recetteIngredients->removeElement($recetteIngredient)) {
            // set the owning side to null (unless already changed)
            if ($recetteIngredient->getRecette() === $this) {
                $recetteIngredient->setRecette(null);
            }
        }

        return $this;
    }
}
