<?php

namespace PI\FrontBundle\Controller;

use PI\FrontBundle\Entity\Evenement;
use PI\FrontBundle\Entity\Participant;
use PI\FrontBundle\Form\EvenementType;
use PI\FrontBundle\Form\rechercheEventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends Controller
{
    public function indexFrontAction()
    {
        return $this->render('PIFrontBundle:Front:index.html.twig');
    }


    public function actualiteAction()
    {
        return $this->render('PIFrontBundle:Front:actualite.html.twig');
    }

    public function evenementAction()
    {
        return $this->render('PIFrontBundle:Front:evenement.html.twig');
    }

    public function tacheAction()
    {
        return $this->render('PIFrontBundle:Front:tache.html.twig');
    }

    public function ventelocationAction()
    {
        return $this->render('PIFrontBundle:Front:vente_location.html.twig');
    }

    public function congeAction()
    {
        return $this->render('PIFrontBundle:Front:conge.html.twig');
    }

    public function forumAction()
    {
        return $this->render('PIFrontBundle:Front:forum.html.twig');
    }

    public function messagesAction()
    {
        return $this->render('PIFrontBundle:Front:messages.html.twig');
    }

    public function profilAction()
    {
        return $this->render('PIFrontBundle:Front:profil.html.twig');
    }



    public function loginAction()
    {
        return $this->render('PIFrontBundle:Front:login.html.twig');
    }







    public function listeEveAction()
    {

        $em=$this->getDoctrine()->getManager();
        $eve=$em->getRepository("PIFrontBundle:Evenement")->listeAffiche();
        return $this->render('PIFrontBundle:Front:evenement.html.twig',array("evenements"=>$eve));
    }

    public function myEventsAction() {
        $iduser = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $eve = $em->getRepository('PIFrontBundle:Evenement')->findByUser($iduser);

        return $this->render('PIFrontBundle:Front:demandeAjout.html.twig',array("evenements"=>$eve));

    }


    public function infoEveAction($id)
    {
        $iduser = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $eve=$em->getRepository("PIFrontBundle:Evenement")->find($id);
        return $this->render('PIFrontBundle:Front:infoEve.html.twig', array(
            'e' => $eve,'iduser'=>$iduser));

    }

    public function SuppEveAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $eve=$em->getRepository("PIFrontBundle:Evenement")->find($id);
        $part=$em->getRepository("PIFrontBundle:Participant")->findOneBy(array("idevenement"=>$id));
        if ($part != null)
            $em->remove($part);
        $em->remove($eve);
        $em->flush();

        return $this->redirectToRoute("pi_front_evenement");
    }

    public function listeParticipantsAction($idEvent){
        $em=$this->getDoctrine()->getManager();
        $part=$em->getRepository("PIFrontBundle:Participant")->getParticipantsByEvent($idEvent);
        return $this->render('PIFrontBundle:Front:Participation.html.twig',array("participants"=>$part));

    }



    public function nbrlimiteAction(Request $request, $id){

        $id=$request->get('id');
        $part= new Participant();
        $iduser = $this->getUser();
        $part->setUser($iduser);
        $em=$this->getDoctrine()->getManager();
        $em->getRepository("PIFrontBundle:Evenement")->findByNbrlimite($id);
        $eve=$em->getRepository("PIFrontBundle:Evenement")->find($id);
        $part->setidEvenement($eve);
        $user=$em->getRepository("PIFrontBundle:Participant")->findOneBy(array("user"=>$iduser ));
        if ($user == null)
            $em->persist($part);
        $em->flush();
        return $this->render('PIFrontBundle:Front:nbrelimite.html.twig',array('e' => $eve,'iduser'=>$iduser ));

    }

    public function nbrlimite2Action(Request $request,$id){

        $id=$request->get('id');
        $iduser = $this->getUser();
        $em=$this->getDoctrine()->getManager();
        $em->getRepository("PIFrontBundle:Evenement")->findByNbrlimite2($id);
        $eve=$em->getRepository("PIFrontBundle:Evenement")->find($id);
        $part=$em->getRepository("PIFrontBundle:Participant")->findOneBy(array("idevenement"=>$id));
        if ($part != null)
            $em->remove($part);
        $em->flush();

        return $this->render('PIFrontBundle:Front:infoEve.html.twig',array( 'e' => $eve,'iduser'=>$iduser ));
    }

    public function pourcentageAction()
    {
        $iduser = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $eve = $em->getRepository("PIFrontBundle:Evenement")->showAffiche();
        return $this->render('PIFrontBundle:Front:bestEvents.html.twig', array("evenements" => $eve, 'iduser' => $iduser));
    }

    public function rechercheCatAction(\Symfony\Component\HttpFoundation\Request $request){
        $eve=new Evenement();
        $em=$this->getDoctrine()->getManager();
        $evenements=$em->getRepository("PIFrontBundle:Evenement")->findAll();
        $Form=$this->createForm(rechercheEventType::class,$eve);
        $Form->handleRequest($request);
        if ($Form->isValid()){
            $categorie=$eve->getCategorie();
            $evenements=$em->getRepository("PIFrontBundle:Evenement")
                ->findCatDQL($categorie);

        }
        return  $this->render("PIFrontBundle:Front:searchEvent.html.twig",array('form'=>$Form->createView(), 'evenements' => $evenements) );
    }

    public function ajoutEveAction(Request $request)
    {
        $eve = new Evenement();
        if ($request->isMethod('POST')) {


            $datedebut = new \DateTime($request->get('datedebut'));
            $datefin = new \DateTime($request->get('datefin'));



            if( ($datefin < $datedebut) || ($datedebut< new \DateTime())|| ($datefin<new \DateTime()))
            { return $this->render('PIFrontBundle:Front:ajoutevent.html.twig');}

            else {
                $eve->setCategorie($request->get('categorie'));
                $eve->setNom($request->get('nom'));
                $user = $this->getUser();
                $eve->setUser($user);

                $eve->setNbrelimite($request->get('nbrelimite'));
                $eve->setDatedebut($datedebut);
                $eve->setDatefin($datefin);

                $eve->setNbrparticipants('nbrparticipants');
                $eve->setFlag('flag');
                $eve->setPourcentage('pourcentage');



                $eve->setDescription($request->get('description'));
                $eve->setLat($request->get('lat'));
                $eve->setLon($request->get('lon'));
                $em = $this->getDoctrine()->getManager();
                $em->persist($eve);
                $em->flush();

            }

            return $this->redirectToRoute("pi_front_myEvents");
        }
        return $this->render("PIFrontBundle:Front:ajoutevent.html.twig", array());

    }


    public function modifEveAction(Request $request,$id)
    {

        $em=$this->getDoctrine()->getManager();
        $eve=$em->getRepository("PIFrontBundle:Evenement")->find($id);
        $Form= $this->createForm(EvenementType::class, $eve);

        $Form->handleRequest($request);
        if ($Form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($eve);
            $em->flush();
            return $this->redirectToRoute('pi_front_evenement');
        }
        return $this->render("PIFrontBundle:Front:modifevent.html.twig",array('form'=>$Form->createView(), 'e' => $eve) );

    }

}
