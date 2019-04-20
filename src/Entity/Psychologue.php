<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PsychologueRepository")
 * @UniqueEntity(
 * fields= {"email"},
 *  message= "L'email que vous avez indiqué est déja pris"
 * )
 */
class Psychologue implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max=20, maxMessage="Votre nom de famille doit faire 20 caractères maximum")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max=20, maxMessage="Votre prénom doit faire 20 caractères maximum")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage= "Mot de passe trop court")
     */
    private $motDePasse;

    /**
     * @Assert\EqualTo(propertyPath="motDePasse", message="Vous n'avez pas tapez le meme mot de passe")
     */
    public $confirm_motDePasse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Patient", mappedBy="psychologue")
     */
    private $patients;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        $this->patients = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }


    //security
    public function getUsername() {
        return $this->email;
    }

    public function eraseCredentials(){}

        public function getSalt(){}
        
        public function getRoles(){
            return ['ROLE_USER'];
         }
    
         public function getPassword(){
             return $this->motDePasse;
         }
    
         public function getConfirmMotDePasse(): ?string
         {
             return $this->confirm_motDePasse;
         }
         public function setConfirmMotDePasse(string $confirm_motDePasse): self
         {
             $this->confirm_motDePasse = $confirm_motDePasse;
             return $this;
         }

         /**
          * @return Collection|Patient[]
          */
         public function getPatients(): Collection
         {
             return $this->patients;
         }

         public function addPatient(Patient $patient): self
         {
             if (!$this->patients->contains($patient)) {
                 $this->patients[] = $patient;
                 $patient->setPsychologue($this);
             }

             return $this;
         }

         public function removePatient(Patient $patient): self
         {
             if ($this->patients->contains($patient)) {
                 $this->patients->removeElement($patient);
                 // set the owning side to null (unless already changed)
                 if ($patient->getPsychologue() === $this) {
                     $patient->setPsychologue(null);
                 }
             }

             return $this;
         }

         public function getToken(): ?string
         {
             return $this->token;
         }

         public function setToken(string $token): self
         {
             $this->token = $token;

             return $this;
         }

         public function getIsActive(): ?bool
         {
             return $this->isActive;
         }

         public function setIsActive(bool $isActive): self
         {
             $this->isActive = $isActive;

             return $this;
         }




}
