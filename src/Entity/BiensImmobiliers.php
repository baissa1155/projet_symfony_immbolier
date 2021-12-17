<?php

namespace App\Entity;

use App\Repository\BiensImmobiliersRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BiensImmobiliersRepository::class)
 */
class BiensImmobiliers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_soumis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rue_et_numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $localite;

    /**
     * @ORM\Column(type="integer")
     */
    private $revenue_cadestral;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo_du_bien;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=TypesLogements::class, inversedBy="biensimmobiliers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typesLogements;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="biensimmobiliers", orphanRemoval=true)
     */
    private $commentaires;

    /**
     * @ORM\ManyToOne(targetEntity=Quartier::class, inversedBy="biensquartiers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $quartier;

    /**
     * @ORM\ManyToOne(targetEntity=Chambres::class, inversedBy="biensimmobiliers")
     */
    private $chambres;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pieces;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $surface;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $etages;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $douces;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $parking;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $meuble;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $jardin;

    /**
     * @ORM\Column(type="boolean", options={"default"=0})
     */
    private $a_vendre;

    /**
     * @ORM\Column(type="boolean", options={"default"=0})
     */
    private $a_louer;


    public function __construct()
    {
        $this->date_soumis = new \DateTime();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateSoumis(): ?\DateTimeInterface
    {
        return $this->date_soumis;
    }

    public function setDateSoumis(\DateTimeInterface $date_soumis): self
    {
        $this->date_soumis = $date_soumis;

        return $this;
    }

    public function getRueEtNumero(): ?string
    {
        return $this->rue_et_numero;
    }

    public function setRueEtNumero(string $rue_et_numero): self
    {
        $this->rue_et_numero = $rue_et_numero;

        return $this;
    }

    public function getLocalite(): ?string
    {
        return $this->localite;
    }

    public function setLocalite(string $localite): self
    {
        $this->localite = $localite;

        return $this;
    }

    public function getRevenueCadestral(): ?int
    {
        return $this->revenue_cadestral;
    }

    public function setRevenueCadestral(int $revenue_cadestral): self
    {
        $this->revenue_cadestral = $revenue_cadestral;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPhotoDuBien(): ?string
    {
        return $this->photo_du_bien;
    }

    public function setPhotoDuBien(string $photo_du_bien): self
    {
        $this->photo_du_bien = $photo_du_bien;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTypesLogements(): ?TypesLogements
    {
        return $this->typesLogements;
    }

    public function setTypesLogements(?TypesLogements $typesLogements): self
    {
        $this->typesLogements = $typesLogements;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setBiensimmobiliers($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getBiensimmobiliers() === $this) {
                $commentaire->setBiensimmobiliers(null);
            }
        }

        return $this;
    }

    public function getQuartier(): ?Quartier
    {
        return $this->quartier;
    }

    public function setQuartier(?Quartier $quartier): self
    {
        $this->quartier = $quartier;

        return $this;
    }

    public function getChambres(): ?Chambres
    {
        return $this->chambres;
    }

    public function setChambres(?Chambres $chambres): self
    {
        $this->chambres = $chambres;

        return $this;
    }

    public function getPieces(): ?int
    {
        return $this->pieces;
    }

    public function setPieces(?int $pieces): self
    {
        $this->pieces = $pieces;

        return $this;
    }

    public function getSurface(): ?string
    {
        return $this->surface;
    }

    public function setSurface(?string $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getEtages(): ?int
    {
        return $this->etages;
    }

    public function setEtages(?int $etages): self
    {
        $this->etages = $etages;

        return $this;
    }

    public function getDouces(): ?int
    {
        return $this->douces;
    }

    public function setDouces(?int $douces): self
    {
        $this->douces = $douces;

        return $this;
    }

    public function getParking(): ?string
    {
        return $this->parking;
    }

    public function setParking(?string $parking): self
    {
        $this->parking = $parking;

        return $this;
    }

    public function getMeuble(): ?bool
    {
        return $this->meuble;
    }

    public function setMeuble(?bool $meuble): self
    {
        $this->meuble = $meuble;

        return $this;
    }

    public function getJardin(): ?bool
    {
        return $this->jardin;
    }

    public function setJardin(?bool $jardin): self
    {
        $this->jardin = $jardin;

        return $this;
    }

    public function getAVendre(): ?bool
    {
        return $this->a_vendre;
    }

    public function setAVendre(bool $a_vendre): self
    {
        $this->a_vendre = $a_vendre;

        return $this;
    }

    public function getALouer(): ?bool
    {
        return $this->a_louer;
    }

    public function setALouer(bool $a_louer): self
    {
        $this->a_louer = $a_louer;

        return $this;
    }
    // public function __toString()
    // {
    //     return $this->typesLogements;
    // }
}
