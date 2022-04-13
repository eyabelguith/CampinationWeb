<?php

namespace App\Form;

use App\Entity\Camper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class CamperType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('num_Tel',TelType::class)
            ->add('email',EmailType::class)
            ->add('date_naissance', DateType::class, [
                'widget' => 'single_text'
            ])
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
            ->add('sexe',ChoiceType::class,[
                'choices'  => [
                'Genre' => null,
                'expanded'=>false,
                ' Homme'=>' Homme',
                'Femme'=> 'Femme',
                
            ]
            ]
            )
            ->add('cin',NumberType::class)
            ->add('Skills',ChoiceType::class,[
            'choices'  => [
                'Skills' => null,
                ' Patin à roues alignées'=>' Patin à roues alignées',
                'Saut de base'=> 'Saut de base',
                'BMX'=>'BMX',
                'Plongée spéléo'=>'Plongée spéléo',
                'Escalade libre'=>'Escalade libre',
                'Motocross Freestyle'=>'Motocross Freestyle',
                'Escalade sur glace'=>'Escalade sur glace',
                'Hockey sur glace'=>'Hockey sur glace',
                'Motocross'=> 'Motocross',
                'Vélo de montagne'=>'Vélo de montagne',
                'Parapente'=>'Parapente',
                'Escalade'=>'Escalade',
                'Plongée sous-marine' =>'Plongée sous-marine',
                'Parachutisme'=>'Parachutisme',
                'Surfant'=>'Surfant',
                'Autres :'=>'',  
                'multiple'=>true,
              ]  ])
            ->add('login')
            ->add('pwd',PasswordType::class)
          
           /* ->add('image',FileType::class
        )  */
           /* ->add('image', FileType::class, [
                'label' => 'upload image',
                      // unmapped means that this field is not associated to any entity property
                      'mapped' => false,

                      // make it optional so you don't have to re-upload the  file
                      // every time you edit the Product details
                      'required' => false,
      
                      // unmapped fields can't define their validation using annotations
                      // in th e associated entity, so you can use the PHP constraint classes
                      'constraints' => [
                          new File([
                              'mimeTypes' => [
                                  'image/jpg',
                                  'image/png',
                                  'image/jpeg',
                              ],
                              
                          ])
                      ],
                  ])*/ 
        ;
       
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Camper::class,
        ]);
    }
}
