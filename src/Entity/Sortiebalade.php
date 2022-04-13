<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sortiebalade
 *
 * @ORM\Table(name="sortiebalade")
 * @ORM\Entity(repositoryClass=SortiebaladeRepository::class)
 */
class Sortiebalade
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_SB", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSb;

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
     * @var int
     *
     * @ORM\Column(name="cinT", type="integer", nullable=false)
     */
    private $cint;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_S", type="string", length=100, nullable=false)
     */
    private $nomS;

    /**
     * @ORM\ManyToMany(targetEntity=Camper::class, mappedBy="sortieb")
     */
    private $listCamper;

    /**
     * @ORM\ManyToMany(targetEntity=Destination::class)
     */
    private $destinations;

    /**
     * @ORM\OneToOne(targetEntity=Transporteur::class, cascade={"persist", "remove"})
     */
    private $transporteur;

    public function __construct()
    {
        $this->listCamper = new ArrayCollection();
        $this->destinations = new ArrayCollection();
    }

    public function getIdSb(): ?int
    {
        return $this->idSb;
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

    public function getCint(): ?int
    {
        return $this->cint;
    }

    public function setCint(int $cint): self
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
     * @return Collection<int, Camper>
     */
    public function getListCamper(): Collection
    {
        return $this->listCamper;
    }

    public function addListCamper(Camper $listCamper): self
    {
        if (!$this->listCamper->contains($listCamper)) {
            $this->listCamper[] = $listCamper;
            $listCamper->addSortieb($this);
        }

        return $this;
    }

    public function removeListCamper(Camper $listCamper): self
    {
        if ($this->listCamper->removeElement($listCamper)) {
            $listCamper->removeSortieb($this);
        }

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

    public function getTransporteur(): ?Transporteur
    {
        return $this->transporteur;
    }

    public function setTransporteur(?Transporteur $transporteur): self
    {
        $this->transporteur = $transporteur;

        return $this;
    }


}
