<?php

namespace App\Entity;

use App\Repository\RecetteIngredientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetteIngredientRepository::class)]
class RecetteIngredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'recetteIngredients')]
    private ?Recette $recette = null;

    #[ORM\ManyToOne(inversedBy: 'recetteIngredients')]
    private ?Ingredient $ingredient = null;

    #[ORM\ManyToOne(inversedBy: 'recetteIngredients')]
    private ?UniteMesure $unite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(?string $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getRecette(): ?Recette
    {
        return $this->recette;
    }

    public function setRecette(?Recette $recette): static
    {
        $this->recette = $recette;

        return $this;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): static
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    public function getUnite(): ?UniteMesure
    {
        return $this->unite;
    }

    public function setUnite(?UniteMesure $unite): static
    {
        $this->unite = $unite;

        return $this;
    }
}
