<?php

namespace App\Entity;

use App\Repository\UniteMesureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UniteMesureRepository::class)]
class UniteMesure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $abreviation = null;

    /**
     * @var Collection<int, ArticleCourse>
     */
    #[ORM\OneToMany(targetEntity: ArticleCourse::class, mappedBy: 'unite')]
    private Collection $articleCourses;

    /**
     * @var Collection<int, RecetteIngredient>
     */
    #[ORM\OneToMany(targetEntity: RecetteIngredient::class, mappedBy: 'unite')]
    private Collection $recetteIngredients;

    public function __construct()
    {
        $this->articleCourses = new ArrayCollection();
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

    public function getAbreviation(): ?string
    {
        return $this->abreviation;
    }

    public function setAbreviation(?string $abreviation): static
    {
        $this->abreviation = $abreviation;

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
            $articleCourse->setUnite($this);
        }

        return $this;
    }

    public function removeArticleCourse(ArticleCourse $articleCourse): static
    {
        if ($this->articleCourses->removeElement($articleCourse)) {
            // set the owning side to null (unless already changed)
            if ($articleCourse->getUnite() === $this) {
                $articleCourse->setUnite(null);
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
            $recetteIngredient->setUnite($this);
        }

        return $this;
    }

    public function removeRecetteIngredient(RecetteIngredient $recetteIngredient): static
    {
        if ($this->recetteIngredients->removeElement($recetteIngredient)) {
            // set the owning side to null (unless already changed)
            if ($recetteIngredient->getUnite() === $this) {
                $recetteIngredient->setUnite(null);
            }
        }

        return $this;
    }
}
