<?php

namespace App\Controller;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use App\Entity\Camper;
use App\Entity\User;
use App\Repository\CamperRepository ;
use App\Form\CamperType ;
use App\Form\RegisterType ;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use App\Notification\NouveauCamper;

class CamperController extends AbstractController
{
     
/**
 * @var NouveauCamper
 */
private $notify_creation;

/**
 * @param NouveauCamper $notify_creation
 */
public function __construct(NouveauCamper $notify_creation)
{
    $this->notify_creation = $notify_creation;
    
}

    /**
     * @Route("/camper", name="app_camper")
     */
    public function index(Request $request): Response
    {
        $camper=new Camper();
        $rep=$this->getDoctrine()->getRepository(Camper::class);
       
        $form=$this->createForm(CamperType::class,$camper);
     
        $form->handleRequest($request);
if (($form->isSubmitted()&& $form->isValid())) 
{
$em=$this->getDoctrine()->getManager();
$em->persist($camper);
$this->notify_creation->notify();
$em->flush();
}
  return $this->render('camper/SignUp.html.twig', [
            'formA' => $form->createView() ]);

    }
 
        /**
     * @param CamperRepository $repository
     * @param $etat
     * @return Response
     * @route("/afficheActifCamper", name="afficheActifCamper")
     */
    public function afficheActif(CamperRepository $repository){
        $id='Actif';
     
        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
    
        //$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $Utilisateur=$repository->findby(array('etat' => $id));// 'roles'=> '["ROLE_USER"]'));

        return $this->render('camper/ListCamper.html.twig',
        ['Utilisateur'=>$Utilisateur,'user'=>$user]);
    }


   /**
     * @param CamperRepository $repository
     * @param $etat
     * @return Response
     * @route("/afficheBlockCamper", name="afficheBlockCamper")
     */
    public function afficheBlock(CamperRepository $repository){
        $id='block';
        $Utilisateur=$repository->findby(array('etat' => $id));// 'roles'=> '["ROLE_USER"]'));

        return $this->render('camper/ListBlock.html.twig',
        ['Utilisateur'=>$Utilisateur]);
    }
    /**
     * @Route("/Listcamper", name="Listcamper")
     */
    public function AfficheListCamper(){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
    
        $campers = $this->getDoctrine()->getRepository(Camper::class)->findAll();
        return $this->render('camper/AllCampers.html.twig', ['campers' => $campers,'user'=>$user]);



    } 
    /**
     * @Route("/utilisateur/block/{idCamper}", name="block")
     */

