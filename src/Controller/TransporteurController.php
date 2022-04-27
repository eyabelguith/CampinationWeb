<?php

namespace App\Controller;
use App\Entity\Transporteur;
use App\Form\TransporteurType;
use App\Repository\TransporteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
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
        $a=0;
        $b=0;
        $pieChart = new PieChart();
        $entityManager=$this->getDoctrine()->getManager();
        $objet=$entityManager->getRepository(Transporteur::class)->findAll();
        foreach ($objet as $u){
            $dispo=$u->getDisponibilite();
            if($dispo=='Oui'){
                $a++;
            }
            elseif ($dispo=='Non'){
                $b++;
            }
        }

        $pieChart=new PieChart();
        $pieChart->getData()->setArrayToDataTable(array(
            ['Post', 'Nombre de bloque'],
            ['Disponible',$a],
            ['Non Disponible',$b],
        ));


        $pieChart->getOptions()->setHeight(400);
        $pieChart->getOptions()->setWidth(400);
        $pieChart->getOptions()->setBackgroundColor('#f1f2f8');
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#f1f2f8');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        $c=0;
        $d=0;
        $e=0;
        $pieChart2 = new PieChart();
        $entityManager=$this->getDoctrine()->getManager();
        $objet1=$entityManager->getRepository(Transporteur::class)->findAll();
        foreach ($objet1 as $u){
            $gouv=$u->getGouvernorat();
            if($gouv=='tunis'){
                $c++;
            }
            elseif($gouv=='hammamet'){
                $d++;
            }
            elseif ($gouv=='nabeul'){
                $e++;
            }
        }

        $pieChart2=new PieChart();
        $pieChart2->getData()->setArrayToDataTable(array(
            ['Post', 'Nombre de bloque'],
            ['Tunis',$c],
            ['Hammamet',$d],
            ['nabeul',$e],
        ));


        $pieChart2->getOptions()->setHeight(400);
        $pieChart2->getOptions()->setWidth(900);
        $pieChart->getOptions()->setBackgroundColor('#f1f2f8');
        $pieChart2->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart2->getOptions()->getTitleTextStyle()->setColor('#f1f2f8');
        $pieChart2->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart2->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart2->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('transporteur/ListTransporteur.html.twig', ['trans' => $trans,'piechart' => $pieChart,'pichart2'=>$pieChart2]);




    } 
    /**
     * @Route("/Listtransporteur/Dispo", name="Listtransporteur/Dispo")
     */
    public function AfficheListTransporteurDispo(){

        $transd = $this->getDoctrine()->getRepository(Transporteur::class)->ListTransporteur();
        return $this->render('transporteur/ListTransporteurD.html.twig', ['transDispo' => $transd]);



    } 
     /**
     * @Route("/AddTransporteur", name="AddTransporteur")
     */
    public function AddTransporteur(Request $request){

        $transporteur=new Transporteur();
        $rep=$this->getDoctrine()->getRepository(Transporteur::class);
       
        $form=$this->createForm(TransporteurType::class,$transporteur);
       
        $form->handleRequest($request);
    if (($form->isSubmitted()&& $form->isValid())) 
   {
      $em=$this->getDoctrine()->getManager();
      $em->persist($transporteur);
      $em->flush();
      $this->addFlash('info', $transporteur->getNom().'  est ajouté avec succee !');
   return $this->redirectToRoute('Listtransporteur');
   }
      return $this->render('transporteur/Ajoutertransporteur.html.twig', [
            'form' => $form->createView() ]);


    }

    /**
     * @Route("/TrierParCapacite", name="TrierParCapacite")
     */
    public function TrierParCapacite(Request $request): Response
    {
        $repository = $this->getDoctrine()->getRepository(Transporteur::class);
        $t = $repository->findByCapacite();

        return $this->render('transporteur/index.html.twig', [
            'c' =>  $t,
        ]);
    }
    

     
}
