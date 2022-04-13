<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/")
 */
class EvenementController extends AbstractController
{
    /**
     * @Route("/evenement", name="app_evenement_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $em): Response

    {
        $evenements=$em->getRepository(Evenement::class)->findAll();
        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
            
        ]);
    }
    /**
     * @Route("/list", name="app_evenement_index1", methods={"GET"})
     */
    public function index1(EntityManagerInterface $em): Response

    {
        $evenements=$em->getRepository(Evenement::class)->findAll();
        return $this->render('evenement/ListEvenement.html.twig', [
            'evenements' => $evenements,
            
        ]);
    }
    /**
     * @Route("/detail", name="app_evenement_index2")
     */
    public function index2(EntityManagerInterface $em): Response

    {
        $evenements=$em->getRepository(Evenement::class)->findAll();
        return $this->render('evenement/DetailEvenement.html.twig', [
            'evenements' => $evenements,
            
        ]);
    }
    /**
     * @Route("/participation", name="app_evenement_index3",)
     */
    public function index3(EntityManagerInterface $em): Response

    {
        $evenements=$em->getRepository(Evenement::class)->findAll();
        return $this->render('evenement/Participation.html.twig', [
            'evenements' => $evenements,
            
        ]);
    }
    /**
     * @Route("/message", name="app_evenement_index4",)
     */
    public function index4(EntityManagerInterface $em): Response

    {
        $evenements=$em->getRepository(Evenement::class)->findAll();
        return $this->render('evenement/Message.html.twig', [
            'evenements' => $evenements,
            
        ]);
    }

    /**
     * @Route("/new", name="app_evenement_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EvenementRepository $evenementRepository): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $evenementRepository->add($evenement);
            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idE}", name="app_evenement_show", methods={"GET"})
     */
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    /**
     * @Route("/{idE}/edit", name="app_evenement_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Evenement $evenement, EvenementRepository $evenementRepository): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $evenementRepository->add($evenement);
            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idE}", name="app_evenement_delete", methods={"POST"})
     */
    public function delete(Request $request, Evenement $evenement, EvenementRepository $evenementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getIdE(), $request->request->get('_token'))) {
            $evenementRepository->remove($evenement);
        }

        return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
    }
}
