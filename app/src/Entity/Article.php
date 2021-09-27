<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Utils\ChaineDeCaracteres;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Langage::class, inversedBy="articles")
     */
    private $langages;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $proprietaire;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=true)
     */
    private $emprunteur;

    // /**
    //  * @ORM\ManyToMany(targetEntity=Categorie::class, inversedBy="articles")
    //  */
    // private $categories;

    /**
     * @ORM\ManyToMany(targetEntity=Nature::class, inversedBy="articles")
     */
    private $natures;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    // /**
    //  * @ORM\Column(type="blob")
    //  */
    // private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $estEmprunte;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateSuppression;

    /**
     * @ORM\ManyToMany(targetEntity=Auteur::class, inversedBy="articles")
     */
    private $auteurs;

    /**
     * @ORM\Column(type="string")
     */
    private $image;

    /**
     * @ORM\Column(type="array")
     */
    private $genres = [];

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, inversedBy="articles")
     */
    private $genresBis;

    /**
     * @ORM\ManyToOne(targetEntity=Fichier::class, inversedBy="articles")
     */
    private $photo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateRestitution;

    /**
     * @ORM\ManyToMany(targetEntity=HistoriqueArticle::class, mappedBy="article")
     */
    private $historiqueArticles;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="articleUser")
     */
    private $reservePar;

    /**
     * @ORM\ManyToOne(targetEntity=ArticleStatus::class, inversedBy="articles")
     */
    private $status;

    public function __construct()
    {
        $this->langages = new ArrayCollection();
        $this->natures = new ArrayCollection();
        $this->auteurs = new ArrayCollection();
        $this->genresBis = new ArrayCollection();
        $this->historiqueArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Langage[]
     */
    public function getLangages(): Collection
    {
        return $this->langages;
    }

    public function addLangage(Langage $langage): self
    {
        if (!$this->langages->contains($langage)) {
            $this->langages[] = $langage;
        }

        return $this;
    }

    public function removeLangage(Langage $langage): self
    {
        $this->langages->removeElement($langage);

        return $this;
    }

    public function getProprietaire(): ?User
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?User $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    public function getEmprunteur(): ?User
    {
        return $this->emprunteur;
    }

    public function setEmprunteur(?User $emprunteur): self
    {
        $this->emprunteur = $emprunteur;

        return $this;
    }

    // /**
    //  * @return Collection|Categorie[]
    //  */
    // public function getCategories(): Collection
    // {
    //     return $this->categories;
    // }

    // public function addCategory(Categorie $category): self
    // {
    //     if (!$this->categories->contains($category)) {
    //         $this->categories[] = $category;
    //     }

    //     return $this;
    // }

    // public function removeCategory(Categorie $category): self
    // {
    //     $this->categories->removeElement($category);

    //     return $this;
    // }

    /**
     * @return Collection|Nature[]
     */
    public function getNatures(): Collection
    {
        return $this->natures;
    }

    public function addNature(Nature $nature): self
    {
        if (!$this->natures->contains($nature)) {
            $this->natures[] = $nature;
        }

        return $this;
    }

    public function removeNature(Nature $nature): self
    {
        $this->natures->removeElement($nature);

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    // public function getDescription()
    // {
    //     return $this->description;
    // }

    // public function setDescription($description): self
    // {
    //     $this->description = $description;

    //     return $this;
    // }

    public function getEstEmprunte(): ?bool
    {
        return $this->estEmprunte;
    }

    public function setEstEmprunte(bool $estEmprunte): self
    {
        $this->estEmprunte = $estEmprunte;

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

    /**
     * @return Collection|Auteur[]
     */
    public function getAuteurs(): Collection
    {
        return $this->auteurs;
    }

    public function addAuteur(Auteur $auteur): self
    {
        if (!$this->auteurs->contains($auteur)) {
            $this->auteurs[] = $auteur;
        }

        return $this;
    }

    public function removeAuteur(Auteur $auteur): self
    {
        $this->auteurs->removeElement($auteur);

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getGenres(): ?array
    {
        return $this->genres;
    }

    public function setGenres(array $genres): self
    {
        $this->genres = $genres;

        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenresBis(): Collection
    {
        return $this->genresBis;
    }

    public function addGenresBi(Genre $genresBi): self
    {
        if (!$this->genresBis->contains($genresBi)) {
            $this->genresBis[] = $genresBi;
        }

        return $this;
    }

    public function removeGenresBi(Genre $genresBi): self
    {
        $this->genresBis->removeElement($genresBi);

        return $this;
    }

    public function getPhoto(): ?Fichier
    {
        return $this->photo;
    }

    public function setPhoto(?Fichier $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getDateRestitution(): ?\DateTimeInterface
    {
        return $this->dateRestitution;
    }

    public function setDateRestitution(?\DateTimeInterface $dateRestitution): self
    {
        $this->dateRestitution = $dateRestitution;

        return $this;
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
            $historiqueArticle->addArticle($this);
        }

        return $this;
    }

    public function removeHistoriqueArticle(HistoriqueArticle $historiqueArticle): self
    {
        if ($this->historiqueArticles->removeElement($historiqueArticle)) {
            $historiqueArticle->removeArticle($this);
        }

        return $this;
    }

    public function getReservePar(): ?User
    {
        return $this->reservePar;
    }

    public function setReservePar(?User $reservePar): self
    {
        $this->reservePar = $reservePar;

        return $this;
    }

    public function getStatus(): ?ArticleStatus
    {
        return $this->status;
    }

    public function setStatus(?ArticleStatus $status): self
    {
        $this->status = $status;

        return $this;
    }
}
