<?php

namespace App\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\SortiesportifType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Sortiesportif;
use App\Repository\SortiesportifRepository;
class SortieSController extends AbstractController
{
    /**
     * @Route("/sortie/s", name="app_sortie_s")
     */
    public function index(): Response
    {
        return $this->render('sortie_s/index.html.twig', [
            'controller_name' => 'SortieSController',
        ]);
    }

    /**
     * @Route("/SS", name="SS")
     */
    public function AfficheSortieS(){

        $ss = $this->getDoctrine()->getRepository(Sortiesportif::class)->findAll();
        return $this->render('sortie_s/AfficheSS.html.twig', ['ss' => $ss]);



    }



/**
     * @Route("/AddSS", name="AddSS")
     */
    public function ajoutS(Request $request)
    {

        $c= new Sortiesportif();
        $form = $this->createForm(SortiesportifType::class, $c);
        $form -> add ('Ajouter', SubmitType::Class);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($c);
            $em->flush();
            

            return $this->redirectToRoute('SS');
        }


        return $this->render('sortie_s/AddSS.html.twig', [
            'form' => $form->createView()
        ]);

    }





      /**
     * @Route("/deleteSS/{idSS}", name="deletess")
     */
    public function deletess($idSS): Response
    { $ss=$this->getDoctrine()->getRepository(Sortiesportif::class)->find($idSS);
      $em=$this->getDoctrine()->getManager();
      $em->remove($ss);
      $em->flush(); 

        return $this->redirectToRoute('SS');
       
    }



      /**
     * @Route("/UpSS/{idSS}", name="UpSS")
     */
    public function modifP(Request $request,$idSS): Response
    {
        
        $sb=$this->getDoctrine()->getRepository(Sortiesportif::class)->find($idSS);
        $form=$this->createForm(SortiesportifType::class,$sb);
        $form -> add ('modif', SubmitType::Class);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em=$this->getDoctrine()->getManager();

            $em->flush();
            return $this->redirectToRoute('SS');
        }

        return $this->render('sortie_sb/UpdateSS.html.twig', [
            'f' => $form->createView(),
        ]);
    }

}
