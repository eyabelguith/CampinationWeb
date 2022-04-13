<?php

namespace App\Entity;
use App\Repository\TransporteurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Transporteur
 *
 * @ORM\Table(name="transporteur")
 * @ORM\Entity(repositoryClass=TransporteurRepository::class)
 */
class Transporteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_transporteur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTransporteur;

    /**
     * @var string
     *
     * @ORM\Column(name="num_tel", type="string", length=10, nullable=false)
     */
    private $numTel;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=10, nullable=false)
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
     * @ORM\Column(name="moyenT", type="string", length=20, nullable=false)
     */
    private $moyent;

    /**
     * @var int
     *
     * @ORM\Column(name="capacite", type="integer", nullable=false)
     */
    private $capacite;

    /**
     * @var string
     *
     * @ORM\Column(name="matricule", type="string", length=20, nullable=false)
     */
    private $matricule;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=20, nullable=false)
     */
    private $role;

    /**
     * @var int
     *
     * @ORM\Column(name="cinT", type="integer", nullable=false)
     */
    private $cint;

    /**
     * @ORM\ManyToOne(targetEntity=Sortiebalade::class, inversedBy="Transp")
     * @ORM\JoinColumn(nullable=false)
     */
    private $SortieB;

    public function getIdTransporteur(): ?int
    {
        return $this->idTransporteur;
    }

    public function getNumTel(): ?string
    {
        return $this->numTel;
    }

    public function setNumTel(string $numTel): self
    {
        $this->numTel = $numTel;

        return $this;
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

    public function getMoyent(): ?string
    {
        return $this->moyent;
    }

    public function setMoyent(string $moyent): self
    {
        $this->moyent = $moyent;

        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): self
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

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

    public function getSortieB(): ?Sortiebalade
    {
        return $this->SortieB;
    }

    public function setSortieB(?Sortiebalade $SortieB): self
    {
        $this->SortieB = $SortieB;

        return $this;
    }


}
