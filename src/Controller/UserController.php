<?php 
namespace App\Controller;
use App\Entity\Psychologue;
use App\Entity\Patient;
use App\Form\InscriptionType;
use App\Form\InscriptionPatientType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\Mapping\Id;
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
    public function connexionPatient()
    {
       return $this->render('user/connexxionPatient.html.twig');
    }

     /**
     * @Route("/inscriptionPatient", name="inscription_patient")
     */
    public function inscriptionPatient(Request $request, ObjectManager $manager){
        $date = new \DateTime('@'.strtotime('now'));
        $patient = new Patient();
        $psychologue = new Psychologue();
        $form = $this->createForm(InscriptionPatientType::class, $patient);

        $form->handleRequest($request);
        $x = 0; 
        if($form->isSubmitted() && $form->isValid()){
            $patient->setNbrVisite($x++)
                    ->setTroubleDeSommeil(false)
                    ->setDateDerniereVisite($date)
                    ->setPsychologue($psychologue->getId(1));
                    
            $manager->persist($patient);
            $manager->flush();
            return $this->redirectToRoute('acceuil');
         }
    return $this->render('user/inscriptionPatient.html.twig', [
        'form' => $form->createView()
        ]);
    }

}