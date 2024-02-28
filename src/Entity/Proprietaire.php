<?php

namespace App\Entity;

use App\Repository\ProprietaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;


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

    #[ORM\Column(nullable: true)]
    private ?int $nombreNotes = null;

    #[ORM\Column(nullable: true)]
    private ?int $moyenneNotes = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $IBAN = null;

    #[ORM\ManyToOne(inversedBy: 'proprietaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(targetEntity: Moto::class, mappedBy: 'proprietaire')]
    private Collection $motos;

    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'proprietaire')]
    private Collection $commentaires;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeImmutable $createdAt = null;

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

    /**
     * @return Collection<int, Moto>
     */
    public function getMotos(): Collection
    {
        return $this->motos;
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

    public function addCommentaire(Commentaire $commentaire): static
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setProprietaire($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getProprietaire() === $this) {
                $commentaire->setProprietaire(null);
            }
        }

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
}
