<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\Session;
use App\Entity\Psychologue;
use App\Repository\PatientRepository;
use App\Repository\PsychologueRepository;
use Symfony\Component\Serializer\Serializer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CarSimulGameController extends AbstractController
{
    /**
     * @Route("/gameInsPsy", name="carSimulInscriptionPsy")
     */
    public function InscriptionGamePsycho(UserPasswordEncoderInterface $encoder, ObjectManager $manager)
    {
        $nom = $_POST['nomPost'];
        $prenom = $_POST['prenomPost'];
        $email = $_POST['emailPost'];
        $mdp = $_POST['mdpPost'];
    
        $psychologue = new Psychologue();
        $hash = $encoder->encodePassword($psychologue, $psychologue->getMotDePasse());
        $psychologue->setNom($nom)
                    ->setPrenom($prenom)
                    ->setEmail($email)
                    ->setMotDePasse($hash);
                    $manager->persist($psychologue);
                    $manager->flush();
                    return new Response();
    }

    /**
     * @Route("/gameInsPat/{id}", name="carSimulInscriptionPat")
     */

    public function InscriptionGamePatient( Psychologue $psychologue, ObjectManager $manager, PatientRepository $repoPat)
    {
        $pseudo = $_POST['pseudoPost'];

        //$psy = $_POST['psychoPost'];
        $dateDeNAissance = $_POST['dateDeNaissancePost'];
        $sexe = $_POST['sexePost'];
        $lateralite = $_POST['lateralitePost'];
        $groupe = $_POST['groupPost'];
        $nom = $_POST['nomPost'];
        $prenom = $_POST['prenomPost'];
        $email = $_POST['emailPost'];
        $profession = $_POST['professionPost'];
        $etatCivil = $_POST['etatCivilPost'];
        $nbrEnfant = $_POST['nbrEnfantPost'];
        $dateNaiss = new \DateTime($dateDeNAissance);
        $date =  new \DateTime('@'.strtotime('now'));
        $nbrVisite = 0; 
        $patient = new Patient();

        $patient->setPseudo($pseudo)
                ->setPsychologue($psychologue)
                ->setDateDeNaissance($dateNaiss)
                ->setSexe($sexe)
                ->setLateralite($lateralite)
                ->setGroupe($groupe)
                ->setNom($nom)
                ->setPrenom($prenom)
                ->setEmail($email)
                ->setProfession($profession)
                ->setEtatCivil($etatCivil)
                ->setNbrEnfants($nbrEnfant)
                ->setNbrVisite(1)
                ->setDateDerniereVisite($date)
                ->setTroubleDeSommeil(false);
                    $manager->persist($patient);
                    $manager->flush();
                    return new Response();
    }

    /**
     * @Route("/gameConnexionPsycho", name="carSimulConnexionPsy")
     */
    public function ConnexionPsy(UserPasswordEncoderInterface $encoder, ObjectManager $manager, PsychologueRepository $repoPsy, PatientRepository $repoPat){
        $psycho = $manager->createQuery("SELECT p.email, p.motDePasse FROM App\Entity\Psychologue p")->getResult();
        $mdp = $_POST['mdpPost'];
        $email = $_POST['email'];
        $psy = $repoPsy->findOneBy(["email"=>$email]);
        $check = $encoder->isPasswordValid($psy, $mdp);
        if(!$check){
            return false;
        }
        else{
        return $this->json($psycho, 200, [], [
            ObjectNormalizer::ATTRIBUTES => [
                'email',
                'motDePasse'
            ]
        ]);
            }

        
            
    }

    /**
     * @Route("/gameConnexionPatient", name="carSimulConnexionPatient")
     */
    public function ConnexionPatient(ObjectManager $manager, PatientRepository $repoPat){
        $patient = $manager->createQuery("SELECT p.pseudo, p.dateDeNaissance, p.lateralite, p.groupe FROM App\Entity\Patient p")->getResult();
   
    return $this->json($patient, 200, [], [
        ObjectNormalizer::ATTRIBUTES => [
            'pseudo',
            'dateDeNaissance',
            'lateralite',
            'groupe'
        ]
    ]);
    }

    /**
     * @Route("/gameCreateDropdown", name="carSimulCreateDropdown")
    */
    public function CreateDropdown(ObjectManager $manager, PsychologueRepository $repoPsy, PatientRepository $repoPat)
    {
    $psycho = $manager->createQuery("SELECT p.id, p.nom, p.prenom FROM App\Entity\Psychologue p")->getResult();
   
    return $this->json($psycho, 200, [], [
        ObjectNormalizer::ATTRIBUTES => [
            'id',
            'nom',
            'prenom'
        ]
    ]);

    }

     /**
     * @Route("/gameCreateSessionLevel1/{id}", name="carSimulCreateSessionLevel1")
    */
    public function CreateSession(Patient $patient, ObjectManager $manager)
    {
        $vitesseMoyenne = $_POST["vitesseMoyenne"];
        $nbrButtonAcceleration = $_POST["nbrAcceleration"];
        $nbrButtonBrake = $_POST["nbrBrake"];
        $dateSession = $_POST["dateSession"];
        $rencontreRouteGauche = $_POST["RencontreRouteGauche"];
        $rencontreRouteDroite = $_POST["RencontreRouteDroite"];
        $level = $_POST["Level"];
        $choixJourNuit = $_POST["ChoixJourNuit"];
        $tempsSortieGauche = $_POST["TempsSortieGauche"];
        $tempsSortieDroite = $_POST["TempsSortieDroite"];

        

        $session = new Session();
        $session->setVitesseMoyenne($vitesseMoyenne)
                ->setPatient($patient)
                ->setNbrTotaleButtonAcceleration($nbrButtonAcceleration)
                ->setNbrTotaleButtonFrein($nbrButtonBrake)
                ->setDateSession($dateSession)
                ->setNbrRencontreRouteDroite($rencontreRouteDroite)
                ->setNbrRencontreRouteGauche($rencontreRouteGauche)
                ->setLevel($level)
                ->setChoixJourNuit($choixJourNuit);

        $manager->persist($session);
        $manager->flush();

        return new Response();


    }

     /**
     * @Route("/gameCreateSessionLevel2/{id}", name="carSimulCreateSessionLevel2")
    */
    public function CreateSessionLevel2(Patient $patient, ObjectManager $manager)
    {
        $vitesseMoyenne = $_POST["vitesseMoyenne"];
        $nbrButtonAcceleration = $_POST["nbrAcceleration"];
        $nbrButtonBrake = $_POST["nbrBrake"];
        $dateSession = $_POST["dateSession"];
        $rencontreRouteGauche = $_POST["RencontreRouteGauche"];
        $rencontreRouteDroite = $_POST["RencontreRouteDroite"];
        $vitesseMoyenneZoneObstacle = $_POST["VitesseMoyenneZoneObstacle"];
        $tempsReaction = $_POST["TempsReaction"];
        $nbrPietonsToucheDroit= $_POST["NbrPietonsToucheDroit"];
        $nbrPietonsToucheGauche = $_POST["NbrPietonsToucheGauche"];
        $nbrAnimalToucheDroit = $_POST["NbrAnimalToucheDroit"];
        $nbrAnimalToucheGauche = $_POST["NbrAnimalToucheGauche"];
        $nbrTotalObstacleToucheDroite = $_POST["NbrTotalObstacleToucheDroite"];
        $nbrTotalObstacleToucheGauche = $_POST["NbrTotalObstacleToucheGauche"];
        $level = $_POST["Level"];
        $choixJourNuit = $_POST["ChoixJourNuit"];
        $tempsSortieGauche = $_POST["TempsSortieGauche"];
        $tempsSortieDroite = $_POST["TempsSortieDroite"];
        

        $session = new Session();
        $session->setVitesseMoyenne($vitesseMoyenne)
                ->setPatient($patient)
                ->setNbrTotaleButtonAcceleration($nbrButtonAcceleration)
                ->setNbrTotaleButtonFrein($nbrButtonBrake)
                ->setDateSession($dateSession)
                ->setNbrRencontreRouteDroite($rencontreRouteDroite)
                ->setNbrRencontreRouteGauche($rencontreRouteGauche)
                ->setVitesseMoyenneZoneObstacle($vitesseMoyenneZoneObstacle)
                ->setTempsDeReaction($tempsReaction)
                ->setNbrAnimalToucheDroite($nbrAnimalToucheDroit)
                ->setNbrAnimalToucheGauche($nbrAnimalToucheGauche)
                ->setNbrSortieTimerDroite($tempsSortieDroite)
                ->setNbrSortieTimerGauche($tempsSortieGauche)
                ->setLevel($level)
                ->setNbrTouchePietonsDroit($nbrPietonsToucheDroit)
                ->setNbrTouchePietonsGauche($nbrPietonsToucheGauche)
                ->setNbrTotalObstacleToucheDroit($nbrTotalObstacleToucheDroite)
                ->setNbrTotalObstacleToucheGauche($nbrTotalObstacleToucheGauche)
                ->setChoixJourNuit($choixJourNuit);

        $manager->persist($session);
        $manager->flush();

        return new Response();


    }

     /**
     * @Route("/gameCreateSessionLevel3/{id}", name="carSimulCreateSessionLevel3")
    */
    public function CreateSessionLevel3(Patient $patient, ObjectManager $manager)
    {
        $vitesseMoyenne = $_POST["vitesseMoyenne"];
        $nbrButtonAcceleration = $_POST["nbrAcceleration"];
        $nbrButtonBrake = $_POST["nbrBrake"];
        $dateSession = $_POST["dateSession"];
        $rencontreRouteGauche = $_POST["RencontreRouteGauche"];
        $rencontreRouteDroite = $_POST["RencontreRouteDroite"];
        $tempsSortieGauche = $_POST["TempsSortieGauche"];
        $tempsSortieDroite = $_POST["TempsSortieDroite"];
        $nbrVoitureTropProche = $_POST["NbrVoitureTropProche"];
        

        $session = new Session();
        $session->setVitesseMoyenne($vitesseMoyenne)
                ->setPatient($patient)
                ->setNbrTotaleButtonAcceleration($nbrButtonAcceleration)
                ->setNbrTotaleButtonFrein($nbrButtonBrake)
                ->setDateSession($dateSession)
                ->setNbrRencontreRouteDroite($rencontreRouteDroite)
                ->setNbrRencontreRouteGauche($rencontreRouteGauche)
                ->setNbrSortieTimerDroite($tempsSortieDroite)
                ->setNbrSortieTimerGauche($tempsSortieGauche)
                ->setNbrVoitureTropProche($nbrVoitureTropProche)
                ->setLevel($level)
                ->setChoixJourNuit($choixJourNuit);

        $manager->persist($session);
        $manager->flush();

        return new Response();


    }





}
