<?php

namespace App\Entity;
use App\Repository\DestinationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Destination
 *
 * @ORM\Table(name="destination")
 * @ORM\Entity(repositoryClass=DestinationRepository::class)
 */
class Destination
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_destinationB", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDestinationb;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=20, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="gouvernorat", type="string", length=20, nullable=false)
     */
    private $gouvernorat;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=10, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=30, nullable=false)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=30, nullable=false)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Sortiebalade::class, inversedBy="DestB")
     * @ORM\JoinColumn(nullable=false)
     */
    private $SortieB;

    /**
     * @ORM\ManyToOne(targetEntity=Sortiesportif::class, inversedBy="DestS")
     * @ORM\JoinColumn(nullable=false)
     */
    private $SortieS;

    public function getIdDestinationb(): ?int
    {
        return $this->idDestinationb;
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

    public function getGouvernorat(): ?string
    {
        return $this->gouvernorat;
    }

    public function setGouvernorat(string $gouvernorat): self
    {
        $this->gouvernorat = $gouvernorat;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

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

    public function getSortieB(): ?Sortiebalade
    {
        return $this->SortieB;
    }

    public function setSortieB(?Sortiebalade $SortieB): self
    {
        $this->SortieB = $SortieB;

        return $this;
    }

    public function getSortieS(): ?Sortiesportif
    {
        return $this->SortieS;
    }

    public function setSortieS(?Sortiesportif $SortieS): self
    {
        $this->SortieS = $SortieS;

        return $this;
    }


}
