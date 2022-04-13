<?php

namespace App\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\SortiebaladeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Sortiebalade;
use App\Repository\SortiebaladeRepository;

class SortieBController extends AbstractController
{
    /**
     * @Route("/sortie/b", name="app_sortie_b")
     */
    public function index(): Response
    {
        return $this->render('sortie_b/index.html.twig', [
            'controller_name' => 'SortieBController',
        ]);
    }



/**
     * @Route("/SB", name="SB")
     */
    public function AfficheSortieB(){

        $sb = $this->getDoctrine()->getRepository(Sortiebalade::class)->findAll();
        return $this->render('sortie_b/AfficheSB.html.twig', ['sb' => $sb]);



    } 

 /**
     * @Route("/updateSB/{id}", name="UpdateSortieB")
     */
    /*public function UpdateSortieB(Request $request, $id): Response
    { $rep=$this->getDoctrine()->getRepository(Sortiebalade::class);
        $sb=$rep->find($id); // nouvelle instance 
        $form=$this->createForm(Sortiebalade::class,$sb);
        $form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid())
{

$em=$this->getDoctrine()->getManager();
$em->flush();
return $this->redirectToRoute('AfficheSortieB');
}


        return $this->render('updateSB/updatesb.html.twig', [
            'formC' => $form->createView(),
        ]);
        

    }*/


     
  

   

    

/**
     * @Route("/AddSB", name="AddSB")
     */
    /*public function AddSB(Request $request){

        $sb=new Sortiebalade();
        $rep=$this->getDoctrine()->getRepository(Sortiebalade::class);
       
        $form=$this->createForm(SortiebaladeType::class,$sb);
        $form->add('Ajouter sortie',SubmitType::class);
        $form->handleRequest($request);
    if (($form->isSubmitted()&& $form->isValid())) 
   {
      $em=$this->getDoctrine()->getManager();
      $em->persist($sb);
      $em->flush();
   return $this->redirectToRoute('SB');
   }
      return $this->render('sortie_b/AddSB.html.twig', [
            'form' => $form->createView() ]);

    }*/
    public function ajoutC(Request $request)
    {

        $c= new Sortiebalade();
        $form = $this->createForm(SortiebaladeType::class, $c);
        $form -> add ('Ajouter', SubmitType::Class);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($c);
            $em->flush();
            

            return $this->redirectToRoute('SB');
        }


        return $this->render('sortie_b/AddSB.html.twig', [
            'form' => $form->createView()
        ]);

    }
    /**
     * @Route("/deleteSB/{idSB}", name="deletes")
     */
    public function deletesb($idSB , SortiebaladeRepository $rep)
    { $sb=$rep->find($idSB);
      $em=$this->getDoctrine()->getManager();
      $em->remove($sb);
      $em->flush(); 

        return $this->redirectToRoute('SB');
       
    }


  /**
     * @Route("/UpSB/{idSB}", name="UpSB")
     */
    public function modifP(Request $request,$idSB): Response
    {
        
        $sb=$this->getDoctrine()->getRepository(Sortiebalade::class)->find($idSB);
        $form=$this->createForm(SortiebaladeType::class,$sb);
   
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em=$this->getDoctrine()->getManager();

            $em->flush();
            return $this->redirectToRoute('SB');
        }

        return $this->render('sortie_b/UpdateSB.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}