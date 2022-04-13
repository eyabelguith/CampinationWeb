<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortiesportifController extends AbstractController
{
    /**
     * @Route("/sortiesportif", name="app_sortiesportif")
     */
    public function index(): Response
    {
        return $this->render('sortiesportif/index.html.twig', [
            'controller_name' => 'SortiesportifController',
        ]);
    }
}
