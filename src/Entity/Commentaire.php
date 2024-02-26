<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: 2)]
    private ?string $noteMoto = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $texteMoto = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: 2, nullable: true)]
    private ?string $noteProprio = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $texteProprio = null;

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
}
