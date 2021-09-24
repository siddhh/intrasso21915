<?php

namespace App\Entity;

use App\Repository\AuteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Utils\ChaineDeCaracteres;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Validator\ValidatorInterface;

<<<<<<< HEAD
=======

>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
/**
 * @ORM\Entity(repositoryClass=AuteurRepository::class)
 * @ORM\HasLifecycleCallbacks()
 *  * @UniqueEntity(
 *     fields={"prenom","nom"},
 *     message="nomPrenomUnique"
 * )
 */
class Auteur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    // /**
    //  * @ORM\ManyToMany(targetEntity=ListeObjets::class, mappedBy="auteurs")
    //  */
    // private $listeObjets;

    /**
     * @ORM\ManyToMany(targetEntity=Article::class, mappedBy="auteurs")
     */
    private $articles;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateSuppression;

    public function __construct()
    {
        //$this->listeObjets = new ArrayCollection();
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNomComplet(): string
    {
        return ChaineDeCaracteres::nomPrenom($this->getNom(), $this->getPrenom());
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
            $article->addAuteur($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            $article->removeAuteur($this);
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

    public function getDateSuppression(): ?\DateTimeInterface
    {
        return $this->dateSuppression;
    }

    public function setDateSuppression(?\DateTimeInterface $dateSuppression): self
    {
        $this->dateSuppression = $dateSuppression;

        return $this;
    }
}
