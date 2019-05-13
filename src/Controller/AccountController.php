<?php

namespace App\Controller;

use App\Form\AccountType;
use App\Entity\Psychologue;
use App\Entity\PasswordUpdate;
use App\Form\PasswordUpdateType;
use App\Repository\PatientRepository;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{

    /**
     * Permet de voir notre profil
     * @Route("/account", name= "account_index")
     * @return Response
     */
    public function monCompte(PatientRepository $repo){
        $patientList = $repo->findPsychoId($this->getUser()->getId());
        return $this->render('account/index.html.twig', [
            'user' => $this->getUser(),
            'patient' => $patientList 
        ]);
    }

     /**
         * permet de modifier me mdp
         *
         * @Route("/password-update", name= "account_password")
         * @IsGranted("ROLE_USER")
         * @return Response
         */
        public function updatePassword(Request $request, UserPasswordEncoderInterface $encoder,  ObjectManager $manager){
            $passwordUpdate = new PasswordUpdate();
    
            $user = $this->getUser();
    
            $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);
    
            $form->handleRequest($request);
    
    
            if($form->isSubmitted() && $form->isValid()){
                if(!password_verify($passwordUpdate->getOldPassword(), $user->getMotDePasse())){
                    $form->get('oldPassword')->addError(new FormError("Le mot de passe que vous avez tapé n'est pas votre mot de passe actuel !"));
                }
                else{
                    $newPassword = $passwordUpdate->getNewPassword();
                    $hash = $encoder->encodePassword($user, $newPassword);
    
                    $user->setMotDePasse($hash);
                    $manager->flush();
    
                    $this->addFlash(
                        'success',
                        "Votre mot de passe a bien été modifié"
                    );
    
                    return $this->redirectToRoute('acceuil');
                }
            }
                
    
    
            return $this->render('account/password.html.twig',[
               'form'=>$form->createView()
               
            ]);
        }

    /**
     * Affiche et traite les modifications de profil
     * @Route("/profile", name="account_profile")
     * @IsGranted("ROLE_USER")
     * @return void
     */
    public function profile(Request $request, ObjectManager $manager) {
        $user = $this->getUser();
        $form = $this->createForm(AccountType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "les données du profil ont été enregistrées avec succès !"
            );
        }

        return $this->render('account/profile.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
