<?php

namespace App\Form;

use App\Entity\Sortiesportif;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortiesportifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idDestinations')
            ->add('dateDepart')
            ->add('dateRetour')
            ->add('typeSport')
            ->add('cinco')
            ->add('cint')
            ->add('nomS')
            
            ->add('Transporteur')
            ->add('coach')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sortiesportif::class,
        ]);
    }
}