    public function block(CamperRepository $repositoryy, $idCamper, Request $request): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $Utilisateur=$repositoryy->find($idCamper);
        $Utilisateur->setEtat('block');
        $em=$this->getDoctrine()->getManager();
        $em->flush();
       return $this->redirectToRoute('afficheActifCamper');
 
    }
    /**
     * @Route("/utilisateur/unblock/{idCamper}", name="unblock")
     */

    public function unblock(CamperRepository $repositoryy, $idCamper, Request $request): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $Utilisateur = $repositoryy->find($idCamper);
        $Utilisateur->setEtat('Actif');
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->redirectToRoute('afficheBlockCamper');
    }

     /**
     * @Route("/DeleteCamper/{idCamper}", name="DeleteCamper")
     */

    public function DeleteCamper($idCamper){
    

$camper = $this->getDoctrine()->getRepository(Camper::class)->find($idCamper);
$em = $this->getDoctrine()->getManager();
$em->remove($camper);
$em->flush();
$this->addFlash('infoo', 'Camper deleted succesfuly !');
return $this->redirectToRoute('afficheActifCamper');
    }
    
    /**
     * @Route("/updateCamper/{idCamper}", name="updateCamper")
     */
    public function updateCamper(Request $request,$idCamper)
    {
        $camper = $this->getDoctrine()->getRepository(Camper::class)->find($idCamper);
        $form = $this->createForm(CamperType::class, $camper);
  
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('warning', 'Camper est modifié avec succee !');
            return $this->redirectToRoute('afficheActifCamper');
        }
        return $this->render("camper/update.html.twig",array('formA'=>$form->createView()));
    }


  /**
     * @Route("/Register", name="Register")
     */
    public function Register(Request $request,UserPasswordEncoderInterface $userPasswordEncoder, EntityManagerInterface $entityManager,\Swift_Mailer $mailer){
     
        $user = new User();

        $form = $this->createForm(RegisterType::class, $user);
     
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setEtat('Actif');
            $user->setRoles(["ROLE_CAMPER"]);
            $user->setPassword(
                $userPasswordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                ));

            // generer un activation token
            $user->setActivationToken(md5(uniqid()));
         
         
            $entityManager->persist($user);

            
            $entityManager->flush();
            $message=(new \Swift_Message('Account activation'))
            ->setFrom('haweswebsite@gmail.com')
            ->setTo($user->getMail())
            ->setBody(
                $this->renderView(
                    'emails/activation.html.twig',['token'=>$user->getActivationToken()]
                ),'text/html'
            );
        $mailer->send($message);
      
        return $this->redirectToRoute('app_login');
           


            return $this->redirectToRoute('Register', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('camper/Register.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
}
/**
     * @Route("/login", name="login")
     */
  /*  public function login( AuthenticationUtils $authenticationUtils): Response
    {

      
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
       
        return $this->render('camper/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
*/
/**
     * @Route("/RegisterCamper", name="RegisterCamper")
     */
    public function RegisterCamper(Request $request,UserPasswordEncoderInterface $userPasswordEncoder, EntityManagerInterface $entityManager,\Swift_Mailer $mailer){
     
        $camper = new Camper();

        $form = $this->createForm(CamperType::class, $camper);
        $form->add('SignUp',SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $camper->setEtat('Actif');
            $camper->setRole(["ROLE_CAMPER"]);
        

            // generer un activation token
            $camper->setActivationToken(md5(uniqid()));
         
         
            $entityManager->persist($camper);

            
            $entityManager->flush();
            $message=(new \Swift_Message('Account activation'))
            ->setFrom('hawes@gmail.com')
            ->setTo($camper->getEMail())
            ->setBody(
                $this->renderView(
                    'emails/activation.html.twig',['token'=>$camper->getActivationToken()]
                ),'text/html'
            );
        $mailer->send($message);
      
        return $this->redirectToRoute('app_login');
           


            return $this->redirectToRoute('RegisterCamper', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('camper/SignUp.html.twig', [
            'camper' => $camper,
            'formA' => $form->createView(),
        ]);
}
     /**
     * @Route("/stats", name="stats")
     */
    public function statistiques(){
        $a=0;
        $b=0;
        $pieChart = new PieChart();
        $entityManager=$this->getDoctrine()->getManager();
        $objet=$entityManager->getRepository(Camper::class)->findAll();
        foreach ($objet as $u){
            $etat=$u->getEtat();
            if($etat=='Actif'){
                $a++;
            }
            elseif ($etat=='block'){
                $b++;
            }
        }

        $pieChart=new PieChart();
        $pieChart->getData()->setArrayToDataTable(array(
            ['Post', 'Nombre de bloque'],
            ['Actif',$a],
            ['blocked',$b],
        ));


        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->setBackgroundColor('#f1f2f8');
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#f1f2f8');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);



        return $this->render('camper/StatUtilisateur.html.twig', array('piechart' => $pieChart));

    }

   
    /**
     * @Route("/stat4", name="stat4")
     */
   /*  public function stat(EntityManagerInterface $entityManager,CamperRepository  $repository)
    {   $camper=$repository->findAll();
       $nbSS=[];
       $nbSB=[];
       foreach($camper as $camper){
        $nbSB[]=$camper->getNbSB();  
        $nbSS[]=$camper->getNbSS(); 
       }
        return $this->render('camper/stat4.html.twig', [
          'nbSB'=>json_encode($nbSB),
          'nbSS'=>json_encode($nbSS),
        ]);
    }
    */
            /**
     * @param CamperRepository $repository
     * @param $etat
     * @return Response
     * @route("/filtrer", name="filtrer")
     */
    public function Filtrer(CamperRepository $repository){
       
        //$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $Utilisateur=$repository->findByNom();

        return $this->render('camper/filtrer.html.twig',
        ['Utilisateur1'=>$Utilisateur]);
    }
}
