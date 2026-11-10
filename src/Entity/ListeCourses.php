<?php

namespace App\Entity;

use App\Repository\ListeCoursesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListeCoursesRepository::class)]
class ListeCourses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $date_creation = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $date_modification = null;

    #[ORM\OneToOne(inversedBy: 'listeCourses', cascade: ['persist', 'remove'])]
    private ?Planning $planning = null;

    /**
     * @var Collection<int, ArticleCourse>
     */
    #[ORM\OneToMany(targetEntity: ArticleCourse::class, mappedBy: 'listeCourses')]
    private Collection $articleCourses;

    public function __construct()
    {
        $this->articleCourses = new ArrayCollection();
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

    public function getPlanning(): ?Planning
    {
        return $this->planning;
    }

    public function setPlanning(?Planning $planning): static
    {
        $this->planning = $planning;

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
            $articleCourse->setListeCourses($this);
        }

        return $this;
    }

    public function removeArticleCourse(ArticleCourse $articleCourse): static
    {
        if ($this->articleCourses->removeElement($articleCourse)) {
            // set the owning side to null (unless already changed)
            if ($articleCourse->getListeCourses() === $this) {
                $articleCourse->setListeCourses(null);
            }
        }

        return $this;
    }
}
