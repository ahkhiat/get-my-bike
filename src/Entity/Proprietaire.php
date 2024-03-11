<?php

namespace App\Entity;

use App\Repository\ProprietaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Console\Output\ConsoleSectionOutput;


#[ORM\Entity(repositoryClass: ProprietaireRepository::class)]
#[ORM\HasLifecycleCallbacks]

class Proprietaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $estSuperHote = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $IBAN = null;

    #[ORM\ManyToOne(inversedBy: 'proprietaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(targetEntity: Moto::class, mappedBy: 'proprietaire')]
    private Collection $motos;

    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'proprietaire')]
    private Collection $commentaires;

    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'proprietaire')]
    private Collection $reservations;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeImmutable $createdAt = null;

    private ?float $average = null;

    private ?int $nombreMotos = null;
    private ?int $nombreReservations = null;
    private ?int $nombreNotes = null;
    private ?int $nombreCommentaires = null;

    private ?int $nombreUn = null;
    private ?int $nombreDeux = null;
    private ?int $nombreTrois = null;
    private ?int $nombreQuatre = null;
    private ?int $nombreCinq = null;

    #[ORM\Column]
    private ?bool $isVerified = null;

    public function __construct()
    {
        $this->motos = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isEstSuperHote(): ?bool
    {
        return $this->estSuperHote;
    }

    public function setEstSuperHote(bool $estSuperHote): static
    {
        $this->estSuperHote = $estSuperHote;

        return $this;
    }


    public function getIBAN(): ?string
    {
        return $this->IBAN;
    }

    public function setIBAN(?string $IBAN): static
    {
        $this->IBAN = $IBAN;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Moto>
     */
    public function getMotos(): Collection
    {
        return $this->motos;
    }

    public function getNombreMotos(): ?string
    {
        $motos = $this->motos;

        $this->nombreMotos = count($motos);

        return $this->nombreMotos;
    }

// NE MARCHE PAS 

    // public function getNombreReservations(): ?string
    // {
    //     $motos = $this->motos;
    //     $nombreReservations = 0;

    //     foreach ($motos as $moto)
    //     {
    //         $reservations = $moto->getReservations();
    //         // $nombreReservations += $reservations;
    //         $nombreReservations += count($reservations);

    //     }

    //     return $nombreReservations;
    // }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function getNombreReservations(): ?string
    {
        $reservations = $this->reservations;

        $this->nombreReservations = count($reservations);

        return $this->nombreReservations;
    }

/**
     * Get the value of nombreCommentaires
     */ 
    public function getNombreCommentaires()
    {
        $commentaires = $this->commentaires;

        $this->nombreCommentaires = count($commentaires);

        return $this->nombreCommentaires;
    }

    

    public function addMoto(Moto $moto): static
    {
        if (!$this->motos->contains($moto)) {
            $this->motos->add($moto);
            $moto->setProprietaire($this);
        }

        return $this;
    }

    public function removeMoto(Moto $moto): static
    {
        if ($this->motos->removeElement($moto)) {
            // set the owning side to null (unless already changed)
            if ($moto->getProprietaire() === $this) {
                $moto->setProprietaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    // public function addCommentaire(Commentaire $commentaire): static
    // {
    //     if (!$this->commentaires->contains($commentaire)) {
    //         $this->commentaires->add($commentaire);
    //         $commentaire->setProprietaire($this);
    //     }

    //     return $this;
    // }

    // public function removeCommentaire(Commentaire $commentaire): static
    // {
    //     if ($this->commentaires->removeElement($commentaire)) {
    //         // set the owning side to null (unless already changed)
    //         if ($commentaire->getProprietaire() === $this) {
    //             $commentaire->setProprietaire(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getAverage(): ?string
    {
        $commentaires = $this->commentaires;

        if($commentaires->toArray() === []) {
            $this->average = null;
            return $this->average;
        }
        $total = 0;
        foreach ($commentaires as $commentaire){
            $total += $commentaire->getNoteProprio();
        }
        $this->average = $total / count($commentaires);

        return $this->average;
    }

    public function getNombreNotes(): ?string
    {
        $commentaires = $this->commentaires;

        $this->nombreNotes = count($commentaires);
        return $this->nombreNotes;
    }

    public function getNombreUn() : ?string
    {
        $commentaires = $this->commentaires;
        $nombre = 0;
        foreach($commentaires as $commentaire){
            if($commentaire->getNoteProprio() == 1){
                $nombre++;
            }
            $this->nombreUn = $nombre;
        }
        return $this->nombreUn;
    }
    public function getNombreDeux() : ?string
    {
        $commentaires = $this->commentaires;
        $nombre = 0;
        foreach($commentaires as $commentaire){
            if($commentaire->getNoteProprio() == 2){
                $nombre++;
            }
            $this->nombreDeux = $nombre;
        }
        return $this->nombreDeux;

    }
    public function getNombreTrois() : ?string
    {
        $commentaires = $this->commentaires;
        $nombre = 0;
        foreach($commentaires as $commentaire){
            if($commentaire->getNoteProprio() == 3){
                $nombre++;
            }
            $this->nombreTrois = $nombre;
        }
        return $this->nombreTrois;
    }
    public function getNombreQuatre() : ?string
    {
        $commentaires = $this->commentaires;
        $nombre = 0;
        foreach($commentaires as $commentaire){
            if($commentaire->getNoteProprio() == 4){
                $nombre++;
            }
            $this->nombreQuatre = $nombre;
        }
        return $this->nombreQuatre;

    }
    public function getNombreCinq() : ?string
    {
        $commentaires = $this->commentaires;
        $nombre = 0;
        foreach($commentaires as $commentaire){
            if($commentaire->getNoteProprio() == 5){
                $nombre++;
            }
            $this->nombreCinq = $nombre;
        }
        return $this->nombreCinq;

    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    // public function setCreatedAt(\DateTimeImmutable $createdAt): static
    // {
    //     $this->createdAt = $createdAt;

    //     return $this;
    // }
    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function isIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    
}
