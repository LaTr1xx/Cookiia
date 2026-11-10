<?php

namespace App\Entity;

use App\Repository\ArticleCourseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleCourseRepository::class)]
class ArticleCourse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $quantite = null;

    #[ORM\Column(nullable: true)]
    private ?bool $est_achete = null;

    #[ORM\ManyToOne(inversedBy: 'articleCourses')]
    private ?ListeCourses $listeCourses = null;

    #[ORM\ManyToOne(inversedBy: 'articleCourses')]
    private ?Ingredient $ingredient = null;

    #[ORM\ManyToOne(inversedBy: 'articleCourses')]
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

    public function isEstAchete(): ?bool
    {
        return $this->est_achete;
    }

    public function setEstAchete(?bool $est_achete): static
    {
        $this->est_achete = $est_achete;

        return $this;
    }

    public function getListeCourses(): ?ListeCourses
    {
        return $this->listeCourses;
    }

    public function setListeCourses(?ListeCourses $listeCourses): static
    {
        $this->listeCourses = $listeCourses;

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
