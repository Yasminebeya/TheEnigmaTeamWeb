<?php

namespace PI\FrontBundle\Controller;

use PI\FrontBundle\Entity\Evenement;
use PI\FrontBundle\Entity\Message;
use PI\FrontBundle\Entity\Tache;
use PI\FrontBundle\Entity\Mail;
use PI\FrontBundle\Form\MailType;
use PI\FrontBundle\Form\RechercheTypeTache;
use PI\FrontBundle\Form\TacheType;
use PI\FrontBundle\Form\TacheType2;
use PI\FrontBundle\Form\TacheType3;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PI\FrontBundle\Repository\TacheRepository;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Response;
use Swift_Message;



class TacheController extends Controller
{
    //************************************* back office
  public function ajouterTacheAction(Request $request)//*************************************ajouter tache
    {
        $tache = new Tache();

        if ($request->isMethod('POST')) {
            $datedebut = new \DateTime($request->get('datedebut'));
            $datefin = new \DateTime($request->get('datefin'));
            if( ($datefin < $datedebut) || ($datedebut< new \DateTime())|| ($datefin<new \DateTime()))
            { return $this->render('PIFrontBundle:Back/Tache:alertAjoutTache.html.twig');}
            else {

                $tache->setDatedebut($datedebut);
                $tache->setDatefin($datefin);
                $tache->setDescription($request->get('description'));
                $tache->setEtat("pas encore réalisée");
                $em = $this->getDoctrine()->getManager();
                $em->persist($tache);
                $em->flush();
            }

            return $this->redirectToRoute("pi_back_liste_taches_non_affecte");
        }
        return $this->render("PIFrontBundle:Back/Tache:ajouterTache.html.twig", array());

    }

    public function listeTacheAction(Request $request)//*********************les tache affécté
    {

        $em = $this->getDoctrine()->getManager();
        $listetache = $em->getRepository("PIFrontBundle:Tache")->Tachearealise();

        $tache=$this->get('knp_paginator')->paginate(
            $listetache,
            $request->query->get('page',1),
            5);
        return $this->render('PIFrontBundle:Back/Tache:listeTache.html.twig', array("tache" => $tache));

    }

    public function listeTachenonaffecteAction(Request $request)//********************* les tâches non afféctées
    {
        $em = $this->getDoctrine()->getManager();
        $listetache = $em->getRepository("PIFrontBundle:Tache")->Tachearealisenonaffecte();

        $tache=$this->get('knp_paginator')->paginate(
            $listetache,
            $request->query->get('page',1),
            5

        );


        return $this->render('PIFrontBundle:Back/Tache:listeTachenonaffecte.html.twig', array("tache" => $tache));

    }

    public function affecterTacheAction(Request $request, $id)//**************** affecter une tache a un employé
    {

        $em = $this->getDoctrine()->getManager();
        $tache = $em->getRepository("PIFrontBundle:Tache")->find($id);
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($tache);
            $em->flush();
            return $this->redirectToRoute("pi_back_liste_taches");
        }
        return $this->render("PIFrontBundle:Back/Tache:AffecterTache.html.twig", array("f" => $form->createView()));

    }
    public function updateTacheAction(Request $request, $id)//*********** MAJ
    {
        $em = $this->getDoctrine()->getManager();
        $tache = $em->getRepository("PIFrontBundle:Tache")->find($id);
        $form = $this->createForm(TacheType2::class, $tache);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($tache);
            $em->flush();
            return $this->redirectToRoute("pi_back_liste_taches");
        }
        return $this->render("PIFrontBundle:Back/Tache:updateTache.html.twig", array("f" => $form->createView()));

    }
    public function supprimerTacheAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $tache=$em->getRepository("PIFrontBundle:Tache")->find($id);
        $em->remove($tache);
        $em->flush();

        return $this->redirectToRoute("pi_back_liste_taches_non_affecte");
    }
