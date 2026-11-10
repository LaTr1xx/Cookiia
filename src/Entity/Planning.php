<?php

namespace App\Entity;

use App\Repository\PlanningRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanningRepository::class)]
class Planning
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    private ?bool $est_defaut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $date_debut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $date_fin = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $date_creation = null;

    #[ORM\ManyToOne(inversedBy: 'plannings')]
    private ?Utilisateur $createur = null;

    /**
     * @var Collection<int, Repas>
     */
    #[ORM\OneToMany(targetEntity: Repas::class, mappedBy: 'planning')]
    private Collection $repasList;

    /**
     * @var Collection<int, Groupe>
     */
    #[ORM\ManyToMany(targetEntity: Groupe::class, inversedBy: 'plannings')]
    private Collection $groupes;

    #[ORM\OneToOne(mappedBy: 'planning', cascade: ['persist', 'remove'])]
    private ?ListeCourses $listeCourses = null;

    public function __construct()
    {
        $this->repasList = new ArrayCollection();
        $this->groupes = new ArrayCollection();
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

    public function isEstDefaut(): ?bool
    {
        return $this->est_defaut;
    }

    public function setEstDefaut(?bool $est_defaut): static
    {
        $this->est_defaut = $est_defaut;

        return $this;
    }

    public function getDateDebut(): ?\DateTime
    {
        return $this->date_debut;
    }

    public function setDateDebut(?\DateTime $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTime
    {
        return $this->date_fin;
    }

    public function setDateFin(?\DateTime $date_fin): static
    {
        $this->date_fin = $date_fin;

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
            $repasList->setPlanning($this);
        }

        return $this;
    }

    public function removeRepasList(Repas $repasList): static
    {
        if ($this->repasList->removeElement($repasList)) {
            // set the owning side to null (unless already changed)
            if ($repasList->getPlanning() === $this) {
                $repasList->setPlanning(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Groupe>
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): static
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes->add($groupe);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): static
    {
        $this->groupes->removeElement($groupe);

        return $this;
    }

    public function getListeCourses(): ?ListeCourses
    {
        return $this->listeCourses;
    }

    public function setListeCourses(?ListeCourses $listeCourses): static
    {
        // unset the owning side of the relation if necessary
        if ($listeCourses === null && $this->listeCourses !== null) {
            $this->listeCourses->setPlanning(null);
        }

        // set the owning side of the relation if necessary
        if ($listeCourses !== null && $listeCourses->getPlanning() !== $this) {
            $listeCourses->setPlanning($this);
        }

        $this->listeCourses = $listeCourses;

        return $this;
    }
}
