<?php

namespace PI\FrontBundle\Controller;

use Doctrine\ORM\Mapping\DiscriminatorMap;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PI\FrontBundle\Entity\Conge;
use PI\FrontBundle\Entity\Classe;


class GrapheController extends Controller
{
    public function chartLineAction()

    {

        $em = $this->container->get('doctrine')->getEntityManager();

        $conge = $em->getRepository('PIFrontBundle:Conge')->findAll();

        $tab = array();
        $categories = array();

        $nbMaladie= 0;
        $nbRepos = 0;
        $nbMaternite =0;
        $type= "";

        foreach ($conge as $c) {

            if($c->getTypeConge()== "Maladie"){
                $nbMaladie+= $c->getNbrjours();

            }
        }
        array_push($tab, $nbMaladie);
        array_push($categories,"Maladie");

        foreach ($conge as $c) {
            if($c->getTypeConge()== "Repos"){
                $nbRepos+= $c->getNbrjours();
            }
        }
        array_push($tab, $nbRepos);
        array_push($categories,"Repos");

        foreach ($conge as $c) {
            if($c->getTypeConge()== "Maternité"){
                $nbMaternite+= $c->getNbrjours();
            }
        }
        array_push($tab, $nbMaternite);
        array_push($categories,"Maternité");
// Chart

        $series = array(

            array("User" => "NbJours", "data" => $tab)

        );

        $ob = new Highchart();

        $ob->chart->renderTo('linechart'); // #id du div où afficher le graphe

        $ob->title->text('Nombre de jours congé de chaque type');

        $ob->xAxis->title(array('text' => "Type du congé"));

        $ob->yAxis->title(array('text' => "Nb jours"));

        $ob->xAxis->categories($categories);

        $ob->series($series);

        return $this->render('PIFrontBundle:Graphe:LineChart.html.twig',

            array(

                'chart' => $ob

            ));

    }




}
