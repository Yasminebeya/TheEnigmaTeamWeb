<?php

namespace PI\FrontBundle\Controller;

use PI\FrontBundle\Entity\Conge;
use PI\FrontBundle\Entity\Evenement;
use PI\FrontBundle\Entity\Tache;
use PI\FrontBundle\Form\EvenementType;
use PI\FrontBundle\Form\rechercheEventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;


class BackController extends Controller
{


    public function indexBackAction()
    {
        $em = $this->getDoctrine()->getManager();
        $t = $em->getRepository("PIFrontBundle:Tache")->Tachenonrealise();
        return $this->render('PIFrontBundle:Back:indexBack.html.twig',array('t'=>$t));
    }

    public function loginAction()
    {
        return $this->render('PIFrontBundle:Front:login.html.twig');
    }

    public function listeEveAction()
    {
        $iduser = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $eve = $em->getRepository("PIFrontBundle:Evenement")->listeAffiche();
        return $this->render('PIFrontBundle:Back:listeEve.html.twig', array("evenements" => $eve, 'iduser' => $iduser));
    }

    public function listeParticipantsAction($idEvent){
        var_dump($idEvent);
        $em=$this->getDoctrine()->getManager();
        $part=$em->getRepository("PIFrontBundle:Participant")->getParticipantsByEvent($idEvent);
        return $this->render('PIFrontBundle:Back:Participants.html.twig',array("participants"=>$part));

    }

    public function pourcentageAction()
    {
        $iduser = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $eve = $em->getRepository("PIFrontBundle:Evenement")->showAffiche();
        return $this->render('PIFrontBundle:Back:Events.html.twig', array("evenements" => $eve, 'iduser' => $iduser));
    }

    public function infoEveAction($id)
    {
        $iduser = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $eve = $em->getRepository("PIFrontBundle:Evenement")->find($id);
        return $this->render('PIFrontBundle:Back:infoEve.html.twig', array(
            'e' => $eve, 'iduser' => $iduser));

    }

    public function SuppEveAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $eve = $em->getRepository("PIFrontBundle:Evenement")->find($id);
        $em->remove($eve);
        $em->flush();

        return $this->redirectToRoute("pi_back_listeEve");
    }

    public function ajoutEveAction(Request $request)
    {
        $eve = new Evenement();
        if ($request->isMethod('POST')) {


            $datedebut = new \DateTime($request->get('datedebut'));
            $datefin = new \DateTime($request->get('datefin'));


            if (($datefin < $datedebut) || ($datedebut < new \DateTime()) || ($datefin < new \DateTime())) {
                return $this->render('PIFrontBundle:Back:alertAjoutTache.html.twig');
            } else {

                $eve->setFlag(1);
                $eve->setCategorie($request->get('categorie'));
                $eve->setNom($request->get('nom'));
                $user = $this->getUser();
                $eve->setUser($user);
                $eve->setPourcentage($request->get('pourcentage'));
                $eve->setNbrelimite($request->get('nbrelimite'));
                $eve->setNbrparticipants(0);
                $eve->setDatedebut($datedebut);
                $eve->setDatefin($datefin);

                $eve->setImage($request->get('imageFile'));
                $eve->setDescription($request->get('description'));
                $eve->setLieu($request->get('lieu'));
                $eve->setLat($request->get('lat'));
                $eve->setLon($request->get('lon'));
                $em = $this->getDoctrine()->getManager();
                $em->persist($eve);
                $em->flush();

            }

            return $this->redirectToRoute("pi_back_listeEve");
        }
        return $this->render("PIFrontBundle:Back:ajoutEve.html.twig", array());

    }

    public function modifEveAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $eve = $em->getRepository("PIFrontBundle:Evenement")->find($id);
        $Form = $this->createForm(EvenementType::class, $eve);

        $Form->handleRequest($request);
        if ($Form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($eve);
            $em->flush();
            return $this->redirectToRoute('pi_back_listeEve');
        }
        return  $this->render("PIFrontBundle:Back:modifEve.html.twig", array('form' => $Form->createView(), 'e' => $eve));

    }

    public function rechercheCatDQLAction(Request $request)
    {
        $eve = new Evenement();
        $em = $this->getDoctrine()->getManager();
        $evenements = $em->getRepository("PIFrontBundle:Evenement")->findAll();
        $Form = $this->createForm(rechercheEventType::class, $eve);
        $Form->handleRequest($request);
        if ($Form->isValid()) {
            $categorie = $eve->getCategorie();
            $evenements = $em->getRepository("PIFrontBundle:Evenement")
                ->findCatDQL($categorie);

        }
        return $this->render("PIFrontBundle:Back:rechercheEve.html.twig", array('form' => $Form->createView(), 'evenements' => $evenements));
    }



}
