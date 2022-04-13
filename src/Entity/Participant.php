<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participant
 *
 * @ORM\Table(name="participant")
 * @ORM\Entity(repositoryClass=ParticipantRepository::class)
 */
class Participant
{
    /**
     * @var int
     *
     * @ORM\Column(name="cin", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cin;

    /**
     * @var int
     *
     * @ORM\Column(name="reference_e", type="integer", nullable=false)
     */
    private $referenceE;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_e", type="date", nullable=false)
     */
    private $dateE;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_event", type="string", length=50, nullable=false)
     */
    private $nomEvent;

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function getReferenceE(): ?int
    {
        return $this->referenceE;
    }

    public function setReferenceE(int $referenceE): self
    {
        $this->referenceE = $referenceE;

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

    public function getDateE(): ?\DateTimeInterface
    {
        return $this->dateE;
    }

    public function setDateE(\DateTimeInterface $dateE): self
    {
        $this->dateE = $dateE;

        return $this;
    }

    public function getNomEvent(): ?string
    {
        return $this->nomEvent;
    }

    public function setNomEvent(string $nomEvent): self
    {
        $this->nomEvent = $nomEvent;

        return $this;
    }


}
