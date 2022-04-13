<?php

namespace App\Controller;
use App\Entity\Coach;
use App\Repository\CoachRepository;
use App\Form\CoachType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class CoachController extends AbstractController
{
    /**
     * @Route("/coach", name="app_coach")
     */
    public function index(): Response
    {
        return $this->render('coach/index.html.twig', [
            'controller_name' => 'CoachController',
        ]);
    }

    
    /**
     * @Route("/Listcoach", name="Listcoach")
     */
    public function AfficheListCoach(CoachRepository $repo){

        $coachs = $repo->findAll();
        return $this->render('coach/ListCoach.html.twig', ['coach' => $coachs]);



    } 
     /**
     * @Route("/supp/{id}", name="supprimerc")
     */

    public function DeleteCoach($id){
    

        $coach = $this->getDoctrine()->getRepository(Coach::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($coach);
        $em->flush();
        $this->addFlash('info', $coach->getNom().'  est supprimé avec succee !');
        return $this->redirectToRoute('Listcoach');
            }
   
          
          
    /**
     * @Route("/Addcoach", name="Addcoach")
     */
    public function AddCoach(Request $request){

        $coach=new Coach();
        $rep=$this->getDoctrine()->getRepository(Coach::class);
       
        $form=$this->createForm(CoachType::class,$coach);
       
        $form->handleRequest($request);
    if (($form->isSubmitted()&& $form->isValid())) 
   {
      $em=$this->getDoctrine()->getManager();
      $em->persist($coach);
      $em->flush();
      $this->addFlash('success', $coach->getNom().'  est ajouté avec succee !');
   return $this->redirectToRoute('Listcoach');
   }
      return $this->render('coach/AjouterCoach.html.twig', [
            'form' => $form->createView() ]);


    }


    
}
