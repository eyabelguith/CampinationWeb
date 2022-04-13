<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DestinationController extends AbstractController
{
    /**
     * @Route("/destination", name="app_destination")
     */
    public function index(): Response
    {
        return $this->render('destination/index.html.twig', [
            'controller_name' => 'DestinationController',
        ]);
    }
}
