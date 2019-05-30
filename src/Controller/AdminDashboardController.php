<?php

namespace App\Controller;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(ObjectManager $manager)
    {
        $user = $manager->createQuery('SELECT COUNT(u) FROM App\Entity\Psychologue u')->getSingleScalarResult();
        $patient = $manager->createQuery('SELECT COUNT(p) FROM App\Entity\Patient p')->getSingleScalarResult();
        $commentaire = $manager->createQuery('SELECT COUNT(c) FROM App\Entity\Commentaire c')->getSingleScalarResult();
        $session = $manager->createQuery('SELECT COUNT(s) FROM App\Entity\Session s')->getSingleScalarResult();
        return $this->render('admin/dashboard/index.html.twig', [
            'stats'=> compact('user', 'patient', 'commentaire', 'session')
        ]);
    }
}
