<?php 
namespace App\Controller;
use App\Entity\Patient;
use App\Entity\Psychologue;
use Doctrine\ORM\Mapping\Id;
use App\Form\InscriptionType;
use App\Form\ConnexionPatientType;
use App\Form\InscriptionPatientType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
           $hash = $encoder->encodePassword($psychologue, $psychologue->getMotDePasse());
            $psychologue->setMotDePasse($hash);
            $manager->persist($psychologue);
            $manager->flush();
            return $this->redirectToRoute('connexion_user');
        }
        return $this->render('user/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/connexion", name="connexion_user")
     */
    public function connexion()
    {
        return $this->render('user/connexion.html.twig');
    }
    /**
     * @Route("/deconnexion", name="deconnexion_user")
     */
    public function deconnexion() {}

        /**
     * @Route("/connexionPatient", name="connexion_patient")
     */
    public function connexionPatient(Request $request, ObjectManager $manager)
    {
        $patient = new Patient();
        $form = $this->createForm(ConnexionPatientType::class, $patient);
        $form->handleRequest($request);
        $pseudo = $manager->createQuery('SELECT p.pseudo FROM App\Entity\Patient p')->getResult();

        foreach($pseudo as $key => $value){
            foreach($value as $p => $nom){
                if($nom == $patient->getPseudo()){
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
            $patient->setNbrVisite($x++)
                    ->setTroubleDeSommeil(false)
                    ->setDateDerniereVisite($date);

            $manager->persist($patient);
            $manager->flush();
            return $this->redirectToRoute('connexion_patient');
         }
    return $this->render('user/inscriptionPatient.html.twig', [
        'form' => $form->createView()
        ]);
    }

}