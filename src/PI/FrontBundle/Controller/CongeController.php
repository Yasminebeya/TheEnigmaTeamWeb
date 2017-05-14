<?php

namespace PI\FrontBundle\Controller;

use PI\FrontBundle\Entity\Conge;
use PI\FrontBundle\Form\Recherche1Type;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PI\FrontBundle\Form\RechercheType ;
/**
 * Conge controller.
 *
 */
class CongeController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $conges = $em->getRepository('PIFrontBundle:Conge')->findAll();

        return $this->render('PIFrontBundle:conge:index.html.twig', array(
            'conges' => $conges,'somme'=>$this->indexCalcul()
        ));
    }


    public function newAction(Request $request)
    {
        $conge = new Conge();
        $form = $this->createForm('PI\FrontBundle\Form\CongeType', $conge);
        $form->handleRequest($request);
        $conge->setDatedebut(new \DateTime());
            if ($form->isSubmitted() && $form->isValid()) {
                    $conge->setUser($this->getUser());
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($conge);
                    $em->flush();

                    return $this->redirectToRoute('conge_show', array('id' => $conge->getId()));
                }



        return $this->render('PIFrontBundle:conge:new.html.twig', array(
            'conge' => $conge,
            'form' => $form->createView(),
        ));

        /* $datedebut = new \DateTime($request->get('datedebut'));
            $datefin = new \DateTime($request->get('datefin'));

            if( ($datefin < $datedebut) || ($datedebut< new \DateTime())|| ($datefin<new \DateTime()))
            { return $this->render('PIFrontBundle:Front:alertAjoutConge.html.twig');}
*/
    }

    public function showAction(Conge $conge)
    {
        $deleteForm = $this->createDeleteForm($conge);

        return $this->render('PIFrontBundle:conge:show.html.twig', array(
            'conge' => $conge,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing conge entity.
     *
     */
    public function editAction(Request $request, Conge $conge)
    {
        $deleteForm = $this->createDeleteForm($conge);
        $editForm = $this->createForm('PI\FrontBundle\Form\CongeType', $conge);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('conge_edit', array('id' => $conge->getId()));
        }

        return $this->render('PIFrontBundle:conge:edit.html.twig', array(
            'conge' => $conge,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a conge entity.
     *
     */
    public function deleteAction(Request $request, Conge $conge)
    {
        $form = $this->createDeleteForm($conge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($conge);
            $em->flush($conge);
        }

        return $this->redirectToRoute('conge_index');
    }


    private function createDeleteForm(Conge $conge)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('conge_delete', array('id' => $conge->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function indexBAction()
    {
        $em = $this->getDoctrine()->getManager();

        $conges = $em->getRepository('PIFrontBundle:Conge')->findAll();

        return $this->render('PIFrontBundle:Back:indexCB.html.twig', array(
            'conges' => $conges,
        ));
    }

    public function showbAction(Conge $conge)
    {
        $deleteForm = $this->createDeleteForm($conge);
          $congee= new Conge();
        $congee->setUser($this->getUser());

if(($this->indexCalcul()+$conge->getNbrjours())<=30)
{
    if (isset($_POST['Valider'])) {
        $em = $this->getDoctrine()->getManager();

        $conge->setEtat('Accepter');
        $em->persist($conge);
        $em->flush();


        return $this->redirectToRoute('conge_indexB');
    }
}
        if (isset($_POST['ref'])){
            $em = $this->getDoctrine()->getManager();

            $conge->setEtat('Refuser');
            $em->persist($conge);
            $em->remove($conge);
            $em->flush($conge);

            return $this->redirectToRoute('conge_indexB');
        }
        return $this->render('PIFrontBundle:Back:showB.html.twig', array(
            'conge' => $conge,
            //'delete_formB' => $deleteForm->createView(),
            'congee'=>$congee,
        ));
    }
    public function deleteBAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $conge = $em->getRepository('PIFrontBundle:Conge')->find($id);

        $em->remove($conge);
        $em->flush(); // comme commit , elle donne l'action pour la suppression

        return $this->redirect($this->generateUrl('conge_indexB'));

    }


    public function ListBAction()
    {
        $em=$this->getDoctrine()->getManager();
        $conge=$em->getRepository("PIFrontBundle:Conge")->findBy(array('etat'=>'Accepter'));
        return $this->render("PIFrontBundle:Back:listB.html.twig",array("conge"=>$conge));
    }

    public function indexCalcul()
    { //$user=$this->getUser();
        $em = $this->getDoctrine()->getManager();
        $somme=0;
        $conges=$em->getRepository("PIFrontBundle:Conge")->findBy(array('etat'=>'Accepter', 'user'=>$this->getUser()));
        foreach ($conges as $c){
            $somme +=$c->getNbrjours();
        }

        return $somme;
    }

     public function accepterCongeAction(Request $request)
     {
         $em = $this->getDoctrine()->getManager();
         $conge = $em->getRepository('PIFrontBundle:Conge')->findBy(array('etat'=>'En attente'));



     }

    public function refuserCongeAction(Request $request){


    }

    public function showLBAction(Conge $conge)
    {
        $deleteForm = $this->createDeleteForm($conge);

        return $this->render('PIFrontBundle:Back:showLB.html.twig', array(
            'conge' => $conge,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function rechercheAction(Request $request)
    {
        $rec = new Conge();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(RechercheType::class, $rec);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $conges = $em->getRepository("PIFrontBundle:Conge")->findBy(array('datedebut' => $rec->getDatedebut()));
        } else {
            $conges = $em->getRepository("PIFrontBundle:Conge")->findAll();
        }
        return $this->render(('PIFrontBundle:Back:recherche.html.twig'), array('form' => $form->createView(),
            'conges' => $conges,
        ));


    }

      /*  public function rechercheFAction(Request $request)
        {
            $rec = new Conge();
            $em = $this->getDoctrine()->getManager();
            $Form = $this->createForm(RechercheType::class, $rec);

            $Form->handleRequest($request);
            if ($Form->isValid()) {
                $conges = $em->getRepository("PIFrontBundle:Conge")->findBy(array('datedebut' => $rec->getDatedebut()));
            } else {
                $conges = $em->getRepository("PIFrontBundle:Conge")->findAll();
            }
            return $this->render(('PIFrontBundle:conge:index.html.twig'), array('Form' => $Form->createView(),
                'conge' => $conges,
            ));
        }*/
        public function recherche1Action(Request $request)
    {
        $rec=new Conge() ;
        $em=$this->getDoctrine()->getManager();
        $Form=$this->createForm(Recherche1Type::class,$rec);

        $Form->handleRequest($request);
        if ($Form->isValid()){
            $conges=$em->getRepository("PIFrontBundle:Conge")->findBy(array('TypeConge'=>$rec->getTypeConge()));
        }
        else {
            $conges=$em->getRepository("PIFrontBundle:Conge")->findAll();
        }
        return $this->render(('PIFrontBundle:Back:recherche1.html.twig'), array('form'=>$Form->createView(),
            'conges' => $conges,
        ));
    }







}
