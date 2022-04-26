<?php

namespace App\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\VipType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Vip;
use App\Entity\Camper;
use App\Repository\VipRepository;
use Symfony\Component\HttpFoundation\Request;

class VipController extends AbstractController
{
    /**
     * @Route("/vip", name="app_vip")
     */
    public function index(): Response
    {
        return $this->render('vip/index.html.twig', [
            'controller_name' => 'VipController',
        ]);
    }


/**
     * @Route("/VIP", name="VIP")
     */
    public function AfficheVip(){

        $sb = $this->getDoctrine()->getRepository(Vip::class)->findAll();
        return $this->render('vip/AfficheVIP.html.twig', ['sb' => $sb]);



    } 

/**
 * @Route("/VIPA", name="VIPA")
 */
    public function ajoutv(Request $request)
    {$nbSs=0;
        $nbSb=0;
        $c= new Vip();
        
        $form = $this->createForm(VipType::class, $c);
        
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
           /* $sql = "INSERT INTO `vip`( `nb_pt`, `cin`, `nb_SS`, `nb_SB`) select nb_SS*20 + nb_SB*10 , cin, nb_SS ,nb_SB from camper ;";
            $stmt = $entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $user=$this->getDoctrine->getrepo(Camper::class);
            $user->getNbSb() ;
            $user->getNbSs() ;
            $user->setNbSb() ;
            $user->setNbSs() ;*/
            //Camper findAll();
            //$user->getNbSs;
            //$user->getNbSb;
         //$nbPt = $nbSs+$nbSb;
            $em->persist($c);
           
            $em->flush();
            

            return $this->redirectToRoute('VIP');
        }


        return $this->render('vip/AddV.html.twig', [
            'form' => $form->createView()
        ]);

    }




    

}
