<?php

namespace App\Entity;

use App\Enum\CategorieProfilEnum;
use App\Enum\SexeEnum;
use App\Repository\ProfilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfilRepository::class)]
class Profil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $date_naissance = null;

    #[ORM\Column(nullable: true, enumType: CategorieProfilEnum::class)]
    private ?CategorieProfilEnum $categorie = null;

    #[ORM\Column(nullable: true, enumType: SexeEnum::class)]
    private ?SexeEnum $sexe = null;

    #[ORM\ManyToOne(inversedBy: 'profils')]
    private ?Utilisateur $utilisateur = null;

    /**
     * @var Collection<int, RegimeAlimentaire>
     */
    #[ORM\ManyToMany(targetEntity: RegimeAlimentaire::class, inversedBy: 'profils')]
    private Collection $regimes;

    /**
     * @var Collection<int, AllergieRestriction>
     */
    #[ORM\ManyToMany(targetEntity: AllergieRestriction::class, inversedBy: 'profils')]
    private Collection $allergies;

    /**
     * @var Collection<int, Repas>
     */
    #[ORM\ManyToMany(targetEntity: Repas::class, mappedBy: 'profils')]
    private Collection $repasList;

    public function __construct()
    {
        $this->regimes = new ArrayCollection();
        $this->allergies = new ArrayCollection();
        $this->repasList = new ArrayCollection();
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

    public function getDateNaissance(): ?\DateTime
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(?\DateTime $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getCategorie(): ?CategorieProfilEnum
    {
        return $this->categorie;
    }

    public function setCategorie(?CategorieProfilEnum $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getSexe(): ?SexeEnum
    {
        return $this->sexe;
    }

    public function setSexe(?SexeEnum $sexe): static
    {
        $this->sexe = $sexe;

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

    /**
     * @return Collection<int, RegimeAlimentaire>
     */
    public function getRegimes(): Collection
    {
        return $this->regimes;
    }

    public function addRegime(RegimeAlimentaire $regime): static
    {
        if (!$this->regimes->contains($regime)) {
            $this->regimes->add($regime);
        }

        return $this;
    }

    public function removeRegime(RegimeAlimentaire $regime): static
    {
        $this->regimes->removeElement($regime);

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
            $repasList->addProfil($this);
        }

        return $this;
    }

    public function removeRepasList(Repas $repasList): static
    {
        if ($this->repasList->removeElement($repasList)) {
            $repasList->removeProfil($this);
        }

        return $this;
    }
}
