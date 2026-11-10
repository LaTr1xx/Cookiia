<?php

namespace App\Entity;

use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeRepository::class)]
class Groupe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token_partage = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $date_creation = null;

    /**
     * @var Collection<int, Planning>
     */
    #[ORM\ManyToMany(targetEntity: Planning::class, mappedBy: 'groupes')]
    private Collection $plannings;

    #[ORM\ManyToOne(inversedBy: 'groupe_crees')]
    private ?Utilisateur $createur = null;

    /**
     * @var Collection<int, GroupeMembre>
     */
    #[ORM\OneToMany(targetEntity: GroupeMembre::class, mappedBy: 'groupe')]
    private Collection $groupeMembres;

    public function __construct()
    {
        $this->plannings = new ArrayCollection();
        $this->groupeMembres = new ArrayCollection();
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

    public function getTokenPartage(): ?string
    {
        return $this->token_partage;
    }

    public function setTokenPartage(?string $token_partage): static
    {
        $this->token_partage = $token_partage;

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

    /**
     * @return Collection<int, Planning>
     */
    public function getPlannings(): Collection
    {
        return $this->plannings;
    }

    public function addPlanning(Planning $planning): static
    {
        if (!$this->plannings->contains($planning)) {
            $this->plannings->add($planning);
            $planning->addGroupe($this);
        }

        return $this;
    }

    public function removePlanning(Planning $planning): static
    {
        if ($this->plannings->removeElement($planning)) {
            $planning->removeGroupe($this);
        }

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
     * @return Collection<int, GroupeMembre>
     */
    public function getGroupeMembres(): Collection
    {
        return $this->groupeMembres;
    }

    public function addGroupeMembre(GroupeMembre $groupeMembre): static
    {
        if (!$this->groupeMembres->contains($groupeMembre)) {
            $this->groupeMembres->add($groupeMembre);
            $groupeMembre->setGroupe($this);
        }

        return $this;
    }

    public function removeGroupeMembre(GroupeMembre $groupeMembre): static
    {
        if ($this->groupeMembres->removeElement($groupeMembre)) {
            // set the owning side to null (unless already changed)
            if ($groupeMembre->getGroupe() === $this) {
                $groupeMembre->setGroupe(null);
            }
        }

        return $this;
    }
}
