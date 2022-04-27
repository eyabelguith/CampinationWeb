<?php

namespace App\Controller;
use App\Entity\Coach;

use App\Repository\CoachRepository;
use Symfony\Component\HttpFoundation\JsonResponse ;
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
     * @Route("/Listcoach2", name="Listcoach2")
     */
    public function AfficheListCoach2(CoachRepository $repo){

        $coachs = $repo->showByTypeSport($typeSport);
        return $this->render('coach/ListCoach.html.twig', ['coach' => $coachs]);



    } 
  /*
        /**
     * @Route("/showCoach/{id}", name="showCoach")
     */
  /*  public function showCoach($id)
    {
        $coach = $this->getDoctrine()->getRepository(Coach::class)->find($id);
        $sorties= $this->getDoctrine()->getRepository(Sortiesportif::class)->listSortieByCoach($coach->getId());
        return $this->render('coach/show.html.twig', [
            "coach" => $coach,
            "sorties"=>$sorties]);
    }*/
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
      $this->addFlash('info', $coach->getNom().'  est ajouté avec succee !');
   return $this->redirectToRoute('Listcoach');
   }
      return $this->render('coach/AjouterCoach.html.twig', [
            'form' => $form->createView() ]);


    }
     /**
     * @Route("/updateCoach/{id}", name="updateCoach")
     */
    public function updateCoach(Request $request,$id)
    {
        $coach = $this->getDoctrine()->getRepository(Coach::class)->find($id);
        $form = $this->createForm(CoachType::class, $coach);
    
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('warning', $coach->getNom().'Coach est modifié avec succee !');
            return $this->redirectToRoute('Listcoach');
        }
        return $this->render("coach/updateCoach.html.twig",array('form'=>$form->createView()));
    }
/**
  
   * @Route("/search", name="ajax_search")
  
   */
  public function searchAction(Request $request)
  {
      $em = $this->getDoctrine()->getManager();

      $requestString = $request->get('q');

      $entities =  $em->getRepository(Coach::class)->showByTypeSport($requestString);

      if(!$entities) {
          $result['entities']['error'] = "Pas de coach";
      } else {
          $result['entities'] = $this->getRealEntities($entities);
      }

      return new Response(json_encode($result));
  }
  public function getRealEntities($entities){

    foreach ($entities as $entity){
        $realEntities[$entity->getNom()] = $entity->getNom();
    }

    return $realEntities;
}
}
