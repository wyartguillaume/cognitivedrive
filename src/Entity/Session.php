<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 */
class Session
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $vitesseMoyenne;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $angleDeviationMoyenne;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrTotaleButtonAcceleration;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrTotaleButtonFrein;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVitesseMoyenne(): ?float
    {
        return $this->vitesseMoyenne;
    }

    public function setVitesseMoyenne(?float $vitesseMoyenne): self
    {
        $this->vitesseMoyenne = $vitesseMoyenne;

        return $this;
    }

    public function getAngleDeviationMoyenne(): ?float
    {
        return $this->angleDeviationMoyenne;
    }

    public function setAngleDeviationMoyenne(?float $angleDeviationMoyenne): self
    {
        $this->angleDeviationMoyenne = $angleDeviationMoyenne;

        return $this;
    }

    public function getNbrTotaleButtonAcceleration(): ?int
    {
        return $this->nbrTotaleButtonAcceleration;
    }

    public function setNbrTotaleButtonAcceleration(?int $nbrTotaleButtonAcceleration): self
    {
        $this->nbrTotaleButtonAcceleration = $nbrTotaleButtonAcceleration;

        return $this;
    }

    public function getNbrTotaleButtonFrein(): ?int
    {
        return $this->nbrTotaleButtonFrein;
    }

    public function setNbrTotaleButtonFrein(?int $nbrTotaleButtonFrein): self
    {
        $this->nbrTotaleButtonFrein = $nbrTotaleButtonFrein;

        return $this;
    }
}
