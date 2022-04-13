<?php

namespace App\Entity;
use App\Repository\SortiesportifRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sortiesportif
 *
 * @ORM\Table(name="sortiesportif")
 * @ORM\Entity(repositoryClass=SortiesportifRepository::class)
 */
class Sortiesportif
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_SS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSs;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_depart", type="date", nullable=false)
     */
    private $dateDepart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_retour", type="date", nullable=false)
     */
    private $dateRetour;

    /**
     * @var string
     *
     * @ORM\Column(name="type_sport", type="string", length=100, nullable=false)
     */
    private $typeSport;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cinCO", type="integer", nullable=true)
     */
    private $cinco;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cinT", type="integer", nullable=true)
     */
    private $cint;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_S", type="string", length=100, nullable=false)
     */
    private $nomS;

    /**
     * @ORM\ManyToMany(targetEntity=Destination::class)
     */
    private $destinations;

    /**
     * @ORM\ManyToOne(targetEntity=Coach::class, inversedBy="sorties")
     */
    private $coach;



    public function __construct()
    {
        $this->destinations = new ArrayCollection();
    }

    public function getIdSs(): ?int
    {
        return $this->idSs;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->dateRetour;
    }

    public function setDateRetour(\DateTimeInterface $dateRetour): self
    {
        $this->dateRetour = $dateRetour;

        return $this;
    }

    public function getTypeSport(): ?string
    {
        return $this->typeSport;
    }

    public function setTypeSport(string $typeSport): self
    {
        $this->typeSport = $typeSport;

        return $this;
    }

    public function getCinco(): ?int
    {
        return $this->cinco;
    }

    public function setCinco(?int $cinco): self
    {
        $this->cinco = $cinco;

        return $this;
    }

    public function getCint(): ?int
    {
        return $this->cint;
    }

    public function setCint(?int $cint): self
    {
        $this->cint = $cint;

        return $this;
    }

    public function getNomS(): ?string
    {
        return $this->nomS;
    }

    public function setNomS(string $nomS): self
    {
        $this->nomS = $nomS;

        return $this;
    }

    /**
     * @return Collection<int, Destination>
     */
    public function getDestinations(): Collection
    {
        return $this->destinations;
    }

    public function addDestination(Destination $destination): self
    {
        if (!$this->destinations->contains($destination)) {
            $this->destinations[] = $destination;
        }

        return $this;
    }

    public function removeDestination(Destination $destination): self
    {
        $this->destinations->removeElement($destination);

        return $this;
    }

    public function getCoach(): ?Coach
    {
        return $this->coach;
    }

    public function setCoach(Coach $coach): self
    {
        $this->coach = $coach;

        return $this;
    }


}
