<?php

namespace App\Form;

use App\Entity\Coach;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
class CoachType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
         
            ->add('email',EmailType::class)
            ->add('login',TextType::class)
            ->add('pwd',PasswordType::class)
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
            ->add('typeSport',ChoiceType::class,[
                'choices'  => [
                    'Type sport' => null,
                    'Escalade'=>'Escalade',
                    'Ski'=> 'Ski',
                    'Snowboard'=>'Snowboard',
                    'Aquagym'=>'Aquagym',
                    'Aquabike'=>'Aquabike',
                    'Natation'=>'Natation',
                    'Canoë'=>'Canoë',
                    'Canyoning'=>'Canyoning',
                    'Paddle'=>'Paddle',
                    'Plongée'=> 'Plongée',
                    'Surf'=>'Surf',
                    'Voile'=>'Voile',
                    'Cirque'=>'Cirque',
                    'Gymnastique'=>'Gymnastique',
                    'Claquettes'=>'Claquettes',
                    'Danse'=>   'Danse',
                    'Hip Hop'=>'Hip Hop',
                    'Zumba'=>'Zumba',
                'Equitation'=>'Equitation',
                    'Fléchettes'=> 'Fléchettes',
                    'Golf'=>'Golf',
                    'Lancer du javelot'=>'Lancer du javelot',
                    'Lancer du marteau'=>'Lancer du marteau',
                    'Pétanque'=>'Pétanque',
                    'Patinage'=>'Patinage',
                    'Qi Gong'=>'Qi Gong',
                    'Taï chi'=>'Taï chi',
                    'Yoga'=>'Yoga',
                    'Saut à la perche'=>'Saut à la perche',
                    'Saut en longueur'=>'Saut en longueur',
                    'Tir'=> 'Tir',
                    'Skate'=>'Skate',
               
                ]
            
            ])
            ->add('cinco',NumberType::class)
       
   
 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Coach::class,
        ]);
    }
}
