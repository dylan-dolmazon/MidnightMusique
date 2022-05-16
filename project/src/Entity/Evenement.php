<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="Evenement")
 * @ORM\Entity
 */
class Evenement
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string|null
     *
     * @ORM\Column(name="theme", type="string", length=255, nullable=true)
     */
    private $theme;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nb_invite", type="integer", nullable=true)
     */
    private $nbInvite;

    /**
     * @var string
     *
     * @ORM\Column(name="occasion", type="string", length=255, nullable=false)
     */
    private $occasion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lieux", type="string", length=255, nullable=true)
     */
    private $lieux;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=180, nullable=false)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(?string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getNbInvite(): ?int
    {
        return $this->nbInvite;
    }

    public function setNbInvite(?int $nbInvite): self
    {
        $this->nbInvite = $nbInvite;

        return $this;
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

    public function getLieux(): ?string
    {
        return $this->lieux;
    }

    public function setLieux(?string $lieux): self
    {
        $this->lieux = $lieux;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


}
