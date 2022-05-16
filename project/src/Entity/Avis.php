<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 *
 * @ORM\Table(name="Avis")
 * @ORM\Entity
 */
class Avis
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
     * @ORM\Column(name="occasion", type="string", length=100, nullable=false)
     */
    private $occasion;

    /**
     * @var int
     *
     * @ORM\Column(name="note", type="integer", nullable=false)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=500, nullable=false)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255, nullable=false)
     */
    private $auteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOccasion(): ?string
    {
        return $this->occasion;
    }

    public function setOccasion(string $occasion): self
    {
        $this->occasion = $occasion;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }


}
