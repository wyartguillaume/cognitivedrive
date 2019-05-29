<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\Session;
use App\Entity\Psychologue;
use App\Repository\PatientRepository;
use App\Repository\SessionRepository;
use App\Repository\PsychologueRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Cache\Simple\FilesystemCache;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Histogram;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ComboChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\BubbleChart;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\BarChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Options\ComboChart\Series;
use CMEN\GoogleChartsBundle\GoogleCharts\Options\PieChart\PieSlice;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ColumnChart;

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
     * @Route("/aide", name="aide")
     */
    public function aide(){
        return $this->render('main/aide.html.twig');
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
     * @Route("/consultation/{id}", name="consultation")
     * @IsGranted("ROLE_USER")
     */
    public function consultation(Patient $patient, SessionRepository $repo, ObjectManager $manager)
    {
        $session = $repo->findAll();

        //vitesse moyenne
        $bar = new ComboChart();
        $dataBar = array(['Pseudo', 'Vitesse moyenne', 'Courbe de la vitesse moyenne']);
        $pseud = $manager->createQuery('SELECT p.pseudo FROM App\Entity\Patient p')->getResult();
        foreach($pseud as $key => $value){
            foreach($value as $keys => $pseudo){
               $speedData = $repo->findSessionVitesse($pseudo);
               foreach($speedData as $keyss => $values){
               array_push($dataBar, [$pseudo, $values['vitesseMoyenne'], intval($values['average'])]);
        }
        }
        }
        $bar->getData()->setArrayToDataTable($dataBar);

            $bar->getOptions()->setTitle('Vitesse moyenne de tous les joueurs');
            $bar->getOptions()
                  ->setHeight(400)
                  ->setWidth(900);
            $bar->getOptions()->getVAxis()->setTitle('Vitesse Moyenne');
            $bar->getOptions()->getHAxis()->setTitle('Pseudo');
                $bar->getOptions()->setSeriesType('bars');
                $series5 = new Series();
                $series5->setType('line');
                $bar->getOptions()->setSeries([1 => $series5]);


        //Sorties de route
        $chart = new ColumnChart();
        $dataChart = array(['Pseudo', 'Sortie Gauche', 'Sortie Droite']);
        foreach($pseud as $key => $value){
            foreach($value as $keys => $pseudo){
                $sortie = $repo->findSessionSortie($pseudo);
                foreach($sortie as $oui => $values){
               array_push($dataChart, [$pseudo, $values['NbrRencontreRouteGauche'], $values['NbrRencontreRouteDroite']]);
                }
        }
        }
        $chart->getData()->setArrayToDataTable($dataChart);
        
        $chart->getOptions()->getChart()
            ->setTitle('Nombre de fois que la voiture est sorti de la route')
            ->setSubtitle('Gauche, Droite');
        $chart->getOptions()
            ->setBars('vertical')
            ->setHeight(400)
            ->setWidth(900)
            ->setColors(['#1b9e77', '#d95f02', '#7570b3'])
            ->getVAxis()
                ->setFormat('decimal'); 
        
        //Bouton acceleration/frein
        $chartacc = new ColumnChart();
        $dataChartacc = array(['Pseudo', 'Boutton Acceleration', 'Boutton Frein']);
        foreach($pseud as $key => $value){
            foreach($value as $keys => $pseudo){
                $nbrbutt = $repo->findNbrBoutton($pseudo);
                foreach($nbrbutt as $oui => $values){
               array_push($dataChartacc, [$pseudo, $values['nbrTotaleButtonAcceleration'], $values['nbrTotaleButtonFrein']]);
                }
        }
        }
        $chartacc->getData()->setArrayToDataTable($dataChartacc);
        
        $chartacc->getOptions()->getChart()
            ->setTitle('Nombre de fois que le joueur a appuyé sur les différents boutons')
            ->setSubtitle('Accéleration, Frein');
        $chartacc->getOptions()
            ->setBars('horizontal')
            ->setHeight(400)
            ->setWidth(900)
            ->setColors(['#7570b3', '#d95f02'])
            ->getVAxis()
                ->setFormat('decimal');
        
        //Nbr touche obstacle
        $chart2 = new ColumnChart();
        $dataChart2 = array(['Pseudo', 'Piétons touchés venant de gauche', 'Piétons touchés venant de droite', 'Animaux touchés venant de gauche', 'Animaux touchés venant de droite']);
        foreach($pseud as $key => $value){
            foreach($value as $keys => $pseudo){
                $sortie = $repo->findNbrToucheObstacle($pseudo);
                foreach($sortie as $oui => $values){
                    dump($values);
                    array_push($dataChart2, [$pseudo, $values['nbrTouchePietonsGauche'], $values['nbrTouchePietonsDroit'], $values['NbrAnimalToucheGauche'], $values['NbrAnimalToucheDroite']]);
                }
        }
        }
        $chart2->getData()->setArrayToDataTable($dataChart2);
        
        $chart2->getOptions()->getChart()
            ->setTitle('Les différents obstacles touchés par les joueurs')
            ->setSubtitle('Animaux, Piétons');
        $chart2->getOptions()
            ->setBars('vertical')
            ->setHeight(400)
            ->setWidth(900)
            ->setColors(['#1b9e77', '#d95f02', '#7570b3', 'blue'])
            ->getVAxis()
                ->setFormat('decimal'); 
        
     
        

        return $this->render('main/consultation.html.twig', [
            'id' => $patient->getId(),
            'session' => $session,
            'patient' =>$patient,
            'bar' => $bar,
            'chart' => $chart,
            'chartacc' => $chartacc,
            'chart2' => $chart2
        ]);
    }

    /**
     * @Route("/propos", name="propos")
     */
    public function aPropos(){
    return $this->render('main/propos.html.twig');
    }

    /**
     * @Route("/rgpd", name="rgpd")
     */
    public function rgpd(){
        return $this->render('main/rgpd.html.twig');
        }

}
