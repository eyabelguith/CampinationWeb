<?php

namespace App\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\SortiebaladeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Sortiebalade;
use App\Repository\SortiebaladeRepository;
use Knp\Component\Pager\PaginatorInterface;

use App\Notifications\NouveauPublicationNotification;
use Symfony\Bridge\Doctrine\Logger\DbalLogger;
use Symfony\Component\Serializer\Annotation\Groups;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Validator\Validation;
use Symfony\Component\HttpFoundation\File\File;
use Dompdf\Dompdf;
use Dompdf\Options;

use PHPMailer\PHPMailer\PHPMailer;
use Swift_SmtpTransport;
use Swift_Message;
use Swift_Mailer;
class SortieBController extends AbstractController
{
    /**
     * @Route("/sortie/b", name="app_sortie_b")
     */
    public function index(): Response
    {
        return $this->render('sortie_b/index.html.twig', [
            'controller_name' => 'SortieBController',
        ]);
    }



/**
     * @Route("/SB", name="SB")
     */
    public function AfficheSortieB(Request $request, PaginatorInterface $paginator){

        $sb = $this->getDoctrine()->getRepository(Sortiebalade::class)->findAll();
        $sb = $paginator->paginate(
            $sb, // Requête contenant les données à paginer 
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            4// Nombre de résultats par page
        );
      
        return $this->render('sortie_b/AfficheSB.html.twig', ['sb' => $sb]); } 

        



 /**
     * @Route("/updateSB/{id}", name="UpdateSortieB")
     */
    /*public function UpdateSortieB(Request $request, $id): Response
    { $rep=$this->getDoctrine()->getRepository(Sortiebalade::class);
        $sb=$rep->find($id); // nouvelle instance 
        $form=$this->createForm(Sortiebalade::class,$sb);
        $form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid())
{

$em=$this->getDoctrine()->getManager();
$em->flush();
return $this->redirectToRoute('AfficheSortieB');
}


        return $this->render('updateSB/updatesb.html.twig', [
            'formC' => $form->createView(),
        ]);
        

    }*/


     
  

   

    

/**
     * @Route("/AddSB", name="AddSB")
     */
    /*public function AddSB(Request $request){

        $sb=new Sortiebalade();
        $rep=$this->getDoctrine()->getRepository(Sortiebalade::class);
       
        $form=$this->createForm(SortiebaladeType::class,$sb);
        $form->add('Ajouter sortie',SubmitType::class);
        $form->handleRequest($request);
    if (($form->isSubmitted()&& $form->isValid())) 
   {
      $em=$this->getDoctrine()->getManager();
      $em->persist($sb);
      $em->flush();
   return $this->redirectToRoute('SB');
   }
      return $this->render('sortie_b/AddSB.html.twig', [
            'form' => $form->createView() ]);

    }*/
    public function ajoutC(Request $request)
    {

        $c= new Sortiebalade();
        $form = $this->createForm(SortiebaladeType::class, $c);
      
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($c);
            $em->flush();
            $this->notify_creation->notify();
            $this->notify_creation->notify();
            return $this->redirectToRoute('SB');
        }


        return $this->render('sortie_b/AddSB.html.twig', [
            'form' => $form->createView()
        ]);

    }
    /**
     * @Route("/deleteSB/{idSB}", name="deletes")
     */
    public function deletesb($idSB , SortiebaladeRepository $rep)
    { $sb=$rep->find($idSB);
      $em=$this->getDoctrine()->getManager();
      $em->remove($sb);
      $em->flush(); 
      $this->notify_creation->notify();
        return $this->redirectToRoute('SB');
       
    }


  /**
     * @Route("/UpSB/{idSB}", name="UpSB")
     */
    public function modifP(Request $request,$idSB): Response
    {
        
        $sb=$this->getDoctrine()->getRepository(Sortiebalade::class)->find($idSB);
        $form=$this->createForm(SortiebaladeType::class,$sb);
   
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em=$this->getDoctrine()->getManager();

            $em->flush();
            $this->notify_creation->notify();
            return $this->redirectToRoute('SB');
        }

        return $this->render('sortie_b/UpdateSB.html.twig', [
            'form' => $form->createView(),
        ]);
    }




/**
     * @Route("/SD", name="SD")
     */

    public function DSD(){
        $sb = $this->getDoctrine()->getRepository(Sortiebalade::class)->DbyS();
        return $this->render('sortie_b/AfficheSB.html.twig', ['sb' => $sb]);

    }








    /**
     * @Route("/pdf", name="pdf")
     */
    
    public function pdf()
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->set('isRemoteEnabled', true);
       
$dompdf = new Dompdf($pdfOptions);
        $rep=$this->getDoctrine()->getRepository(Sortiebalade::class);
        
        $sb =$rep->findAll();
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
       
     
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('sortie_b/pdf.html.twig', [
            'sb' => $sb
        ]);
      
        $options = new Options();

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    }




/**
 * @var NouveauPublicationNotification
 */
private $notify_creation;

/**
 * PublicationController constructor.
 * @param NouveauPublicationNotification $notify_creation
 */
public function __construct(NouveauPublicationNotification $notify_creation)
{
    $this->notify_creation = $notify_creation;
    
}



/**
     * @Route("/Trie", name="Trie")
     */
    public function Trie(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Sortiebalade::class);
        $sortiebalade = $repository->findByDate();

        return $this->render('sortie_b/afficheSB.html.twig', [
            'sb' =>  $sortiebalade,
        ]);
    }


  
}