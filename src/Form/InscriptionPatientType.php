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
            ->add('sexe')
            ->add('lateralite')
            ->add('groupe')
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('profession')
            ->add('etatCivil')
            ->add('nbrEnfants')
           // ->add('nbrVisite')
           // ->add('dateDerniereVisite')
            //->add('troubleDeSommeil')
            ->add('psychologue')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
