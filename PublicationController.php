<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\PublicationType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Publication;
use App\Repository\PublicationRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use App\Notifications\NouveauPublicationNotification;
use Symfony\Bridge\Doctrine\Logger\DbalLogger;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Validator\Validation;
use Symfony\Component\HttpFoundation\File\File;
use Dompdf\Dompdf;
use Dompdf\Options;

use AppBundle\Form\FormValidationType; 
use Symfony\Bundle\FrameworkBundle\Controller\Controller; 
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\FileType; 
 use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Constraints\Json;

use PHPMailer\PHPMailer\PHPMailer;


 

use Swift_SmtpTransport;
use Swift_Message;
use Swift_Mailer;


class PublicationController extends AbstractController
{
    /**
     * @Route("/publication", name="app_publication")
     */
    public function index(): Response
    {
        return $this->render('publication/index.html.twig', [
            'controller_name' => 'PublicationController',
        ]);
    }



/**
     * @Route("/PUB", name="PUB")
     */
    public function PUB(Request $request){

       
        $sb = $this->getDoctrine()->getRepository(Publication::class)->findAll();
        return $this->render('publication/AffichePUB.html.twig', ['sb' => $sb]);



}
/**
     * @Route("/PUBf", name="PUBf")
     */
    public function PUBf(Request $request){

       
        $sb = $this->getDoctrine()->getRepository(Publication::class)->findAll();
        return $this->render('publication/AffichePUBf.html.twig', ['sb' => $sb]);



}


  /**
     * @Route("/deleteP/{idP}", name="deletep")
     */
    public function deletep($idP , PublicationRepository $rep)
    { $sb=$rep->find($idP);
      $em=$this->getDoctrine()->getManager();
      $em->remove($sb);
      $em->flush(); 
        return $this->redirectToRoute('PUB');
       
    }




    
/**
     * @Route("/AddP", name="AddP")
     */

    public function ajoutP(Request $request)
    {   $c= new Publication();
        $form = $this->createForm(PublicationType::class, $c);
        $c=$form->getData();
       /** @var UploadedFile $File */
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
            $photoFile = $form->get('photo')->getData();
        // this condition is needed because the 'photo' field is not required
        // so the imagefile must be processed only when a file is uploaded
        if ($photoFile)  {
            $fileName = md5(uniqid()) . '.' . $photoFile->guessExtension();
            // Move the file to the directory where pictures are stored
            try {
                $photoFile->move(
                    $this->getParameter('photos_directory'),
                    $fileName
                ); 
            } catch (FileException $e) {
            }
        }
            $c->setPhoto($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($c);
            $em->flush();
            return $this->redirectToRoute('PUBf');
        }

        return $this->render('publication/AddP.html.twig', [
            'form' => $form->createView()
        ]);

    }






 

       

    }












