<?php

namespace App\Controller;

use App\Form\CommentType;
use App\Form\ReponseType;
use App\Entity\Commentaire;
use App\Entity\Conversation;
use App\Repository\CommentaireRepository;
use App\Repository\ConversationRepository;
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
     * @Route("/reponseAide/{id}", name="reponseAide")
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function reponseAide(Commentaire $comment,ConversationRepository $repo, Request $request, ObjectManager $manager)
    {
        $conversation = $repo->findAll();
        $date = new \DateTime('@'.strtotime('now'));
        $reponse = new Conversation();
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $reponse->setAuteur($this->getUser())
                    ->setCommentaire($comment)
                    ->setCreatedAt($date);


            $manager->persist($reponse);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre poste a bien été pris en compte! Merci de contribuer à l'amélioration de l'application"
            );
            return $this->redirectToRoute('reponseAide', [
                'id' => $comment->getId()
            ]);
        }
        return $this->render('forum/reponseAide.html.twig', [
            'form' => $form->createView(),
            'reponse' => $conversation,
            'commentaire' => $comment
        ]);
    }

    /**
     * @Route("/aide", name="aide")
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function aide(CommentaireRepository $repo, Request $request, ObjectManager $manager)
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
        }
        $comment = $repo->findAll();
        return $this->render('forum/aide.html.twig', [
            'comment' => $comment,
            'form' => $form->createView()
        ]);
    }
}
