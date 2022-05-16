<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListMusique
 *
 * @ORM\Table(name="list_musique")
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
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_evenement", referencedColumnName="id")
     * })
     */
    private $idEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_list", type="string", nullable=false)
     */
    private $nomList;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEvenement()
    {
        return $this->idEvenement;
    }

    public function setIdEvenement(Evenement $idEvenement): self
    {
        $this->idEvenement = $idEvenement;

        return $this;
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
}
