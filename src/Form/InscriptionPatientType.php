<?php

namespace App\Form;

use App\Entity\Patient;
use App\Entity\Psychologue;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class InscriptionPatientType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('pseudo')
        ->add('dateDeNaissance')
        ->add('sexe', CheckboxType::class, [
            'label' => 'Femme',
            'required'=>false,
        ])
        ->add('lateralite', ChoiceType::class, [
            'choices' => [
                'Droitier'=>'Droitier',
                'Gaucher'=>'Gaucher',
                'Ambidextre'=>'Ambidextre',
                'Je ne sais pas'=>'Je ne sais pas'
            ]
        ])
        ->add('groupe', ChoiceType::class,  [
            'choices' => [
                'Alcoolique'=>'Alcoolique',
                'Dépressif'=>'Dépressif',
                'Je ne sais pas'=>'Je ne sais pas'
            ]
        ])
        ->add('nom')
        ->add('prenom')
        ->add('email')
        ->add('profession')
        ->add('etatCivil', ChoiceType::class,  [
            'choices' => [
                'Célibataire'=>'Célibataire',
                'Marié'=>'Marié',
                'Veuf'=>'Veuf',
            ]
        ])
        ->add('nbrEnfants')
        ->add('psychologue', EntityType::class, [
            'class' => Psychologue::class,
            'placeholder' => 'Trouver votre psychologue',
            'choice_label' => function(Psychologue $psychologue){
                return ($psychologue->getNom()." ".$psychologue->getPrenom());
            },
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
