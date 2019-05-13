<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\Psychologue;
use App\Repository\PatientRepository;
use App\Repository\PsychologueRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{

    /**
     * @Route("/", name="acceuil")
     */
    public function acceuil()
    {
        if($this->getUser()){
        if(!$this->getUser()->getIsActive()){
            $cache = new FilesystemCache();
            $cache->set("error", "Pas encore activé");
            return $this->redirectToRoute("connexion_user");
        }
    }
        return $this->render('main/acceuil.html.twig');
    }



    /**
     * @Route("/patient", name="patient")
     * @IsGranted("ROLE_USER")
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
     * @IsGranted("ROLE_USER")
     */
    public function consultation()
    {
        return $this->render('main/consultation.html.twig');
    }

}
