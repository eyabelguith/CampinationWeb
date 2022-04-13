<?php

namespace App\Controller;

use App\Entity\Camper;
use App\Repository\CamperRepository ;
use App\Form\CamperType ;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
class CamperController extends AbstractController
{
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
$em->flush();
}
  return $this->render('camper/index.html.twig', [
            'formA' => $form->createView() ]);

    }
    
    /**
     * @Route("/Listcamper", name="Listcamper")
     */
    public function AfficheListCamper(){

        $campers = $this->getDoctrine()->getRepository(Camper::class)->findAll();
        return $this->render('camper/ListCamper.html.twig', ['campers' => $campers]);



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
return $this->redirectToRoute('Listcamper');
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
            return $this->redirectToRoute('Listcamper');
        }
        return $this->render("camper/update.html.twig",array('formA'=>$form->createView()));
    }


  /**
     * @Route("/SignUp", name="signup")
     */
    public function SingnUp(Request $request){

        $camper=new Camper();
        $rep=$this->getDoctrine()->getRepository(Camper::class);
       
        $form=$this->createForm(CamperType::class,$camper);

        $form->handleRequest($request);
    if (($form->isSubmitted()&& $form->isValid())) 
   {
     /*  $image=$camper->getImage();
       $fileName=md5(uniqid()).'.'.$image->guessExtension();
       $camper->setImage($fileName);*/
      $em=$this->getDoctrine()->getManager();
      $em->persist($camper);
      $em->flush();
      $this->addFlash('success', 'Camperaddes succesfuly !');
   return $this->redirectToRoute('SignUP');
   }
      return $this->render('camper/SignUp.html.twig', [
            'formA' => $form->createView() ]);

    }

}
