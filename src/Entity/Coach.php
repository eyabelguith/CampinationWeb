<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\CoachRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Coach
 *
 * @ORM\Table(name="coach")
 * @ORM\Entity(repositoryClass=CoachRepository::class)
 */
class Coach
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *@Assert\NotBlank(message="Vueillez remplir le champ")
     * @ORM\Column(name="nom", type="string", length=10, nullable=false)
     */
    private $nom;

    /**
     * @var string
     **@Assert\NotBlank(message="Vueillez remplir le champ")
     * @ORM\Column(name="prenom", type="string", length=10, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="num_Tel", type="integer", length=10, nullable=false)
     */
    private $numTel;

    /**
     * @var string
     *@Assert\NotBlank(message="Vueillez remplir le champ")
     * @ORM\Column(name="email", type="string", length=30, nullable=false)
     */
    private $email;

    /**
     * @var string
     *@Assert\NotBlank(message="Vueillez remplir le champ")
     * @ORM\Column(name="login", type="string", length=100, nullable=false)
     */
    private $login;

    /**
     * @var string
     *@Assert\NotBlank(message="Vueillez remplir le champ")
     * @ORM\Column(name="pwd", type="string", length=10, nullable=false)
     */
    private $pwd;

    /**
     * @var string
     *@Assert\NotBlank(message="Vueillez remplir le champ")
     * @ORM\Column(name="gouvernorat", type="string", length=20, nullable=false)
     */
    private $gouvernorat;

    /**
     * @var int
     *@Assert\NotBlank(message="Vueillez remplir le champ")
     * @ORM\Column(name="cinCO", type="integer", nullable=false)
     */
    private $cinco;

    /**
     * @var string
    
     * @ORM\Column(name="sexe", type="string", length=10, nullable=false)
     */
    private $sexe;

    /**
     * @var string
     **@Assert\NotBlank(message="Vueillez remplir le champ")
     * @ORM\Column(name="type_sport", type="string", length=20, nullable=false)
     */
    private $typeSport;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=20, nullable=true)
     */
    private $role;
    


    public function getId(): ?int
    {
        return $this->id;
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

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

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

    public function getGouvernorat(): ?string
    {
        return $this->gouvernorat;
    }

    public function setGouvernorat(string $gouvernorat): self
    {
        $this->gouvernorat = $gouvernorat;

        return $this;
    }

    public function getCinco(): ?int
    {
        return $this->cinco;
    }

    public function setCinco(int $cinco): self
    {
        $this->cinco = $cinco;

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

    public function getTypeSport(): ?string
    {
        return $this->typeSport;
    }

    public function setTypeSport(string $typeSport): self
    {
        $this->typeSport = $typeSport;

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

    public function getSorties(): ?coach
    {
        return $this->sorties;
    }

    public function setSorties(?coach $sorties): self
    {
        $this->sorties = $sorties;

        return $this;
    }


}
