<?php

namespace PI\FrontBundle\Controller;

use blackknight467\StarRatingBundle\Form\RatingType;
use PI\FrontBundle\Entity\Panier;
use PI\FrontBundle\Entity\Produit;
use PI\FrontBundle\Form\ProduitType;
use PI\FrontBundle\PIFrontBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PI\FrontBundle\Form\ProduitLouerType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * Produit controller.
 *
 */
class ProduitController extends Controller
{
    /**
     * Lists all produit entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('PIFrontBundle:Produit')->findAll();

        return $this->render('PIFrontBundle:produit:index.html.twig', array(
            'produits' => $produits,
        ));
    }

    public function indexxAction()
    {
        $em = $this->getDoctrine()->getManager();
        $somme=0;
        $produits = $em->getRepository('PIFrontBundle:Produit')->findAll();

        foreach ($produits as $p){
            $somme =$somme+ $p->getPrix();
        }
        return $this->render('PIFrontBundle:Front:indexx.html.twig', array(
            'produits' => $produits,'somme'=>$somme,
        ));
    }


    /**
     * Creates a new produit entity.
     *
     */
    public function newAction(Request $request)
    {
        $produit = new Produit();
        $form = $this->createForm('PI\FrontBundle\Form\ProduitType', $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $produit->upload();
            $em->persist($produit);
            $em->flush($produit);

            return $this->redirectToRoute('produit_index');
        }

        return $this->render('PIFrontBundle:produit:new.html.twig', array(
            'produit' => $produit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a produit entity.
     *
     */
    public function showAction(Produit $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);

        return $this->render('PIFrontBundle:produit:show.html.twig', array(
            'produit' => $produit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing produit entity.
     *
     */
    public function editAction(Request $request, Produit $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);
        $editForm = $this->createForm('PI\FrontBundle\Form\ProduitType', $produit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
           $em= $this->getDoctrine()->getManager();
                $produit->upload();


                $em->flush($produit);
            $produit->upload();

            return $this->redirectToRoute('produit_edit', array('id' => $produit->getId()));
        }

        return $this->render('PIFrontBundle:produit:edit.html.twig', array(
            'produit' => $produit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a produit entity.
     *
     */
    public function deleteAction(Request $request, Produit $produit)
    {
        $form = $this->createDeleteForm($produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produit);
            $em->flush($produit);
        }

        return $this->redirectToRoute('produit_index');
    }

    /**
     * Creates a form to delete a produit entity.
     *
     * @param Produit $produit The produit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Produit $produit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produit_delete', array('id' => $produit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function LouerAction(Request $request,$id)
    {

        $em=$this->getDoctrine()->getManager();
        $produit = $em->getRepository('PIFrontBundle:Produit')->find($id);
        $Form= $this->createForm(ProduitLouerType::class, $produit);
        $Form->handleRequest($request);

        if ( $Form->isValid()) {
            $produit->setQuantite($produit->getQuantite()-1);
            $em=$this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('produit_indexx');
        }

        return $this->render('PIFrontBundle:produit:louer.html.twig', array(
            'Form'=>$Form->createView()));
    }
    public function AddtopanierAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $produit = $em->getRepository('PIFrontBundle:Produit')->find($id);

        $listpanier = $em->getRepository('PIFrontBundle:Panier')->findBy(array('etat'=>'Fini'));
        $num =0;
        foreach ($listpanier as $p) {
            $num=$p->getNumero();
        }
        $panier = new Panier();
        $panier->setNumero($num+1);
        $panier->setProduit($produit);
        $panier->setUser($this->getUser());
        $panier->setEtat("En Cours");
        $em->persist($panier);
        $em->flush();

        return $this->redirectToRoute('produit_indexx');
    }

    public function panierAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $panier = $em->getRepository('PIFrontBundle:Panier')->findBy(array('etat'=>'En Cours','user'=>$this->getUser()));

        if (isset($_POST['valider'])) {
            $em = $this->getDoctrine()->getManager();
            $panier = $em->getRepository('PIFrontBundle:Panier')->findBy(array('etat'=>'En Cours'));
            foreach ($panier as $p) {
                $p->setEtat("Fini");
                $em->persist($p);
                $em->flush();
            }
            return $this->redirectToRoute('produit_indexx');
        }
        return $this->render('PIFrontBundle:Front:panier.html.twig',array('panier'=>$panier));
    }

    public function RechercheAction(Request $request)
    {
        $produit= new Produit();
        $em = $this->getDoctrine()->getManager();

        $word=$request->get('word');
        $repository = $em->getRepository('PIFrontBundle:Produit');
        $query = $repository->createQueryBuilder('f')
            ->where("f.Libelle LIKE :word ")
            ->setParameter('word', '%'.$word.'%')
            ->getQuery();

        $produits = $query->getResult();

        return $this->render('PIFrontBundle:Front:indexx.html.twig', array(
            'produits' => $produits,
        ));
    }

    public function exelAction(Request $request)
    {
        // ask the service for a Excel5
        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("liuggio")
            ->setLastModifiedBy("Giulio De Donato")
            ->setTitle("Office 2005 XLSX Test Document")
            ->setSubject("Office 2005 XLSX Test Document")
            ->setDescription("Test document for Office 2005 XLSX, generated using PHP classes.")
            ->setKeywords("office 2005 openxml php")
            ->setCategory("Test result file");
        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('A1', 'nom')
            ->setCellValue('B1', 'prix');;



        $em=$this->getDoctrine()->getManager();
        $produit=$em->getRepository('PIFrontBundle:Produit')->findAll();

        $aux=2;
        foreach ($produit as $produits){
            $phpExcelObject->setActiveSheetIndex(0)->setCellValue('A'.$aux, $produits->getLibelle())
                ->setCellValue('B'.$aux, $produits->getPrix());
            $aux++;


        };
        $phpExcelObject->getActiveSheet()->setTitle('Simple');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'Liste-des-produits.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }










}
