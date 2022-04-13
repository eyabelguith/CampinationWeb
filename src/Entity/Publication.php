<?php

namespace App\Entity;
use App\Repository\PublicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints\Image;
/**
 * Publication
 *
 * @ORM\Table(name="publication")
 * @ORM\Entity(repositoryClass=PublicationRepository::class)
 */
class Publication
{

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date pub", type="datetime", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $datePub;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text", length=65535, nullable=false)
     */
    private $contenu;

     /**
      * @ORM\Column(type="string", length=50,nullable=false)
      * @Assert\Type(type="string")
      * @Assert\NotBlank (message="vous devez ajouter un nom")
 
     */
    private $nom;
    /**
     * @ORM\Column(type="string", length=255) 
     
     * @Assert\File(
     * mimeTypes = {"image/jpeg", "image/png","image/jpg"},
     * mimeTypesMessage = "Only .jpeg .png .jpg  Extension valide"
     * )
     */
    private $imageP;

    public function getIdEmetteur(): ?int
    {
        return $this->idEmetteur;
    }

    public function getDatePub(): ?\DateTimeInterface
    {
        return $this->datePub;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

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
    public function getImageP()
    {
        return $this->imageP;
    }

    public function setImageP( $imageP)
    {
        $this->imageP = $imageP;

        return $this;
    }


}
