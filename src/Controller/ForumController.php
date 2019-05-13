<?php

namespace App\Controller;

use App\Form\CommentType;
use App\Entity\Commentaire;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ForumController extends AbstractController
{


     /**
     * @Route("/aidePost", name="aidePost")
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function aidePost(Request $request, ObjectManager $manager)
    {
        $date = new \DateTime('@'.strtotime('now'));
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentType::class, $commentaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $commentaire->setPsycho($this->getUser())
                        ->setCreatedAt($date);


            $manager->persist($commentaire);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre poste a bien été pris en compte! Merci de contribuer à l'amélioration de l'application"
            );
            return $this->redirectToRoute('aide');
        }
        return $this->render('forum/aidePost.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/aide", name="aide")
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function aide()
    {
        
        return $this->render('forum/aide.html.twig');
    }
}
