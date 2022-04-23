<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\SortiebaladeRepository;
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
     * @var int
     *@Assert\NotBlank(message="Vueiller remplir les champs")
     * @ORM\Column(name="id_destinationB", type="integer", nullable=false)
     */
    private $idDestinationb;

    /**
     * @var \DateTime
     *@Assert\NotBlank(message="Vueiller remplir les champs")
     * @ORM\Column(name="date_depart", type="date", nullable=false)
     * @Assert\GreaterThan("today")
     */
    private $dateDepart;

    /**
     * @var \DateTime
     *@Assert\NotBlank(message="Vueiller remplir les champs")
     * @ORM\Column(name="date_retour", type="date", nullable=false)
     * @Assert\GreaterThan("today")
     * @Assert\Expression("this.getDateDepart() < this.getDateRetour()",message="La date fin ne doit pas être antérieure à la date début")
     */
    private $dateRetour;

    /**
     * @var int
     *@Assert\Length(min=6 , minMessage = "le cin de transporteur faut etre 6 au minimum")
     
     * @ORM\Column(name="cinT", type="integer", nullable=false)
     */
    private $cint;

    /**
     * @var string
     *@Assert\NotBlank(message="Vueiller remplir les champs")
     * @ORM\Column(name="nom_S", type="string", length=100, nullable=false)
     * @Assert\Unique
     */
    private $nomS;

    /**
     * @ORM\ManyToMany(targetEntity=Camper::class)
     * 
     */
    private $ListeCamper;

    /**
     * @ORM\OneToMany(targetEntity=Destination::class, mappedBy="SortieB")
     */
    private $DestB;

    /**
     * @ORM\OneToMany(targetEntity=Transporteur::class, mappedBy="SortieB")
     */
    private $Transp;

    public function __construct()
    {
        $this->ListeCamper = new ArrayCollection();
        $this->DestB = new ArrayCollection();
        $this->Transp = new ArrayCollection();
    }

    public function getIdSb(): ?int
    {
        return $this->idSb;
    }

    public function getIdDestinationb(): ?int
    {
        return $this->idDestinationb;
    }

    public function setIdDestinationb(int $idDestinationb): self
    {
        $this->idDestinationb = $idDestinationb;

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
    public function getListeCamper(): Collection
    {
        return $this->ListeCamper;
    }

    /*public function addListeCamper(Camper $listeCamper): self
    {
        if (!$this->ListeCamper->contains($listeCamper)) {
            $this->ListeCamper[] = $listeCamper;
        }

        return $this;
    }

    public function removeListeCamper(Camper $listeCamper): self
    {
        $this->ListeCamper->removeElement($listeCamper);

        return $this;
    }*/

    /**
     * @return Collection<int, Destination>
     */
    public function getDestB(): Collection
    {
        return $this->DestB;
    }

   public function addDestB(Destination $destB): self
    {
        if (!$this->DestB->contains($destB)) {
            $this->DestB[] = $destB;
            $destB->setSortieB($this);
        }

        return $this;
    }

    public function removeDestB(Destination $destB): self
    {
        if ($this->DestB->removeElement($destB)) {
            // set the owning side to null (unless already changed)
            if ($destB->getSortieB() === $this) {
                $destB->setSortieB(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Transporteur>
     */
    public function getTransp(): Collection
    {
        return $this->Transp;
    }

    /*public function addTransp(Transporteur $transp): self
    {
        if (!$this->Transp->contains($transp)) {
            $this->Transp[] = $transp;
            $transp->setSortieB($this);
        }

        return $this;
    }

    public function removeTransp(Transporteur $transp): self
    {
        if ($this->Transp->removeElement($transp)) {
            // set the owning side to null (unless already changed)
            if ($transp->getSortieB() === $this) {
                $transp->setSortieB(null);
            }
        }

        return $this;
    }*/


}
