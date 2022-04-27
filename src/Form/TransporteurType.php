<?php

namespace App\Form;

use App\Entity\Transporteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
class TransporteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numTel',TelType::class)
            ->add('nom',TextType::class)
            ->add('gouvernorat',ChoiceType::class,[
                'choices'  => [
                    'Gouvernorat' => null,
                    'Ariana'=>	'Ariana',
                    'Béja'=>	'Béja',
                    'Ben Arous'	=>  'Ben Arous',
                    'Bizerte'	=>'Bizerte',
                    'Gabès'	=> 'Gabès',
                    'Gafsa'=>'Gafsa',
                    'Jendouba'=>'Jendouba'	,
                    'Kairouan'=> 'Kairouan'	,
                    'Kasserine'	=>'Kasserine',
                    'Kébili'=> 'Kébili',
                    'Le Kef'=>'Le Kef'	,	
                    'Mahdia'=>'Mahdia'	,
                    'La Manouba'=>'La Manouba',
                    'Médenine'=>'Médenine'	,
                    'Monastir'=>'Monastir',
                    'Nabeul' =>	'Nabeul',
                 	'Sfax' =>'Sfax' ,
                    'Sidi Bouzid'=>	'Sidi Bouzid',
                    'Siliana'=>'Siliana',
                    'Sousse'=>'Sousse',
                    'Tataouine'	=> 'Tataouine',
                    'Tozeur'=>	'Tozeur',
                    'Tunis'	=>'Tunis',
                    'Zaghouan'=> 'Zaghouan',
               
                ]
            
            ])
            ->add('moyent',ChoiceType::class,[
                'choices'  => [
                    'Moyen de Transport' => null,
                    'Louage'=>	'Louage',
                    'Bus'=>	'Bus',
                    'Mini Bus '	=>  'Mini Bus',
                ]
            ])
            ->add('capacite',ChoiceType::class,[
                'choices'  => [
                    'Capacité' => null,
                    '8 places'=>	'8 places',
                    '25 places'=>	'25 places',
                    '50 places '=>  '50 places',
                ]
                ])
            ->add('matricule',TextType::class)
          
            ->add('cint')
            ->add('disponibilite',ChoiceType::class,[
                'choices'  => [
                    'Disponibilité' => null,
                    'Non'=>	' Non',
                    'Oui'=>	'Oui',
            ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transporteur::class,
        ]);
    }
}
