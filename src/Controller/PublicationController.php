<?php

namespace App\Controller;
use App\Entity\Publication;
use App\Entity\Camper;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PublicationRepository ;
use App\Form\PublicationType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
     * @Route("/addpub", name="addpub")
     */
    public function add(Request $request, SessionInterface $session): Response
    {
        $publication=new publication() ; // nouvelle instance 
        $form=$this->createForm(PublicationType::class,null);
        $form->add('Publier',SubmitType::class);
        $form->handleRequest($request);
         $rep=$this->getDoctrine()->getRepository(Camper::class);
       /*  $idUser = $session->get("id");
      $user=$rep->find($idUser);*/
        if ($form->isSubmitted() && $form->isValid() ) 
        {
            
            $imageP=$publication->getImage();
            $fileName=md5(uniqid()).'.'.$imageP->guessExtension();
         
        $publication=$form->getData();

    
            $publication->setImageP($fileName);
        
    $em=$this->getDoctrine()->getManager();
    $em->persist($publication);
    $em->flush();

     $this->notify_creation->notify();
     
    return $this->redirectToRoute('publication');
    }
    


        return $this->render('publication/Post.html.twig', [

            'formP' => $form->createView(),

           
        ]);

       

    }

}
