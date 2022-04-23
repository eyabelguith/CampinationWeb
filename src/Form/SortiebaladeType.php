<?php

namespace App\Form;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Sortiebalade;
use Symfony\Component\Form\AbstractType;
use App\Entity\Destination;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SortiebaladeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('idDestinationb',ChoiceType::class,[
                'choices'  => [
                    'CP' => null,
                    '2000'=>	'2000',
                    '2001'=>	'2001',
                    '1111'=>	'1111',
                    '3200'=>	'3200',
                    '1100'=>	'1100'
                    
                    ]])
            ->add('dateDepart')
            ->add('dateRetour')
            ->add('cint')
            ->add('nomS')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sortiebalade::class,
        ]);
    }
}
