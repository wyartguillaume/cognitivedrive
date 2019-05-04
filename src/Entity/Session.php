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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="sessions")
     */
    private $patient;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NbrRencontreRouteDroite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NbrRencontreRouteGauche;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $VitesseMoyenneZoneObstacle;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $TempsDeReaction;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrTouchePietonsDroit;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrTouchePietonsGauche;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NbrAnimalToucheGauche;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NbrAnimalToucheDroite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NbrTotalObstacleToucheDroit;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NbrTotalObstacleToucheGauche;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $level;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ChoixJourNuit;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NbrSortieTimerGauche;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NbrSortieTimerDroite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NbrVoitureTropProche;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dateSession;

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

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getNbrRencontreRouteDroite(): ?int
    {
        return $this->NbrRencontreRouteDroite;
    }

    public function setNbrRencontreRouteDroite(?int $NbrRencontreRouteDroite): self
    {
        $this->NbrRencontreRouteDroite = $NbrRencontreRouteDroite;

        return $this;
    }

    public function getNbrRencontreRouteGauche(): ?int
    {
        return $this->NbrRencontreRouteGauche;
    }

    public function setNbrRencontreRouteGauche(?int $NbrRencontreRouteGauche): self
    {
        $this->NbrRencontreRouteGauche = $NbrRencontreRouteGauche;

        return $this;
    }

    public function getVitesseMoyenneZoneObstacle(): ?float
    {
        return $this->VitesseMoyenneZoneObstacle;
    }

    public function setVitesseMoyenneZoneObstacle(?float $VitesseMoyenneZoneObstacle): self
    {
        $this->VitesseMoyenneZoneObstacle = $VitesseMoyenneZoneObstacle;

        return $this;
    }

    public function getTempsDeReaction(): ?float
    {
        return $this->TempsDeReaction;
    }

    public function setTempsDeReaction(?float $TempsDeReaction): self
    {
        $this->TempsDeReaction = $TempsDeReaction;

        return $this;
    }

    public function getNbrTouchePietonsDroit(): ?int
    {
        return $this->nbrTouchePietonsDroit;
    }

    public function setNbrTouchePietonsDroit(?int $nbrTouchePietonsDroit): self
    {
        $this->nbrTouchePietonsDroit = $nbrTouchePietonsDroit;

        return $this;
    }

    public function getNbrTouchePietonsGauche(): ?int
    {
        return $this->nbrTouchePietonsGauche;
    }

    public function setNbrTouchePietonsGauche(?int $nbrTouchePietonsGauche): self
    {
        $this->nbrTouchePietonsGauche = $nbrTouchePietonsGauche;

        return $this;
    }

    public function getNbrAnimalToucheGauche(): ?int
    {
        return $this->NbrAnimalToucheGauche;
    }

    public function setNbrAnimalToucheGauche(?int $NbrAnimalToucheGauche): self
    {
        $this->NbrAnimalToucheGauche = $NbrAnimalToucheGauche;

        return $this;
    }

    public function getNbrAnimalToucheDroite(): ?int
    {
        return $this->NbrAnimalToucheDroite;
    }

    public function setNbrAnimalToucheDroite(?int $NbrAnimalToucheDroite): self
    {
        $this->NbrAnimalToucheDroite = $NbrAnimalToucheDroite;

        return $this;
    }

    public function getNbrTotalObstacleToucheDroit(): ?int
    {
        return $this->NbrTotalObstacleToucheDroit;
    }

    public function setNbrTotalObstacleToucheDroit(?int $NbrTotalObstacleToucheDroit): self
    {
        $this->NbrTotalObstacleToucheDroit = $NbrTotalObstacleToucheDroit;

        return $this;
    }

    public function getNbrTotalObstacleToucheGauche(): ?int
    {
        return $this->NbrTotalObstacleToucheGauche;
    }

    public function setNbrTotalObstacleToucheGauche(?int $NbrTotalObstacleToucheGauche): self
    {
        $this->NbrTotalObstacleToucheGauche = $NbrTotalObstacleToucheGauche;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(?string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getChoixJourNuit(): ?string
    {
        return $this->ChoixJourNuit;
    }

    public function setChoixJourNuit(?string $ChoixJourNuit): self
    {
        $this->ChoixJourNuit = $ChoixJourNuit;

        return $this;
    }

    public function getNbrSortieTimerGauche(): ?string
    {
        return $this->NbrSortieTimerGauche;
    }

    public function setNbrSortieTimerGauche(?string $NbrSortieTimerGauche): self
    {
        $this->NbrSortieTimerGauche = $NbrSortieTimerGauche;

        return $this;
    }

    public function getNbrSortieTimerDroite(): ?string
    {
        return $this->NbrSortieTimerDroite;
    }

    public function setNbrSortieTimerDroite(?string $NbrSortieTimerDroite): self
    {
        $this->NbrSortieTimerDroite = $NbrSortieTimerDroite;

        return $this;
    }

    public function getNbrVoitureTropProche(): ?int
    {
        return $this->NbrVoitureTropProche;
    }

    public function setNbrVoitureTropProche(?int $NbrVoitureTropProche): self
    {
        $this->NbrVoitureTropProche = $NbrVoitureTropProche;

        return $this;
    }

    public function getDateSession(): ?string
    {
        return $this->dateSession;
    }

    public function setDateSession(?string $dateSession): self
    {
        $this->dateSession = $dateSession;

        return $this;
    }
}
