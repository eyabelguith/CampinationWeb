<?php

namespace App\Entity;
use App\Repository\SortiesportifRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @var int
     *@Assert\NotBlank(message="Vueiller remplir les champs")
     * @ORM\Column(name="id_destinationS", type="integer", nullable=false)
     */
    private $idDestinations;

    /**
     * @var \DateTime
     *@Assert\NotBlank(message="Vueiller remplir les champs")
     * @ORM\Column(name="date_depart", type="date", nullable=false)
     */
    private $dateDepart;

    /**
     * @var \DateTime
     *@Assert\NotBlank(message="Vueiller remplir les champs")
     * @ORM\Column(name="date_retour", type="date", nullable=false)
     */
    private $dateRetour;

    /**
     * @var string
     *@Assert\NotBlank(message="Vueiller remplir les champs")
     * @ORM\Column(name="type_sport", type="string", length=100, nullable=false)
     */
    private $typeSport;

    /**
     * @var int|null
     *@Assert\NotBlank(message="Vueiller remplir les champs")
     * @ORM\Column(name="cinCO", type="integer", nullable=true)
     */
    private $cinco;

    /**
     * @var int|null
     *@Assert\NotBlank(message="Vueiller remplir les champs")
     * @ORM\Column(name="cinT", type="integer", nullable=true)
     */
    private $cint;

    /**
     * @var string
     *@Assert\NotBlank(message="Vueiller remplir les champs")
     * @ORM\Column(name="nom_S", type="string", length=100, nullable=false)
     */
    private $nomS;

    /**
     * @ORM\ManyToMany(targetEntity=Camper::class)
     */
    private $ListeCamper;

    /**
     * @ORM\OneToMany(targetEntity=Destination::class, mappedBy="SortieS")
     */
    private $DestS;

    /**
     * @ORM\OneToOne(targetEntity=Sortiesportif::class, cascade={"persist", "remove"})
     */
    private $Transporteur;

    /**
     * @ORM\OneToOne(targetEntity=Coach::class, cascade={"persist", "remove"})
     */
    private $coach;

    public function __construct()
    {
        $this->ListeCamper = new ArrayCollection();
        $this->DestS = new ArrayCollection();
    }

    public function getIdSs(): ?int
    {
        return $this->idSs;
    }

    public function getIdDestinations(): ?int
    {
        return $this->idDestinations;
    }

    public function setIdDestinations(int $idDestinations): self
    {
        $this->idDestinations = $idDestinations;

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
     * @return Collection<int, Camper>
     */
    public function getListeCamper(): Collection
    {
        return $this->ListeCamper;
    }

    public function addListeCamper(Camper $listeCamper): self
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
    }

    /**
     * @return Collection<int, Destination>
     */
    public function getDestS(): Collection
    {
        return $this->DestS;
    }

    public function addDest(Destination $dest): self
    {
        if (!$this->DestS->contains($dest)) {
            $this->DestS[] = $dest;
            $dest->setSortieS($this);
        }

        return $this;
    }

    public function removeDest(Destination $dest): self
    {
        if ($this->DestS->removeElement($dest)) {
            // set the owning side to null (unless already changed)
            if ($dest->getSortieS() === $this) {
                $dest->setSortieS(null);
            }
        }

        return $this;
    }

    public function getTransporteur(): ?self
    {
        return $this->Transporteur;
    }

    public function setTransporteur(?self $Transporteur): self
    {
        $this->Transporteur = $Transporteur;

        return $this;
    }

    public function getCoach(): ?Coach
    {
        return $this->coach;
    }

    public function setCoach(?Coach $coach): self
    {
        $this->coach = $coach;

        return $this;
    }


}
