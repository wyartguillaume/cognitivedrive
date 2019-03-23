<?php

namespace App\Form;

use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionPatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('pseudo')
        ->add('dateDeNaissance')
        ->add('sexe', RadioType::class)
        ->add('lateralite', ChoiceType::class, [
            'choices' => [
                'Droitier'=>false,
                'Gaucher'=>false,
                'Ambidextre'=>false,
                'Je ne sais pas'=>true
            ]
        ])
        ->add('groupe', ChoiceType::class,  [
            'choices' => [
                'Alcoolique'=>false,
                'Dépressif'=>false,
                'Je ne sais pas'=>true
            ]
        ])
        ->add('nom')
        ->add('prenom')
        ->add('email')
        ->add('profession')
        ->add('etatCivil', ChoiceType::class,  [
            'choices' => [
                'Célibataire'=>true,
                'Marié'=>false,
                'Veuf'=>false,
            ]
        ])
        ->add('nbrEnfants')
        ->add('psychologue', ChoiceType::class, [
            'choices'=> [
                
            ]
        ])
    ;
}

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
