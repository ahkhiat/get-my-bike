<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
// #[UniqueEntity(
//     fields: ['user', 'reservation'],
//     errorPath: 'user',
//     message: 'Cet utilisateur a dejà noté cette reservation'
// )]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Positive]
    #[Assert\LessThan(6)]
    private ?int $noteMoto = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $texteMoto = null;

    #[ORM\Column(nullable: true)]
    private ?int $noteProprio = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $texteProprio = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Moto $moto = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

// J'ai enlevé cette proprieté (cascade: ['persist', 'remove']) pour remplacer par (inversedBy: 'commentaires')
// Penser à remettre #[ORM\ManyToOne(cascade: ['persist', 'remove'])]

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    #[ORM\JoinColumn(nullable: false)]

    private ?Reservation $Reservation = null;

    // public function __construct()
    // {
    //     $this->createdAt = new \DateTimeImmutable();
    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoteMoto(): ?string
    {
        return $this->noteMoto;
    }

    public function setNoteMoto(string $noteMoto): static
    {
        $this->noteMoto = $noteMoto;

        return $this;
    }

    public function getTexteMoto(): ?string
    {
        return $this->texteMoto;
    }

    public function setTexteMoto(?string $texteMoto): static
    {
        $this->texteMoto = $texteMoto;

        return $this;
    }

    public function getNoteProprio(): ?string
    {
        return $this->noteProprio;
    }

    public function setNoteProprio(?string $noteProprio): static
    {
        $this->noteProprio = $noteProprio;

        return $this;
    }

    public function getTexteProprio(): ?string
    {
        return $this->texteProprio;
    }

    public function setTexteProprio(?string $texteProprio): static
    {
        $this->texteProprio = $texteProprio;

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

    public function getMoto(): ?Moto
    {
        return $this->moto;
    }

    public function setMoto(?Moto $moto): static
    {
        $this->moto = $moto;

        return $this;
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

    public function getReservation(): ?Reservation
    {
        return $this->Reservation;
    }

    public function setReservation(?Reservation $Reservation): static
    {
        $this->Reservation = $Reservation;

        return $this;
    }
}
