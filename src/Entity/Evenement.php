<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EvenementRepository;
/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_e", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idE;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=30, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="destination_e", type="string", length=30, nullable=false)
     */
    private $destinationE;

    /**
     * @var string
     *
     * @ORM\Column(name="type_e", type="string", length=30, nullable=false)
     */
    private $typeE;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedebut", type="date", nullable=false)
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefin", type="date", nullable=false)
     */
    private $datefin;

    /**
     * @var string
     *
     * @ORM\Column(name="participants", type="string", length=100, nullable=false)
     */
    private $participants;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=Evenement::class, inversedBy="evenements")
     */
    private $Destination;

    /**
     * @ORM\ManyToMany(targetEntity=Evenement::class, mappedBy="Destination")
     */
    private $evenements;

    public function __construct()
    {
        $this->Destination = new ArrayCollection();
        $this->evenements = new ArrayCollection();
    }

    public function getIdE(): ?int
    {
        return $this->idE;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDestinationE(): ?string
    {
        return $this->destinationE;
    }

    public function setDestinationE(string $destinationE): self
    {
        $this->destinationE = $destinationE;

        return $this;
    }

    public function getTypeE(): ?string
    {
        return $this->typeE;
    }

    public function setTypeE(string $typeE): self
    {
        $this->typeE = $typeE;

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

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(\DateTimeInterface $datefin): self
    {
        $this->datefin = $datefin;

        return $this;
    }

    public function getParticipants(): ?string
    {
        return $this->participants;
    }

    public function setParticipants(string $participants): self
    {
        $this->participants = $participants;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->Destination;
    }

    public function setDestination(string $Destination): self
    {
        $this->Destination = $Destination;

        return $this;
    }

    public function addDestination(self $destination): self
    {
        if (!$this->Destination->contains($destination)) {
            $this->Destination[] = $destination;
        }

        return $this;
    }

    public function removeDestination(self $destination): self
    {
        $this->Destination->removeElement($destination);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(self $evenement): self
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements[] = $evenement;
            $evenement->addDestination($this);
        }

        return $this;
    }

    public function removeEvenement(self $evenement): self
    {
        if ($this->evenements->removeElement($evenement)) {
            $evenement->removeDestination($this);
        }

        return $this;
    }

 


}
