<?php

namespace App\Entity;

use App\Repository\NatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=NatureRepository::class)
 * * @UniqueEntity(
 *  fields={"label"},
 *  message="Cette nature est déjà utilisé."
 * )
 */
class Nature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\ManyToMany(targetEntity=Article::class, mappedBy="natures")
     */
    private $articles;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, inversedBy="natures")
     */
    private $genres;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

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
            $article->addNature($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            $article->removeNature($this);
        }

        return $this;
    }

    // /**
    //  * @return Collection|Genre[]
    //  */
    // public function getGenres(): Collection
    // {
    //     return $this->genres;
    // }

    // public function addGenre(Genre $genre): self
    // {
    //     if (!$this->genres->contains($genre)) {
    //         $this->genres[] = $genre;
    //         $genre->addNature($this);
    //     }

    //     return $this;
    // }

    // public function removeGenre(Genre $genre): self
    // {
    //     if ($this->genres->removeElement($genre)) {
    //         $genre->removeNature($this);
    //     }

    //     return $this;
    // }

    // /**
    //  * @return Collection|Genre[]
    //  */
    // public function getGenresTer(): Collection
    // {
    //     return $this->genresTer;
    // }

    // public function addGenresTer(Genre $genresTer): self
    // {
    //     if (!$this->genresTer->contains($genresTer)) {
    //         $this->genresTer[] = $genresTer;
    //     }

    //     return $this;
    // }

    // public function removeGenresTer(Genre $genresTer): self
    // {
    //     $this->genresTer->removeElement($genresTer);

    //     return $this;
    // }

    /**
     * @return Collection|Genre[]
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genres->removeElement($genre);

        return $this;
    }
}
