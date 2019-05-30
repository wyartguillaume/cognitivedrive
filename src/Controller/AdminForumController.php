<?php

namespace App\Controller;

use App\Form\CommentType;
use App\Entity\Commentaire;
use App\Entity\Conversation;
use App\Repository\CommentaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminForumController extends AbstractController
{
    /**
     * @Route("/admin/forum", name="admin_forum_index")
     */
    public function index(CommentaireRepository $repo)
    {
        return $this->render('admin/forum/index.html.twig', [
            'forum' => $repo->findAll()
        ]);
    }
     /**
      * Pertmet de modifier un commentaire
      * @Route("/admin/forum/{id}/edit", name="admin_forum_edit")
      * @param Commentaire $commentaire
      * @return Response
      */
    public function edit(Commentaire $commentaire, Request $request, ObjectManager $manager){
        $form = $this->createForm(CommentType::class, $commentaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($commentaire);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le commentaire <strong>{$commentaire->getSujet()}</strong> a bien été modifié"
            );
        }
        return $this->render('admin/forum/edit.html.twig', [
            'comment' => $commentaire,
            'form' => $form->createView()
        ]);
    }

    /**
     * Supprime un commentaire
     * @Route("/admin/forum/{id}/delete", name="admin_forum_delete")
     * @param Commentaire $commentaire
     * @param ObjectManager $manager
     * @return void
     */
    public function delete(Commentaire $commentaire, ObjectManager $manager){
        if(count($commentaire->getConversations()) > 0){
            $this->addFlash(
                'success',
                "Vous ne pouvez pas supprimer ce commentaire car il possède des réponses. Veuillez supprimer les réponses avant"
            );
        }
        else{
        $manager->remove($commentaire);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le commentaire de {$commentaire->getSujet()} a bien été supprimé"
        );
    }
        return $this->redirectToRoute('admin_forum_index');
    }

    /**
     * Supprimme les reponses d'un commentaire
     * @Route("/admin/reponse/{id}/delete", name="admin_reponse_delete")
     * @return Response
     */
    public function deleteReponse(Conversation $conversation, ObjectManager $manager){
        $manager->remove($conversation);
        $manager->flush();

        $this->addFlash(
            'success',
            "La réponse {$conversation->getReponse()} a bien été supprimé"
        );
        return $this->redirectToRoute('admin_forum_index');
    }
}
