<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Utils\ChaineDeCaracteres;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    public const ROLE_ADMIN = 'ROLE_ADMIN'; // Administrateur
    public const ROLE_USER  = 'ROLE_USER';  // Adhérent

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = ['ROLE_USER'];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $isVerified = false;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $actif = false;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrEmpruntPossible = 3;

    // /**
    //  * @ORM\OneToMany(targetEntity=ListeObjets::class, mappedBy="proprietaire")
    //  */
    // private $listeObjets;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="proprietaire")
     */
    private $articles;

    /**
     * @ORM\ManyToMany(targetEntity=HistoriqueArticle::class, mappedBy="adherent")
     */
    private $historiqueArticles;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbreEmpruntEnCours = 0;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateSuppression;

    public function __construct()
    {
        //$this->listeObjets = new ArrayCollection();
        $this->articles = new ArrayCollection();
        $this->historiqueArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        // $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function addRoles(string $roles): self
    {
        if (!in_array($roles, $this->roles)) {
            $this->roles[] = $roles;
        }

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Le retour d'un sel n'est nécessaire que si vous n'utilisez pas un
<<<<<<< HEAD
     * algorithme de hachage (par exemple bcrypt ou sodium) dans votre security.yaml.
=======
     * algorithme de hachage (par exemple bcrypt ou sodium) dans votre security.yaml. 
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getNbrEmpruntPossible(): ?int
    {
        return $this->nbrEmpruntPossible;
    }

    public function setNbrEmpruntPossible(int $nbrEmpruntPossible): self
    {
        $this->nbrEmpruntPossible = $nbrEmpruntPossible;

        return $this;
    }

    /**
     * Retourne la liste des roles existants
     */
    public static function listeRoles()
    {
        return [self::ROLE_ADMIN, self::ROLE_USER];
    }

    // /**
    //  * @return Collection|ListeObjets[]
    //  */
    // public function getListeObjets(): Collection
    // {
    //     return $this->listeObjets;
    // }

    // public function addListeObjet(ListeObjets $listeObjet): self
    // {
    //     if (!$this->listeObjets->contains($listeObjet)) {
    //         $this->listeObjets[] = $listeObjet;
    //         $listeObjet->setProprietaire($this);
    //     }

    //     return $this;
    // }

    // public function removeListeObjet(ListeObjets $listeObjet): self
    // {
    //     if ($this->listeObjets->removeElement($listeObjet)) {
    //         // set the owning side to null (unless already changed)
    //         if ($listeObjet->getProprietaire() === $this) {
    //             $listeObjet->setProprietaire(null);
    //         }
    //     }

    //     return $this;
    // }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setProprietaire($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getProprietaire() === $this) {
                $article->setProprietaire(null);
            }
        }

        return $this;
    }

    public function getNomCompletCourt(): string
    {
        return ChaineDeCaracteres::nomPrenom($this->getNom(), $this->getPrenom());
    }

    public function __toString()
    {
        return $this->getNomCompletCourt();
    }

    /**
     * @return Collection|HistoriqueArticle[]
     */
    public function getHistoriqueArticles(): Collection
    {
        return $this->historiqueArticles;
    }

    public function addHistoriqueArticle(HistoriqueArticle $historiqueArticle): self
    {
        if (!$this->historiqueArticles->contains($historiqueArticle)) {
            $this->historiqueArticles[] = $historiqueArticle;
            $historiqueArticle->addAdherent($this);
        }

        return $this;
    }

    public function removeHistoriqueArticle(HistoriqueArticle $historiqueArticle): self
    {
        if ($this->historiqueArticles->removeElement($historiqueArticle)) {
            $historiqueArticle->removeAdherent($this);
        }

        return $this;
    }

    public function getNbreEmpruntEnCours(): ?int
    {
        return $this->nbreEmpruntEnCours;
    }

    public function setNbreEmpruntEnCours(?int $nbreEmpruntEnCours): self
    {
        $this->nbreEmpruntEnCours = $nbreEmpruntEnCours;

        return $this;
    }

    public function getDateSuppression(): ?\DateTimeInterface
    {
        return $this->dateSuppression;
    }

    public function setDateSuppression(?\DateTimeInterface $dateSuppression): self
    {
        $this->dateSuppression = $dateSuppression;

        return $this;
    }
<<<<<<< HEAD
=======

>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
}
