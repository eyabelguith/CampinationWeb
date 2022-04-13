<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vip
 *
 * @ORM\Table(name="vip")
 * @ORM\Entity
 */
class Vip
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_vip", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVip;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_pt", type="integer", nullable=false)
     */
    private $nbPt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cin", type="integer", nullable=true)
     */
    private $cin;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nb_SS", type="integer", nullable=true)
     */
    private $nbSs;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nb_SB", type="integer", nullable=true)
     */
    private $nbSb;

    public function getIdVip(): ?int
    {
        return $this->idVip;
    }

    public function getNbPt(): ?int
    {
        return $this->nbPt;
    }

    public function setNbPt(int $nbPt): self
    {
        $this->nbPt = $nbPt;

        return $this;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(?int $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getNbSs(): ?int
    {
        return $this->nbSs;
    }

    public function setNbSs(?int $nbSs): self
    {
        $this->nbSs = $nbSs;

        return $this;
    }

    public function getNbSb(): ?int
    {
        return $this->nbSb;
    }

    public function setNbSb(?int $nbSb): self
    {
        $this->nbSb = $nbSb;

        return $this;
    }


}
