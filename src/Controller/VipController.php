<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
