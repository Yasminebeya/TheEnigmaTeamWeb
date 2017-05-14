<?php

namespace PI\FrontBundle\Controller;

use PI\FrontBundle\Entity\Publication;
use PI\FrontBundle\Form\PublicationType;
use PI\FrontBundle\Form\RechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Publication controller.
 *
 */
class PublicationController extends Controller
{
    /**
     * Lists all publication entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $publications = $em->getRepository('PIFrontBundle:Publication')->findall();

        return $this->render('PIFrontBundle:publication:index.html.twig', array(
            'publications' => $publications,
        ));
    }

    /**
     * Creates a new publication entity.
     *
     */
    public function newAction(Request $request)
    {
        $publication = new Publication();
        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()) {


            $publication->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $publication->upload();
            $em->persist($publication);
            $em->flush($publication);

            return $this->redirectToRoute('publication_index', array('id' => $publication->getId()));
        }

        return $this->render('PIFrontBundle:publication:new.html.twig', array(
            'publication' => $publication,
            'form' => $form->createView(),
        ));
    }



    /**
     * Finds and displays a publication entity.
     *
     */
    public function showAction(Publication $publication)
    {
        $deleteForm = $this->createDeleteForm($publication);

        return $this->render('PIFrontBundle:publication:show.html.twig', array(
            'publication' => $publication,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing publication entity.
     *
     */
    public function editAction(Request $request, Publication $publication)
    {
        $deleteForm = $this->createDeleteForm($publication);
        $editForm = $this->createForm('PI\FrontBundle\Form\PublicationType', $publication);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em= $this->getDoctrine()->getManager();
            $publication->upload();
            $em->flush($publication);
            $publication->upload();


            return $this->redirectToRoute('publication_index', array('id' => $publication->getId()));
        }

        return $this->render('PIFrontBundle:publication:edit.html.twig', array(
            'publication' => $publication,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a publication entity.
     *
     */
    public function deleteAction(Request $request, Publication $publication)
    {
        $form = $this->createDeleteForm($publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($publication);
            $em->flush($publication);
        }

        return $this->redirectToRoute('publication_index');
    }

    /**
     * Creates a form to delete a publication entity.
     *
     * @param Publication $publication The publication entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Publication $publication)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('publication_delete', array('id' => $publication->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    public function jaimeAction(Publication $publication )
    {
        $em=$this->getDoctrine()->getManager();
        $publication->setJaime($publication->getJaime()+1);
        $em->persist($publication);
        $em->flush($publication);
        return $this->redirectToRoute('publication_index');
    }

    public function jaimepasAction(Publication $publication )
    {
        $em=$this->getDoctrine()->getManager();
        $publication->setJaimepas($publication->getJaimepas()+1);
        $em->persist($publication);
        $em->flush($publication);
        return $this->redirectToRoute('publication_index');
    }
    public function rechercheAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $publications=$em->getRepository("PIFrontBundle:Publication")->findAll();

        if (isset($_POST['rech'])) {
            $date1 = $_POST['debut'];
            $date2 = $_POST['fin'];
            $query = $em->createQuery(
                "SELECT e
                 FROM PIFrontBundle:Publication e
                 WHERE e.date >= '$date1' AND e.date <= '$date2'"
            );
            $publications = $query->getResult();
            return $this->render(('PIFrontBundle:publication:recherche.html.twig'), array(
                'publications' => $publications,
            ));
        }

        return $this->render(('PIFrontBundle:publication:recherche.html.twig'), array(
            'publications' => $publications,
        ));
    }

    public function suppAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $modele=$em->getRepository("PIFrontBundle:Publication")->find($id);
        $em->remove($modele);
        $em->flush();
        return $this->redirectToRoute('publication_index');
    }

    public function affbackAction()
    {
        $em = $this->getDoctrine()->getManager();

        $publications = $em->getRepository('PIFrontBundle:Publication')->findall();

        return $this->render('PIFrontBundle:Back:affAct.html.twig', array(
            'publications' => $publications,
        ));
    }

    public function suppbackAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $modele=$em->getRepository("PIFrontBundle:Publication")->find($id);
        $em->remove($modele);
        $em->flush();
        return $this->redirectToRoute('affback');
    }

    public function convertAction (Request $request, $id) {
        require_once ("phpToPDF.php");

        $em = $this->getDoctrine()->getManager();
        $pub = $em->getRepository('PIFrontBundle:Publication')->findOneBy(array('id'=>$id));

        $date = new \DateTime();
        $htmlcode = '<p style="border: solid; border-width: thin">'.$pub->getText().'</p>';

        $pdf_options = array(
            "source_type" => 'html',
            "source" => $htmlcode,
            "action" => 'save',
            "save_directory" => 'C:\Users\Public\Pictures',
            "file_name" => 'publication'.$date->format('H-i-s').'.pdf');

        phptopdf($pdf_options);

        return $this->redirectToRoute('publication_index');
    }
    public function listeAction()
    {

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'SELECT e
         FROM PIFrontBundle:Publication e
          WHERE e.jaime > e.jaimepas
           ORDER BY e.jaime DESC '
        );
        $publications = $query->getResult();


        return $this->render(('PIFrontBundle:publication:liste.html.twig'), array(
            'publications' => $publications,
        ));
    }



}
