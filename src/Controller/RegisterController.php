<?php

namespace App\Controller;

use App\Entity\Camper;
use App\Form\RegistrationFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Mailer\MailerInterface;
use App\Security\UtilisateurauthentificatorAuthenticator;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $userPasswordEncoderInterface, GuardAuthenticatorHandler $guardHandler, UtilisateurauthentificatorAuthenticator $authenticator, MailerInterface $mailer): Response
    {
        $camper = new Camper();
 
        $form = $this->createForm(RegistrationFormType::class, $camper);
        $form->handleRequest($request);
        $form->add('SignUP',SubmitType::class);
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password

            $camper->setPwd(
            $userPasswordEncoderInterface->encodePassword(
                    $camper,
                    $form->get('pwd')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $camper->setEtat("Actif");
            $camper->setRoles(["ROLE_CAMPER"]);
            $entityManager->persist($camper);
            $entityManager->flush();
            $entityManager = $this->getDoctrine()->getManager();
            //$user->setRoles((array)"User");
            $entityManager->persist($camper);
            $entityManager->flush();
            // do anything else you need here, like send an email

            $email = (new TemplatedEmail())
                ->from('eyatalbi03@gmail.com')
                ->to($user->getEmail())
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Account Verification')
             ->htmlTemplate('EmailTemplate.html.twig')
                ->context([
                    'Nom'=> $camper->getNom(),
                   'prenom'=> $camper->getPrenom(),
                   

                ]);
            //->html('<p>See Twig integration for better HTML integration!</p>');

            $mailer->send($email);

            return $guardHandler->authenticateUserAndHandleSuccess(
                $camper,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }


        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
