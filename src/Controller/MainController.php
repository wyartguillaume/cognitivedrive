<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PatientRepository;

class MainController extends AbstractController
{

    /**
     * @Route("/", name="acceuil")
     */
    public function acceuil()
    {
        return $this->render('main/acceuil.html.twig');
    }

    /**
     * @Route("/aide", name="aide")
     */
    public function aide()
    {
        return $this->render('main/aide.html.twig');
    }

    /**
     * @Route("/configuration", name="configuration")
     */
    public function config()
    {
        return $this->render('main/config.html.twig');
    }

    /**
     * @Route("/patient", name="patient")
     */
    public function patient(PatientRepository $repo)
    {
        $patient = $repo->findAll();
        return $this->render('main/patient.html.twig', [
          'patients' => $patient,
          'maFonction' => creeTableau($patient, 'Patient', true)
        ]);
    }

    /**
     * @Route("/consultation", name="consultation")
     */
    public function consultation()
    {
        return $this->render('main/consultation.html.twig');
    }

}
