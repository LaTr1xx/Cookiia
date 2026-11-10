<?php

namespace App\Entity;

use App\Enum\CreneauEnum;
use App\Enum\EtatGenerationEnum;
use App\Enum\TailleQuantiteEnum;
use App\Enum\TypeSaveurEnum;
use App\Repository\RepasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RepasRepository::class)]
class Repas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $date_repas = null;

    #[ORM\Column(nullable: true, enumType: CreneauEnum::class)]
    private ?CreneauEnum $creneau = null;

    #[ORM\Column(nullable: true, enumType: TypeSaveurEnum::class)]
    private ?TypeSaveurEnum $preference_repas = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $temps_disponible = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $nombre_personnes = null;

    #[ORM\Column(nullable: true, enumType: EtatGenerationEnum::class)]
    private ?EtatGenerationEnum $etat_generation = null;

    #[ORM\Column(nullable: true, enumType: TailleQuantiteEnum::class)]
    private ?TailleQuantiteEnum $taille_quantite = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\ManyToOne(inversedBy: 'repasList')]
    private ?Planning $planning = null;

    #[ORM\ManyToOne(inversedBy: 'repasList')]
    private ?Recette $recette = null;

    /**
     * @var Collection<int, Profil>
     */
    #[ORM\ManyToMany(targetEntity: Profil::class, inversedBy: 'repasList')]
    private Collection $profils;

    public function __construct()
    {
        $this->profils = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRepas(): ?\DateTime
    {
        return $this->date_repas;
    }

    public function setDateRepas(?\DateTime $date_repas): static
    {
        $this->date_repas = $date_repas;

        return $this;
    }

    public function getCreneau(): ?CreneauEnum
    {
        return $this->creneau;
    }

    public function setCreneau(?CreneauEnum $creneau): static
    {
        $this->creneau = $creneau;

        return $this;
    }

    public function getPreferenceRepas(): ?TypeSaveurEnum
    {
        return $this->preference_repas;
    }

    public function setPreferenceRepas(?TypeSaveurEnum $preference_repas): static
    {
        $this->preference_repas = $preference_repas;

        return $this;
    }

    public function getTempsDisponible(): ?int
    {
        return $this->temps_disponible;
    }

    public function setTempsDisponible(?int $temps_disponible): static
    {
        $this->temps_disponible = $temps_disponible;

        return $this;
    }

    public function getNombrePersonnes(): ?int
    {
        return $this->nombre_personnes;
    }

    public function setNombrePersonnes(?int $nombre_personnes): static
    {
        $this->nombre_personnes = $nombre_personnes;

        return $this;
    }

    public function getEtatGeneration(): ?EtatGenerationEnum
    {
        return $this->etat_generation;
    }

    public function setEtatGeneration(?EtatGenerationEnum $etat_generation): static
    {
        $this->etat_generation = $etat_generation;

        return $this;
    }

    public function getTailleQuantite(): ?TailleQuantiteEnum
    {
        return $this->taille_quantite;
    }

    public function setTailleQuantite(?TailleQuantiteEnum $taille_quantite): static
    {
        $this->taille_quantite = $taille_quantite;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

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

    public function getRecette(): ?Recette
    {
        return $this->recette;
    }

    public function setRecette(?Recette $recette): static
    {
        $this->recette = $recette;

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
        }

        return $this;
    }

    public function removeProfil(Profil $profil): static
    {
        $this->profils->removeElement($profil);

        return $this;
    }
}
