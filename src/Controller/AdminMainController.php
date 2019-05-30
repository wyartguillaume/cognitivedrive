<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Form\AccountType;
use App\Entity\Psychologue;
use App\Form\InscriptionPatientType;
use App\Repository\PatientRepository;
use App\Repository\PsychologueRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminMainController extends AbstractController
{
    /**
     * @Route("/admin/main/psycho", name="admin_main_psycho")
     */
    public function listeUtilisateurs(PsychologueRepository $repo)
    {
        $psycho = $repo->findAll();
        return $this->render('admin/main/index.html.twig', [
            'psycho' => $psycho
        ]);
    }

    /**
     * Supprime un psychologue
     * @Route("/admin/main/psychologue/delete/{id}", name="admin_psychologue_delete")
     * @param Psychologue $psychologue
     * @param ObjectManager $manager
     * @return void
     */
    public function deletePsy(Psychologue $psychologue, ObjectManager $manager){
        if(count($psychologue->getPatients()) > 0){
            $this->addFlash(
                'success',
                "Vous ne pouvez pas supprimer ce psychologue car il possède plusieurs patients"
            );
        }
        else{
        $manager->remove($psychologue);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le psychologue {$psychologue->getNom()} a bien été supprimé"
        );
    }
    return $this->redirectToRoute('admin_main_psycho');
}

    /**
     * @Route("/admin/main/patient", name="admin_main_patient")
     */
    public function listePatient(PatientRepository $repo)
    {
        $patient = $repo->findAll();
        return $this->render('admin/main/patient.html.twig', [
            'patient' => $patient
        ]);
    }

     /**
     * Affiche et traite les modifications de profil des patients
     * @Route("admin/main/patient/{id}", name="admin_patient_edit")
     * @return void
     */
    public function profile(Patient $patient, Request $request, ObjectManager $manager) {
        
        $form = $this->createForm(InscriptionPatientType::class, $patient);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($patient);
            $manager->flush();

            $this->addFlash(
                'success',
                "les données du profil ont été modifiées avec succès !"
            );
        }

        return $this->render('admin/main/editPatient.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient
        ]);
    }

    /**
     * Supprime un patient
     * @Route("/admin/main/patient/delete/{id}", name="admin_patient_delete")
     * @param Patient $patient
     * @param ObjectManager $manager
     * @return void
     */
    public function deletePat(Patient $patient, ObjectManager $manager){
        if(count($patient->getSessions()) > 0){
            $this->addFlash(
                'success',
                "Vous ne pouvez pas supprimer ce patient car il possède des données importantes venant du jeu"
            );
        }
        else{
        $manager->remove($patient);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le patient {$patient->getPseudo()} a bien été supprimé"
        );
    }
    return $this->redirectToRoute('admin_main_patient');
}
}
