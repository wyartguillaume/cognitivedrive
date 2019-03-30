<?php 
namespace App\Controller;
use App\Entity\Patient;
use App\Entity\Psychologue;
use Doctrine\ORM\Mapping\Id;
use App\Form\InscriptionType;
use App\Form\ConnexionPatientType;
use App\Form\InscriptionPatientType;
use App\Repository\PatientRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription_user")
     */
    public function inscription(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $psychologue = new Psychologue();
        $form = $this->createForm(InscriptionType::class, $psychologue);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $secret = "6Le0DpsUAAAAAI-SEJXK09HZ57KpIMrIqO3AP8n9";
	// Paramètre renvoyé par le recaptcha
	$response = $_POST['g-recaptcha-response'];
	// On récupère l'IP de l'utilisateur
	$remoteip = $_SERVER['REMOTE_ADDR'];
	
	$api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
	    . $secret
	    . "&response=" . $response
	    . "&remoteip=" . $remoteip ;
	
	$decode = json_decode(file_get_contents($api_url), true);
	
	if ($decode['success'] == true) {
        $hash = $encoder->encodePassword($psychologue, $psychologue->getMotDePasse());
            $psychologue->setMotDePasse($hash);
            $manager->persist($psychologue);
            $manager->flush();
	}
	
	else {
        // C'est un robot ou le code de vérification est incorrecte
	}
            return $this->redirectToRoute('connexion_user');
        }
        return $this->render('user/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/connexion", name="connexion_user")
     */
    public function connexion(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('user/connexion.html.twig', [
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }
    /**
     * @Route("/deconnexion", name="deconnexion_user")
     */
    public function deconnexion() {}

        /**
     * @Route("/connexionPatient", name="connexion_patient")
     */
    public function connexionPatient(Request $request, ObjectManager $manager, PatientRepository $repo)
    {
        $date = new \DateTime('@'.strtotime('now'));
        $patient = new Patient();
        $form = $this->createForm(ConnexionPatientType::class, $patient);
        $form->handleRequest($request);
        $pseudo = $manager->createQuery('SELECT p.pseudo FROM App\Entity\Patient p')->getResult();

        foreach($pseudo as $key => $value){
            foreach($value as $p => $nom){
                if($nom == $patient->getPseudo() && $form->isSubmitted() && $form->isValid()){
                    $patient->setDateDerniereVisite($date);
                    $manager->flush();
                    return $this->redirectToRoute('acceuil');
                }
                else{$error="Pseudo inexistant!!!";}
                ;
            }
        }
    
       return $this->render('user/connexionPatient.html.twig', [
        'form' => $form->createView(),
        'error' => $error
        
       ]);
    }

     /**
     * @Route("/inscriptionPatient", name="inscription_patient")
     */
    public function inscriptionPatient(Request $request, ObjectManager $manager){
        $date = new \DateTime('@'.strtotime('now'));
        $patient = new Patient();
       // $psychologue = new Psychologue();
        /*$psychologue = $manager->createQuery('SELECT p FROM App\Entity\Psychologue p')->getResult();
        dump($psychologue);*/
        $form = $this->createForm(InscriptionPatientType::class, $patient);

        $form->handleRequest($request);
        $x = 0; 
        if($form->isSubmitted() && $form->isValid()){
            $secret = "6Le0DpsUAAAAAI-SEJXK09HZ57KpIMrIqO3AP8n9";
            $response = $_POST['g-recaptcha-response'];
	// On récupère l'IP de l'utilisateur
	$remoteip = $_SERVER['REMOTE_ADDR'];
	
	$api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
	    . $secret
	    . "&response=" . $response
	    . "&remoteip=" . $remoteip ;
	
	$decode = json_decode(file_get_contents($api_url), true);
	
	if ($decode['success'] == true) {
            $patient->setNbrVisite($x++)
                    ->setTroubleDeSommeil(false)
                    ->setDateDerniereVisite($date);

            $manager->persist($patient);
            $manager->flush();
         }
         else {
            // C'est un robot ou le code de vérification est incorrecte
         }
        }
    return $this->render('user/inscriptionPatient.html.twig', [
        'form' => $form->createView()
        ]);
    }



}
