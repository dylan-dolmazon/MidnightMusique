<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListMusique
 *
 * @ORM\Table(name="List_musique", indexes={@ORM\Index(name="id_evenement", columns={"id_evenement"})})
 * @ORM\Entity
 */
class ListMusique
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
     * @ORM\Column(name="nom_list", type="string", length=180, nullable=false)
     */
    private $nomList;

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_evenement", referencedColumnName="id")
     * })
     */
    private $idEvenement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomList(): ?string
    {
        return $this->nomList;
    }

    public function setNomList(string $nomList): self
    {
        $this->nomList = $nomList;

        return $this;
    }

    public function getIdEvenement()
    {
        return $this->idEvenement;
    }

    public function setIdEvenement(?Evenement $idEvenement): self
    {
        $this->idEvenement = $idEvenement;

        return $this;
    }
}
