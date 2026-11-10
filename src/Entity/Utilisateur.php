<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mot_de_passe = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $date_inscription = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $date_derniere_connexion = null;

    #[ORM\Column(nullable: true)]
    private ?bool $actif = null;

    /**
     * @var Collection<int, Profil>
     */
    #[ORM\OneToMany(targetEntity: Profil::class, mappedBy: 'utilisateur')]
    private Collection $profils;

    /**
     * @var Collection<int, Recette>
     */
    #[ORM\OneToMany(targetEntity: Recette::class, mappedBy: 'createur')]
    private Collection $recettes;

    /**
     * @var Collection<int, Planning>
     */
    #[ORM\OneToMany(targetEntity: Planning::class, mappedBy: 'createur')]
    private Collection $plannings;

    /**
     * @var Collection<int, Groupe>
     */
    #[ORM\OneToMany(targetEntity: Groupe::class, mappedBy: 'createur')]
    private Collection $groupe_crees;

    /**
     * @var Collection<int, GroupeMembre>
     */
    #[ORM\OneToMany(targetEntity: GroupeMembre::class, mappedBy: 'utilisateur')]
    private Collection $groupeMembres;

    public function __construct()
    {
        $this->profils = new ArrayCollection();
        $this->recettes = new ArrayCollection();
        $this->plannings = new ArrayCollection();
        $this->groupe_crees = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->mot_de_passe;
    }

    public function setMotDePasse(?string $mot_de_passe): static
    {
        $this->mot_de_passe = $mot_de_passe;

        return $this;
    }

    public function getDateInscription(): ?\DateTime
    {
        return $this->date_inscription;
    }

    public function setDateInscription(?\DateTime $date_inscription): static
    {
        $this->date_inscription = $date_inscription;

        return $this;
    }

    public function getDateDerniereConnexion(): ?\DateTime
    {
        return $this->date_derniere_connexion;
    }

    public function setDateDerniereConnexion(?\DateTime $date_derniere_connexion): static
    {
        $this->date_derniere_connexion = $date_derniere_connexion;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(?bool $actif): static
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * @return Collection<int, Profil>
     */
    public function getProfils(): Collection
    {
        return $this->profils;
    }

    public function addProfil(Profil $profil): static
    {
        if (!$this->profils->contains($profil)) {
            $this->profils->add($profil);
            $profil->setUtilisateur($this);
        }

        return $this;
    }

    public function removeProfil(Profil $profil): static
    {
        if ($this->profils->removeElement($profil)) {
            // set the owning side to null (unless already changed)
            if ($profil->getUtilisateur() === $this) {
                $profil->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Recette>
     */
    public function getRecettes(): Collection
    {
        return $this->recettes;
    }

    public function addRecette(Recette $recette): static
    {
        if (!$this->recettes->contains($recette)) {
            $this->recettes->add($recette);
            $recette->setCreateur($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): static
    {
        if ($this->recettes->removeElement($recette)) {
            // set the owning side to null (unless already changed)
            if ($recette->getCreateur() === $this) {
                $recette->setCreateur(null);
            }
        }

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
            $planning->setCreateur($this);
        }

        return $this;
    }

    public function removePlanning(Planning $planning): static
    {
        if ($this->plannings->removeElement($planning)) {
            // set the owning side to null (unless already changed)
            if ($planning->getCreateur() === $this) {
                $planning->setCreateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Groupe>
     */
    public function getGroupeCrees(): Collection
    {
        return $this->groupe_crees;
    }

    public function addGroupeCree(Groupe $groupeCree): static
    {
        if (!$this->groupe_crees->contains($groupeCree)) {
            $this->groupe_crees->add($groupeCree);
            $groupeCree->setCreateur($this);
        }

        return $this;
    }

    public function removeGroupeCree(Groupe $groupeCree): static
    {
        if ($this->groupe_crees->removeElement($groupeCree)) {
            // set the owning side to null (unless already changed)
            if ($groupeCree->getCreateur() === $this) {
                $groupeCree->setCreateur(null);
            }
        }

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
            $groupeMembre->setUtilisateur($this);
        }

        return $this;
    }

    public function removeGroupeMembre(GroupeMembre $groupeMembre): static
    {
        if ($this->groupeMembres->removeElement($groupeMembre)) {
            // set the owning side to null (unless already changed)
            if ($groupeMembre->getUtilisateur() === $this) {
                $groupeMembre->setUtilisateur(null);
            }
        }

        return $this;
    }
}
