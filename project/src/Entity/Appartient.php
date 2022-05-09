<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Appartient
 *
 * @ORM\Table(name="Appartient", indexes={@ORM\Index(name="list_number", columns={"id_list"}), @ORM\Index(name="musique_number", columns={"id_musique"})})
 * @ORM\Entity
 */
class Appartient
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
     * @ORM\Column(name="importance", type="string", length=50, nullable=false)
     */
    private $importance;

    /**
     * @var \ListMusique
     *
     * @ORM\ManyToOne(targetEntity="ListMusique")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_list", referencedColumnName="id")
     * })
     */
    private $idList;

    /**
     * @var \Musique
     *
     * @ORM\ManyToOne(targetEntity="Musique")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_musique", referencedColumnName="id")
     * })
     */
    private $idMusique;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdList()
    {
        return $this->idList;
    }

    public function setIdList(?ListMusique $idList): self
    {
        $this->idList = $idList;

        return $this;
    }

    public function getIdMusique()
    {
        return $this->idMusique;
    }

    public function setIdMusique(?Musique $idMusique): self
    {
        $this->idMusique = $idMusique;

        return $this;
    }
}
