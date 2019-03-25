<?php

namespace App\Controller;

use App\Entity\Patient;
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
       $idPsycho = $repo->findPsychoId(1);
       dump($idPsycho);
       // $psycho = $manager->createQuery('SELECT psy FROM App\Entity\Patient p JOIN APP\Entity\Psychologue psy WHERE psy.id='.$idPsycho)->getResult();
        $patients = $repo ->findAll();
      // dump($psycho);
        
        return $this->render('main/patient.html.twig', [
            'patients' => $idPsycho
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
