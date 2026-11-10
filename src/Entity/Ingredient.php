<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $calories_100g = null;

    /**
     * @var Collection<int, ArticleCourse>
     */
    #[ORM\OneToMany(targetEntity: ArticleCourse::class, mappedBy: 'ingredient')]
    private Collection $articleCourses;

    /**
     * @var Collection<int, RecetteIngredient>
     */
    #[ORM\OneToMany(targetEntity: RecetteIngredient::class, mappedBy: 'ingredient')]
    private Collection $recetteIngredients;

    /**
     * @var Collection<int, AllergieRestriction>
     */
    #[ORM\ManyToMany(targetEntity: AllergieRestriction::class, inversedBy: 'ingredients')]
    private Collection $allergies;

    public function __construct()
    {
        $this->articleCourses = new ArrayCollection();
        $this->recetteIngredients = new ArrayCollection();
        $this->allergies = new ArrayCollection();
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

    public function getCalories100g(): ?string
    {
        return $this->calories_100g;
    }

    public function setCalories100g(?string $calories_100g): static
    {
        $this->calories_100g = $calories_100g;

        return $this;
    }

    /**
     * @return Collection<int, ArticleCourse>
     */
    public function getArticleCourses(): Collection
    {
        return $this->articleCourses;
    }

    public function addArticleCourse(ArticleCourse $articleCourse): static
    {
        if (!$this->articleCourses->contains($articleCourse)) {
            $this->articleCourses->add($articleCourse);
            $articleCourse->setIngredient($this);
        }

        return $this;
    }

    public function removeArticleCourse(ArticleCourse $articleCourse): static
    {
        if ($this->articleCourses->removeElement($articleCourse)) {
            // set the owning side to null (unless already changed)
            if ($articleCourse->getIngredient() === $this) {
                $articleCourse->setIngredient(null);
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
            $recetteIngredient->setIngredient($this);
        }

        return $this;
    }

    public function removeRecetteIngredient(RecetteIngredient $recetteIngredient): static
    {
        if ($this->recetteIngredients->removeElement($recetteIngredient)) {
            // set the owning side to null (unless already changed)
            if ($recetteIngredient->getIngredient() === $this) {
                $recetteIngredient->setIngredient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AllergieRestriction>
     */
    public function getAllergies(): Collection
    {
        return $this->allergies;
    }

    public function addAllergy(AllergieRestriction $allergy): static
    {
        if (!$this->allergies->contains($allergy)) {
            $this->allergies->add($allergy);
        }

        return $this;
    }

    public function removeAllergy(AllergieRestriction $allergy): static
    {
        $this->allergies->removeElement($allergy);

        return $this;
    }
}
