<?php

namespace App\Entity;

use App\Repository\MotoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotoRepository::class)]
class Moto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $annee = null;

    #[ORM\Column(length: 255)]
    private ?string $couleur = null;

    #[ORM\Column]
    private ?int $prixJour = null;

    #[ORM\Column]
    private ?bool $dispo = null;

    #[ORM\Column(nullable: true)]
    private ?int $nombreNotes = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: 2, nullable: true)]
    private ?string $moyenneNotes = null;

    #[ORM\ManyToOne(inversedBy: 'motos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Modele $modele = null;

    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'moto')]
    private Collection $reservations;

    #[ORM\ManyToOne(inversedBy: 'motos')]
    private ?Proprietaire $proprietaire = null;

    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'moto')]
    private Collection $commentaires;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): static
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getPrixJour(): ?int
    {
        return $this->prixJour;
    }

    public function setPrixJour(int $prixJour): static
    {
        $this->prixJour = $prixJour;

        return $this;
    }

    public function isDispo(): ?bool
    {
        return $this->dispo;
    }

    public function setDispo(bool $dispo): static
    {
        $this->dispo = $dispo;

        return $this;
    }

    public function getNombreNotes(): ?int
    {
        return $this->nombreNotes;
    }

    public function setNombreNotes(?int $nombreNotes): static
    {
        $this->nombreNotes = $nombreNotes;

        return $this;
    }

    public function getMoyenneNotes(): ?string
    {
        return $this->moyenneNotes;
    }

    public function setMoyenneNotes(?string $moyenneNotes): static
    {
        $this->moyenneNotes = $moyenneNotes;

        return $this;
    }

    public function getModele(): ?Modele
    {
        return $this->modele;
    }

    public function setModele(?Modele $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setMoto($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getMoto() === $this) {
                $reservation->setMoto(null);
            }
        }

        return $this;
    }

    public function getProprietaire(): ?Proprietaire
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?Proprietaire $proprietaire): static
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): static
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setMoto($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getMoto() === $this) {
                $commentaire->setMoto(null);
            }
        }

        return $this;
    }
}