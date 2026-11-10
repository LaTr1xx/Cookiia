<?php

namespace App\Entity;

use App\Enum\RoleGroupeEnum;
use App\Repository\GroupeMembreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeMembreRepository::class)]
class GroupeMembre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true, enumType: RoleGroupeEnum::class)]
    private ?RoleGroupeEnum $role = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $date_adhesion = null;

    #[ORM\ManyToOne(inversedBy: 'groupeMembres')]
    private ?Groupe $groupe = null;

    #[ORM\ManyToOne(inversedBy: 'groupeMembres')]
    private ?Utilisateur $utilisateur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?RoleGroupeEnum
    {
        return $this->role;
    }

    public function setRole(?RoleGroupeEnum $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getDateAdhesion(): ?\DateTime
    {
        return $this->date_adhesion;
    }

    public function setDateAdhesion(?\DateTime $date_adhesion): static
    {
        $this->date_adhesion = $date_adhesion;

        return $this;
    }

    public function getGroupe(): ?Groupe
    {
        return $this->groupe;
    }

    public function setGroupe(?Groupe $groupe): static
    {
        $this->groupe = $groupe;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
