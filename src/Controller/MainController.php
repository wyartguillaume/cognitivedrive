<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\Psychologue;
use App\Repository\PatientRepository;
use App\Repository\PsychologueRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function patient(PatientRepository $repo, ObjectManager $manager, PsychologueRepository $repoPsy)
    {
       $patientList = $repo->findPsychoId($this->getUser()->getId());
        return $this->render('main/patient.html.twig', [
            'patients' => $patientList
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
