<?php

namespace App\Form;

use App\Entity\Camper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotIdenticalTo;
class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('num_Tel',TextType::class)
 
        ->add('date_naissance', DateType::class, [
            'widget' => 'single_text'
        ])
        ->add('gouvernorat')
        ->add('sexe')
        ->add('cin')
        ->add('Skills')
        ->add('login')
      
        ->add('nom', TextType::class,[

            'constraints' => [
                new NotBlank([
                    'message' => 'Vueillez remplir le champ',
                ]),
                new Length([
                    'min' => 1,
                    'minMessage' => 'Your name should not be  {{ limit }} characters',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
        ] ])
        ->add('prenom', TextType::class,[

            'constraints' => [
                new NotBlank([
                    'message' => 'Vueillez remplir le champ',
                ]),
                new Length([
                    'min' => 1,
                    'minMessage' => 'Your name should not be  {{ limit }} characters',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
            ] ])
        ->add('email', TextType::class,[

            'constraints' => [
                new NotBlank([
                    'message' => 'Vueillez remplir le champ',
                ]),
                new Length([
                    'min' => 7,
                    'minMessage' => 'Your name should not be  {{ limit }} characters',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
            ] ])
        ->add('agreeTerms', CheckboxType::class, [
            'mapped' => false,
            'constraints' => [
                new IsTrue([
                    'message' => 'You should agree to our terms.',
                ]),
            ],
        ])
        ->add('pwd', PasswordType::class, [
            // instead of being set onto the object directly,
            // this is read and encoded in the controller
            'mapped' => false,
            'attr' => ['autocomplete' => 'new-password'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a password',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Your password should be at least {{ limit }} characters',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
            ],
        ])
    ;
}


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Camper::class,
        ]);
    }
}
