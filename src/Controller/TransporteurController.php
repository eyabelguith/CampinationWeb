<?php

namespace App\Controller;
use App\Entity\Transporteur;
use App\Repository\TransporteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TransporteurController extends AbstractController
{
    /**
     * @Route("/transporteur", name="app_transporteur")
     */
    public function index(): Response
    {
        return $this->render('transporteur/index.html.twig', [
            'controller_name' => 'TransporteurController',
        ]);
    }
    /**
     * @Route("/Listtransporteur", name="Listtransporteur")
     */
    public function AfficheListTransporteur(){

        $trans = $this->getDoctrine()->getRepository(Transporteur::class)->findAll();
        return $this->render('transporteur/ListTransporteur.html.twig', ['trans' => $trans]);




    } 
    /**
     * @Route("/Listtransporteur/Dispo", name="Listtransporteur/Dispo")
     */
    public function AfficheListTransporteurDispo(){

        $transd = $this->getDoctrine()->getRepository(Transporteur::class)->ListTransporteur();
        return $this->render('transporteur/ListTransporteurD.html.twig', ['transDispo' => $transd]);



    } 
    
     
}
