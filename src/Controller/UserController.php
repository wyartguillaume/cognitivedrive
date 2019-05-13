<?php 
namespace App\Controller;
use App\Entity\Patient;
use App\Form\AccountType;
use App\Entity\Psychologue;
use Doctrine\ORM\Mapping\Id;
use App\Form\InscriptionType;
use App\Entity\PasswordUpdate;
use App\Form\PasswordUpdateType;
use App\Form\ConnexionPatientType;
use App\Form\InscriptionPatientType;
use App\Repository\PatientRepository;
use Symfony\Component\Form\FormError;
use App\Repository\PsychologueRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription_user")
     */
    public function inscription(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer)
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
	
	       // if ($decode['success'] == true) {
                 $hash = $encoder->encodePassword($psychologue, $psychologue->getMotDePasse());
                 $psychologue->setMotDePasse($hash);
                 $manager->persist($psychologue);
                 $manager->flush();
                 $this->addFlash("success", "Veuillez confirmer votre compte ".$psychologue->getEmail());
            $message = (new \Swift_Message("Confirmation de votre compte"))
                ->setFrom("verification@cognitivedrive.be")
                ->setTo($psychologue->getEmail())
                ->setBody($this->renderView("user/verifCompte.html.twig", [
                    "user"=>$psychologue
                ]), "text/html");
            $mailer->send($message);

            return $this->redirectToRoute('connexion_user');
	      //  }
	
	       // else {
              // C'est un robot ou le code de vérification est incorrecte
           // }
            //dump($psychologue);
           // die();

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
        $inactivAccount = null;
        $cache = new FilesystemCache();
        if($cache->has("error")) //on recupere une valeur qui se trouve dans error
        {
            $inactivAccount = $cache->get("error");
            $cache->delete("error");
        }
        return $this->render('user/connexion.html.twig', [
            'hasError' => $error !== null,
            'username' => $username,
            'inactiveAccount'=>$inactivAccount
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
        $tmp = false;
        $nbrfois = 0;
        $patient = new Patient();
        $form = $this->createForm(ConnexionPatientType::class, $patient);
        $form->handleRequest($request);
        $pseudo = $manager->createQuery('SELECT p.pseudo FROM App\Entity\Patient p')->getResult();

        foreach($pseudo as $key => $value){
            foreach($value as $p => $nom){
                if($nom == $patient->getPseudo() && $form->isSubmitted() && $form->isValid()){
                    $patient->setDateDerniereVisite($date);
                    $manager->flush();
                    $tmp = true;
                    return $this->redirectToRoute('acceuil');
                }
                else {$nbrfois += 1;}
            }
        }
        if($tmp == false && $nbrfois >8){
            $this->addFlash("warning", "pseudo incorrect!");
        }
    
       return $this->render('user/connexionPatient.html.twig', [
        'form' => $form->createView()
        
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
	
	    //if ($decode['success'] == true) {
            $patient->setNbrVisite($x++)
                    ->setTroubleDeSommeil(false)
                    ->setDateDerniereVisite($date);

            $manager->persist($patient);
            $manager->flush();
        }
       //  else {
            // C'est un robot ou le code de vérification est incorrecte
        // }
       // }
    return $this->render('user/inscriptionPatient.html.twig', [
        'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/verifCompte/{token}", name="account_confirm")
     */
    public function accountConfirm($token, PsychologueRepository $repo, ObjectManager $manager){
        $psycho = $repo->findOneByToken($token);

        $psycho->setIsActive(true);
        $manager->persist($psycho);
        
        $manager->flush();
        $this->addFlash("warning", "Votre compte est confirmé!");
        return $this->redirectToRoute('connexion_user');
        
    }

    



}
