<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Vip;
use App\Repository\VipRepository;
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




}
