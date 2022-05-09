<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Musique
 *
 * @ORM\Table(name="musique", indexes={@ORM\Index(name="id_listmusique", columns={"id_listmusique"})})
 * @ORM\Entity
 */
class Musique
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
     *
     * @ORM\Column(name="artist", type="string", length=255, nullable=false)
     */
    private $artist;

    /**
     * @var string
     *
     * @ORM\Column(name="album", type="string", length=255, nullable=false)
     */
    private $album;

    /**
     * @var int
     *
     * @ORM\Column(name="annee", type="integer", nullable=false)
     */
    private $annee;

    /**
     * @var string
     *
     * @ORM\Column(name="style", type="string", length=255, nullable=false)
     */
    private $style;

    /**
     * @var string
     *
     * @ORM\Column(name="importance", type="string", length=255, nullable=false)
     */
    private $importance;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=50, nullable=false)
     */
    private $titre;

    /**
     * @var \ListMusique
     *
     * @ORM\ManyToOne(targetEntity="ListMusique")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_listmusique", referencedColumnName="id")
     * })
     */
    private $idListmusique;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtist(): ?string
    {
        return $this->artist;
    }

    public function setArtist(string $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function getAlbum(): ?string
    {
        return $this->album;
    }

    public function setAlbum(string $album): self
    {
        $this->album = $album;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getStyle(): ?string
    {
        return $this->style;
    }

    public function setStyle(string $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function getImportance(): ?string
    {
        return $this->importance;
    }

    public function setImportance(string $importance): self
    {
        $this->importance = $importance;

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

    public function getIdListmusique()
    {
        return $this->idListmusique;
    }

    public function setIdListmusique(?ListMusique $idListmusique): self
    {
        $this->idListmusique = $idListmusique;

        return $this;
    }
}
