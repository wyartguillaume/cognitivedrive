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
        $patient = new Patient();
        $form = $this->createForm(InscriptionPatientType::class, $patient);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($patient);
            $manager->flush();
            return $this->redirectToRoute('connexion_patient');
         }
    return $this->render('user/inscriptionPatient.html.twig', [
        'form' => $form->createView()
        ]);
    }

}
