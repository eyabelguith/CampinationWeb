<?php

namespace App\Form;

use App\Entity\Vip;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VipType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        //->add('nbPt':='nbSb'*20+'nbSs'*10)
            ->add('nbPt')
            ->add('cin')
            ->add('nbSs')
            ->add('nbSb')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vip::class,
        ]);
    }
}
