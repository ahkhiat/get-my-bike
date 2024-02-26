<?php

namespace App\Entity;

use App\Repository\ProprietaireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProprietaireRepository::class)]
class Proprietaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $estSuperHote = null;

    #[ORM\Column(nullable: true)]
    private ?int $nombreNotes = null;

    #[ORM\Column(nullable: true)]
    private ?int $moyenneNotes = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $IBAN = null;

    #[ORM\ManyToOne(inversedBy: 'proprietaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

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

    public function getNombreNotes(): ?int
    {
        return $this->nombreNotes;
    }

    public function setNombreNotes(?int $nombreNotes): static
    {
        $this->nombreNotes = $nombreNotes;

        return $this;
    }

    public function getMoyenneNotes(): ?int
    {
        return $this->moyenneNotes;
    }

    public function setMoyenneNotes(?int $moyenneNotes): static
    {
        $this->moyenneNotes = $moyenneNotes;

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
}
