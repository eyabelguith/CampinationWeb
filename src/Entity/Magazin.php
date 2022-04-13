<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Magazin
 *
 * @ORM\Table(name="magazin")
 * @ORM\Entity
 */
class Magazin
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_article", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idArticle;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_article", type="string", length=20, nullable=false)
     */
    private $nomArticle;

    /**
     * @var string
     *
     * @ORM\Column(name="type_sport", type="string", length=20, nullable=false)
     */
    private $typeSport;

    public function getIdArticle(): ?int
    {
        return $this->idArticle;
    }

    public function getNomArticle(): ?string
    {
        return $this->nomArticle;
    }

    public function setNomArticle(string $nomArticle): self
    {
        $this->nomArticle = $nomArticle;

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


}
