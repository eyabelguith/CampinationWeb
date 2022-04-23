<?php

namespace App\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\VipType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Vip;
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
    {

        $c= new Vip();
        $form = $this->createForm(VipType::class, $c);
      
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($c);
            $em->flush();
            

            return $this->redirectToRoute('VIP');
        }


        return $this->render('vip/AddV.html.twig', [
            'form' => $form->createView()
        ]);

    }


}