//*****************************************envoyer convocation :
    public function convocationAction(Request $request)
    {
        $message = new Message();

        //$params = $this->container->get('request')->attributes->get('_route_params');
        $date = new \DateTime();
        if ($request->isMethod('POST')) {

            $x=$request->get('id');

            $message->setNomUser($x);
            $message->setObjet("convocation");
            $message->setDatedenvoye($date);
            $message->setText($request->get('text'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
            return $this->redirectToRoute("pi_back_homepage");

        }

        return $this->render("PIFrontBundle:Back/Tache:convocation.html.twig", array());

    }
    //********************************************Affecter prime
    public function primeAction(Request $request)
    {
        $message = new Message();

        //$params = $this->container->get('request')->attributes->get('_route_params');
        if ($request->isMethod('POST')) {

            $x=$request->get('id');

            $message->setNomUser($x);
            $message->setObjet("prime");
            $message->setText($request->get('text'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute("pi_back_recherche_etat");

        }

        return $this->render("PIFrontBundle:Back/Tache:prime.html.twig", array());

    }


    //***************************** consulter rendement de chaque
    public function consulterRendementAction(Request $request)
    {
        $tache = new Tache();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(RechercheTypeTache::class, $tache);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $listetache = $em->getRepository("PIFrontBundle:Tache")->findBy(array('user'=>$tache->getUser()));

            $tache=$this->get('knp_paginator')->paginate(
                $listetache,
                $request->query->get('page',1),
                5
            );
        }else{
            $listetache=$em->getRepository("PIFrontBundle:Tache")->findAll();

            $tache=$this->get('knp_paginator')->paginate(
                $listetache,
                $request->query->get('page',1),
                5

            );
        }
        return $this->render("PIFrontBundle:Back/Tache:recheTache.html.twig", array("form" => $form->createView(),
            'tache' => $tache));


    }

    //*************************front


    public function tacheAction()// les tâche de user connécté
    {
        $id = $this->container->get('security.token_storage')->getToken()->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $t=$em->getRepository("PIFrontBundle:Tache")->tachesconnecteduser($id);

        return $this->render('PIFrontBundle:Front/Tache:tache.html.twig',array('t'=>$t));
    }

    public function modifieretattacheAction(Request $request,$id)// modification mtaa l'etat mtaa tache
    {
        $em = $this->getDoctrine()->getManager();
        $tache = $em->getRepository("PIFrontBundle:Tache")->find($id);
        $form = $this->createForm(TacheType3::class, $tache);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($tache);
            $em->flush();
            return $this->redirectToRoute("pi_front_tache");
        }
        return $this->render("PIFrontBundle:Front/Tache:updateTacheEtat.html.twig", array("f" => $form->createView()));

    }



   public function convocationfrontAction()// les convocation eli jewh
    {


        //$name = $this->container->get('security.token_storage')->getToken()->getUser()->getUserName();
        $idd=$this->container->get('security.token_storage')->getToken()->getUser()->getUserName();
        //echo $name;
        $em = $this->getDoctrine()->getManager();
        $convocation=$em->getRepository("PIFrontBundle:Message")->convocation($idd);

        return $this->render('PIFrontBundle:Front/Tache:convocationfront.html.twig',array('convocation'=>$convocation));
    }
    //*****************************email
    public function mailAction(Request $request)
    {
        $mail = new Mail();
        $form=$this->createForm(MailType::class,$mail);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $message= \Swift_Message::newInstance()
                ->setSubject('Accusé de recuperation')
                ->setFrom('babdeljawed.marwa@gmail.com')
                ->setTo($mail->getEmail())
                ->setBody(
                    $this->renderView(
                        'PIFrontBundle:Front/Tache:email.html.twig',
                        array('text'=> $mail->getText(),'prenom'=>$mail->getPrenom())
                    ), 'text/html'
                );
            $this->get('mailer')->send($message);
            return $this->redirect($this->generateUrl('pi_front_accuse_mail'));
        }
        return $this->render('PIFrontBundle:Front/Tache:form.html.twig',array('form'=>$form->createView()));
    }

    public function successAction()
    {
        //return new Response("emil envoyé avec succés , L'admin se chargera de vous répondre le plus proche possible");
        return $this->render('PIFrontBundle:Front/Tache:sucess.html.twig');

    }



    public function supprimerConvocationAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $convocation=$em->getRepository("PIFrontBundle:Message")->find($id);
        $em->remove($convocation);
        $em->flush();

        return $this->redirectToRoute("pi_front_message_convocation");
    }







}
