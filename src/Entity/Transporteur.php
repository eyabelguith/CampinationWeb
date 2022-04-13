<?php

namespace App\Entity;

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
     * @ORM\Column(name="id_t", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idT;

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
     * @var string
     *
     * @ORM\Column(name="disponibilite", type="string", length=20, nullable=false)
     */
    private $disponibilite;

    /**
     * @ORM\OneToOne(targetEntity=sortiesportif::class, cascade={"persist", "remove"})
     */
    private $sortieS;

    public function getIdT(): ?int
    {
        return $this->idT;
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

    public function getDisponibilite(): ?string
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(string $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getSortieS(): ?sortiesportif
    {
        return $this->sortieS;
    }

    public function setSortieS(?sortiesportif $sortieS): self
    {
        $this->sortieS = $sortieS;

        return $this;
    }


}
