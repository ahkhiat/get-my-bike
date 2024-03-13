<?php

namespace App\Entity;

use App\Repository\MotoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: MotoRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]

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
    private ?bool $dispo = false;

    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'moto')]
    private Collection $reservations;

    #[ORM\ManyToOne(inversedBy: 'motos')]
    private ?Proprietaire $proprietaire = null;

    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'moto')]
    private Collection $commentaires;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeImmutable $createdAt = null;

     #[Vich\UploadableField(mapping: 'moto_images', fileNameProperty: 'imageName')]
     private ?File $imageFile = null;
 
     #[ORM\Column(nullable: true)]
     private ?string $imageName = null;

     #[ORM\Column(type: Types::TEXT, nullable: true)]
     private ?string $description = null;

     #[ORM\Column]
     private ?bool $bagagerie = null;

     #[ORM\Column(length: 255, nullable: true)]
     private ?string $adresseMoto = null;

     #[ORM\Column(length: 5, nullable: true)]
     private ?string $codePostalMoto = null;

     #[ORM\Column(length: 255, nullable: true)]
     private ?string $villeMoto = null;

    //  #[ORM\Column(nullable: true)]
    // private ?\DateTimeImmutable $updatedAt = null;

    private ?float $average = null;

    private ?int $nombreNotes = null;

    private ?int $nombreUn = null;
    private ?int $nombreDeux = null;
    private ?int $nombreTrois = null;
    private ?int $nombreQuatre = null;
    private ?int $nombreCinq = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cylindree = null;

    #[ORM\Column(nullable: true)]
    private ?int $poids = null;

    #[ORM\Column(nullable: true)]
    private ?int $puissance = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $options = null;

    #[ORM\ManyToOne(inversedBy: 'motos')]
    private ?marque $marque = null;

    
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

    public function getAverage(): ?string
    {
        $commentaires = $this->commentaires;

        if($commentaires->toArray() === []) {
            $this->average = null;
            return $this->average;
        }
        $total = 0;
        foreach ($commentaires as $commentaire){
            $total += $commentaire->getNoteMoto();
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
            if($commentaire->getNoteMoto() == 1){
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
            if($commentaire->getNoteMoto() == 2){
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
            if($commentaire->getNoteMoto() == 3){
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
            if($commentaire->getNoteMoto() == 4){
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
            if($commentaire->getNoteMoto() == 5){
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

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isBagagerie(): ?bool
    {
        return $this->bagagerie;
    }

    public function setBagagerie(bool $bagagerie): static
    {
        $this->bagagerie = $bagagerie;

        return $this;
    }

    public function getAdresseMoto(): ?string
    {
        return $this->adresseMoto;
    }

    public function setAdresseMoto(?string $adresseMoto): static
    {
        $this->adresseMoto = $adresseMoto;

        return $this;
    }

    public function getCodePostalMoto(): ?string
    {
        return $this->codePostalMoto;
    }

    public function setCodePostalMoto(?string $codePostalMoto): static
    {
        $this->codePostalMoto = $codePostalMoto;

        return $this;
    }

    public function getVilleMoto(): ?string
    {
        return $this->villeMoto;
    }

    public function setVilleMoto(?string $villeMoto): static
    {
        $this->villeMoto = $villeMoto;

        return $this;
    }

    public function getCylindree(): ?string
    {
        return $this->cylindree;
    }

    public function setCylindree(string $cylindree): static
    {
        $this->cylindree = $cylindree;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->poids;
    }

    public function setPoids(int $poids): static
    {
        $this->poids = $poids;

        return $this;
    }

    public function getPuissance(): ?int
    {
        return $this->puissance;
    }

    public function setPuissance(int $puissance): static
    {
        $this->puissance = $puissance;

        return $this;
    }

    public function getOptions(): ?string
    {
        return $this->options;
    }

    public function setOptions(string $options): static
    {
        $this->options = $options;

        return $this;
    }

    public function getMarque(): ?marque
    {
        return $this->marque;
    }

    public function setMarque(?marque $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    
   
}
