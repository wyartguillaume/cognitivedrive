<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\Psychologue;
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
                    ->setMotDePasse($hash)
                    ->setToken('a')
                    ->setIsActive(false);
                    $manager->persist($psychologue);
                    $manager->flush();
                    return new Response();
    }

    /**
     * @Route("/gameInsPat", name="carSimulInscriptionPat")
     */

    public function InscriptionGamePatient(ObjectManager $manager, PsychologueRepository $repoPsy)
    {
        $date =  new \DateTime('@'.strtotime('now'));
        $pseudo = $_POST['pseudoPost'];
        $psy = $_POST['psychoPost'];
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

        $nbrVisite = 0; 
     
    
       // $hash = $encoder->encodePassword($psychologue, $psychologue->getMotDePasse());
        $patient = new Patient();
        $patient->setPseudo($pseudo)
                ->setPsychologue($pseud)
                ->setDateDeNaissance($dateDeNAissance)
                ->setSexe($sexe)
                ->setLateralite($lateralite)
                ->setGroupe($groupe)
                ->setNom($nom)
                ->setPrenom($prenom)
                ->setEmail($email)
                ->setProfession($profession)
                ->setEtatCivil($etatCivil)
                ->setNbrEnfants($nbrEnfant)
                ->setNbrVisite($nbrVisite++)
                ->setDateDerniereVisite($date)
                ->setTroubleDeSommeil(false);
                    $manager->persist($psychologue);
                    $manager->flush();
                    return new Response();
    }

    /**
     * @Route("/gameInsPatJson", name="carSimulInscriptionPatJson")
    */
    public function InscriptionGamePatientJson(ObjectManager $manager, PsychologueRepository $repoPsy)
    {

    $psycho = $repoPsy->findAll();
    $encoders = [new XmlEncoder(), new JsonEncoder()];
    $normalizers = [new ObjectNormalizer()];

    $serializer = new Serializer($normalizers, $encoders);
    $jsonContent = $serializer->serialize($psycho, 'json');
    return new Response($jsonContent);
    }


}
