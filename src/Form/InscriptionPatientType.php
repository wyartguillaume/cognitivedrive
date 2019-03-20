<?php

namespace App\Form;

use App\Entity\Patient;
use App\Entity\Psychologue;
use App\Repository\PatientRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType as SymfonyIntegerType;

class InscriptionPatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $psychologue = new Psychologue();
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
