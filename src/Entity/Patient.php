<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatientRepository")
 */
class Patient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDeNaissance;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lateralite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $groupe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profession;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etatCivil;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrEnfants;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrVisite;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDerniereVisite;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $troubleDeSommeil;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Psychologue", inversedBy="patients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $psychologue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->dateDeNaissance;
    }

    public function setDateDeNaissance(?\DateTimeInterface $dateDeNaissance): self
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }

    public function getSexe(): ?bool
    {
        return $this->sexe;
    }

    public function setSexe(bool $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getLateralite(): ?string
    {
        return $this->lateralite;
    }

    public function setLateralite(string $lateralite): self
    {
        $this->lateralite = $lateralite;

        return $this;
    }

    public function getGroupe(): ?string
    {
        return $this->groupe;
    }

    public function setGroupe(string $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(?string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getEtatCivil(): ?string
    {
        return $this->etatCivil;
    }

    public function setEtatCivil(?string $etatCivil): self
    {
        $this->etatCivil = $etatCivil;

        return $this;
    }

    public function getNbrEnfants(): ?int
    {
        return $this->nbrEnfants;
    }

    public function setNbrEnfants(?int $nbrEnfants): self
    {
        $this->nbrEnfants = $nbrEnfants;

        return $this;
    }

    public function getNbrVisite(): ?int
    {
        return $this->nbrVisite;
    }

    public function setNbrVisite(int $nbrVisite): self
    {
        $this->nbrVisite = $nbrVisite;

        return $this;
    }

    public function getDateDerniereVisite(): ?\DateTimeInterface
    {
        return $this->dateDerniereVisite;
    }

    public function setDateDerniereVisite(\DateTimeInterface $dateDerniereVisite): self
    {
        $this->dateDerniereVisite = $dateDerniereVisite;

        return $this;
    }

    public function getTroubleDeSommeil(): ?bool
    {
        return $this->troubleDeSommeil;
    }

    public function setTroubleDeSommeil(?bool $troubleDeSommeil): self
    {
        $this->troubleDeSommeil = $troubleDeSommeil;

        return $this;
    }

    public function getPsychologue(): ?Psychologue
    {
        return $this->psychologue;
    }

    public function setPsychologue(?Psychologue $psychologue): self
    {
        $this->psychologue = $psychologue;

        return $this;
    }
}
