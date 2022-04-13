<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\CamperRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Camper
 *
 * @ORM\Table(name="camper")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @ORM\Entity(repositoryClass=CamperRepository::class)

 */
class Camper
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Camper", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCamper;

    /**
     * @var string
     *@Assert\NotBlank(message="Vueillez remplir le champ")
     * @ORM\Column(name="nom", type="string", length=20, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *@Assert\NotBlank(message="Vueillez remplir le champ")
     * @ORM\Column(name="prenom", type="string", length=20, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *@Assert\NotBlank(message="Vueillez remplir le champ")
     * @ORM\Column(name="num_Tel", type="string", length=10, nullable=false)
     */
    private $numTel;

    /**
     * @var string
     *@Assert\NotBlank(message="Vueillez remplir le champ")
     * @ORM\Column(name="email", type="string", length=30, nullable=false)
     */
    private $email;

    /**
     * @var \DateTime
     *@Assert\NotBlank(message="Vueillez remplir le champ")
     * @ORM\Column(name="date_naissance", type="date", nullable=false)
     */
    private $dateNaissance;

    /**
     *@var string The hashed password
     *@Assert\NotBlank(message="Vueillez remplir le champ")
     * @ORM\Column(name="pwd", type="string", length=30, nullable=false)
     */
    private $pwd;

    /**
     * @var string
     *@Assert\NotBlank(message="Vueillez remplir le champ")
     * @ORM\Column(name="login", type="string", length=50, nullable=false)
     */
    private $login;

    /**
     * @var string
     *@Assert\NotBlank(message="Vueillez remplir le champ")
     * @ORM\Column(name="gouvernorat", type="string", length=50, nullable=false)
     */
    private $gouvernorat;

    /**
     * @var string
     *@Assert\NotBlank(message="Vueillez remplir le champ")
     * @ORM\Column(name="sexe", type="string", length=20, nullable=false, options={"fixed"=true})
     */
    private $sexe;

    /**
     * @var int
     *@Assert\NotBlank(message="Vueillez remplir le champ")
     * @ORM\Column(name="cin", type="integer", nullable=false)
     */
    private $cin;

    /**
     * @var string
     *@Assert\NotBlank(message="Vueillez remplir le champ")
     * @ORM\Column(name="Skills", type="text", length=65535, nullable=false)
     */
    private $skills;
    
/**
     * @ORM\Column(type="string", length=255,nullable=true) 
     
     * @Assert\File(
     * mimeTypes = {"image/jpeg", "image/png","image/jpg"},
     * mimeTypesMessage = "Only .jpeg .png .jpg  Extension valide"
     * )
     */
    private $image;
    
    /**
     * @var int
     *
     * @ORM\Column(name="nb_SS", type="integer", nullable=false)
     */
    
    private $nbSs;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_SB", type="integer", nullable=false)
     */
    private $nbSb;

    /**
     * @ORM\ManyToMany(targetEntity=Sortiebalade::class, inversedBy="listCamper")
     */
    private $sortieb;

    /**
     * @ORM\ManyToMany(targetEntity=Sortiesportif::class)
     */
    private $sortieS;

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

       
    }

    public function __construct()
    {
        $this->sortieb = new ArrayCollection();
        $this->sortieS = new ArrayCollection();
    }

    public function getIdCamper(): ?int
    {
        return $this->idCamper;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getPwd(): ?string
    {
        return $this->pwd;
    }

    public function setPwd(string $pwd): self
    {
        $this->pwd = $pwd;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

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

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(int $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getSkills(): ?string
    {
        return $this->skills;
    }

    public function setSkills(string $skills): self
    {
        $this->skills = $skills;

        return $this;
    }

    public function getRole(): ?string
    {
        $role = $this->role;
     
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getNbSs(): ?int
    {
        return $this->nbSs;
    }

    public function setNbSs(int $nbSs): self
    {
        $this->nbSs = $nbSs;

        return $this;
    }

    public function getNbSb(): ?int
    {
        return $this->nbSb;
    }

    public function setNbSb(int $nbSb): self
    {
        $this->nbSb = $nbSb;

        return $this;
    }
  

    /**
     * @return Collection<int, sortiebalade>
     */
    public function getSortieb(): Collection
    {
        return $this->sortieb;
    }

  /*  public function addSortieb(sortiebalade $sortieb): self
    {
        if (!$this->sortieb->contains($sortieb)) {
            $this->sortieb[] = $sortieb;
        }

        return $this;
    }

    public function removeSortieb(sortiebalade $sortieb): self
    {
        $this->sortieb->removeElement($sortieb);

        return $this;
    }
*/
    /**
     * @return Collection<int, sortiesportif>
     */
    public function getSortieS(): Collection
    {
        return $this->sortieS;
    }
/*
    public function addSortie(sortiesportif $sortie): self
    {
        if (!$this->sortieS->contains($sortie)) {
            $this->sortieS[] = $sortie;
        }

        return $this;
    }

    public function removeSortie(sortiesportif $sortie): self
    {
        $this->sortieS->removeElement($sortie);

        return $this;
    }
*/


}
