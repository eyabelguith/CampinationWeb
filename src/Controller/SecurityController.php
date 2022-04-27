<?php

namespace App\Controller;
use App\Form\SignInType;
use App\Entity\User;
use App\Form\ResetPassType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends AbstractController
{
    /**
     * @Route("/security", name="app_security")
     */
    public function index(): Response
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }
    /**
     * @Route("/login1", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils,Request $request): Response
    { $user = new User();
        $form=$this->createForm(SignInType::class,$user);
        $rep=$this->getDoctrine()->getRepository(User::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           
            
            $recruteurCheck = $rep->findOneBy(['mail' => $user->getMail()]);
            if($user->getPassword()==$adminCheck->getPassword())
            {
                $session= new Session();
           
                $session->set('mail',$recruteurCheck->getMail());
                $session->set('password',$recruteur->getPassword());
             
            }
        }
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('admin/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    /**
     * @Route ("/oubli_pass", name="app_forgoten_password")
     */
    public function reset(Request $request,\Swift_Mailer $mailer,TokenGeneratorInterface $tokenGenerator){
        $repository=$this->getDoctrine()->getRepository(User::class);
        //on cree le formulaire
        $form=$this->createForm(ResetPassType::class);
        //on traite le formulaire
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $donner=$form->getData();
            $user=$repository->findOneBy(['mail'=>$donner['email']]);
            //si l'utilisateur n'existe pas
            if(!$user)
            {
                $this->addFlash('danger','This email does not exist');
                return $this->redirectToRoute('app_forgoten_password');
            }
            //on genere l'url
            $token = $tokenGenerator->generateToken();

            try{
                $user->setResetToken($token);
                $em=$this->getDoctrine()->getManager();
                $em->flush();

            }catch (\Exception $e){
                $this->addFlash('warning','a problem has occured'.$e->getMessage());
                return $this->redirectToRoute('app_forgoten_password');
            }
            $url=$this->generateUrl('App_reset_password',['token'=>$token],
                UrlGeneratorInterface::ABSOLUTE_URL);
            $message=(new \Swift_Message('Password reset'))
                ->setFrom('haweswebsite@gmail.com')
                ->setTo($user->getMail())
                ->setBody(
                    "<p>Bonjour </p></p>a password reset request has been made for your account 
                   in Victorious you can click on the following link :" .$url. '</p>',
                    'text/html');
            $mailer->send($message);
            $this->addFlash('message','Reset password mail sent');
            return $this->redirectToRoute('app_forgoten_password');
        }

        return $this->render('security/resetpass.html.twig', [
            'EmailForm' => $form->createView(),
        ]);
    }
    /**
     * @Route ("/reset-pass/{token}", name="App_reset_password")
     */
    public function resetpass($token ,Request $request, UserPasswordEncoderInterface $passwordEncoder){
        $user=$this->getDoctrine()->getRepository(User::class)->findOneBy(['reset_token'=>$token]);
        if(!$user){
            $this->addFlash('danger','Token inconnu');
            return $this->redirectToRoute('app_forgoten_password');
        }
        if($request->isMethod('POST')){
            $user->setResetToken(null);
            $user->setPassword($passwordEncoder->encodePassword($user,$request->get('password')));
            $player=$this->getDoctrine()->getRepository(Player::class)->find($user->getId());
            $player->setPassword($passwordEncoder->encodePassword($user,$request->get('password')));
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success','Password changed successfully');
            return $this->redirectToRoute('app_forgoten_password');
        }else{
            return $this->render('security/password.html.twig',['token'=>$token]);
        }

    }

    /**
     * @Route ("/activation/{token}", name="activation")
     */
    public function activation($token)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['activation_token'=>$token]);
        if(!$user){
            throw $this->createNotFoundException("User not found");
        }
        $user->setActivationToken(null);
        $em=$this->getDoctrine()->getManager();
        $em->flush();
        $this->addFlash('success','vous avez bien activé votre compte');
        return $this->redirectToRoute('app_login');

    }

}
