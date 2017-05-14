<?php

namespace PI\FrontBundle\Repository;
use Doctrine\ORM\EntityRepository;
use PI\FrontBundle\Entity\Evenement;

/**
 * Created by PhpStorm.
 * User: Oumaima
 * Date: 13/02/2017
 * Time: 03:21
 */
class categorie extends EntityRepository

{
    public function findCatDQL($categorie){
    $query=$this->getEntityManager()
        ->createQuery("Select e from PIFrontBundle:evenement e WHERE 
            e.categorie=:categorie ORDER BY e.datedebut DESC " )
        ->setParameter('categorie',$categorie);
    return $query->getResult();
    }


    public function findByNbrlimite($id){
        $query=$this->getEntityManager()->createQuery("update PIFrontBundle:Evenement e set e.nbrelimite = e.nbrelimite -1 , e.nbrparticipants = e.nbrparticipants + 1 WHERE e.id=:id AND e.datedebut > CURRENT_DATE() ")
            ->setParameter('id',$id);
        return $query->getResult();
    }

    public function findByNbrlimite2($id){
        $query=$this->getEntityManager()->createQuery("update PIFrontBundle:Evenement e set e.nbrelimite = e.nbrelimite +1 , e.nbrparticipants = e.nbrparticipants -1  WHERE e.id=:id AND e.datedebut - 2 <= CURRENT_DATE() ")
            ->setParameter('id',$id );
        return $query->getResult();
    }

    public function getParticipantsByEvent($idEvent){

        $query=$this->getEntityManager()->createQuery("select p from PIFrontBundle:Participant p WHERE p.idevenement=:idEvent ")
            ->setParameter('idEvent',$idEvent);
        return $query->getResult();
    }



    public function findByPourcentage(){
        $query=$this->getEntityManager()
            ->createQuery("update PIFrontBundle:Evenement e set e.pourcentage = (e.nbrparticipants*100)/(e.nbrelimite + e.nbrparticipants)");
        return $query->getResult();
    }

    public function showAffiche()
    {
        $this->findByPourcentage();

        $query = $this->getEntityManager()
            ->createQuery("select e from PIFrontBundle:evenement e 
              WHERE e.datefin < CURRENT_DATE() ORDER BY e.pourcentage DESC");
        return $query->getResult();
    }

    public function listeAffiche()
    {
        $query = $this->getEntityManager()
            ->createQuery("select e from PIFrontBundle:evenement e 
              WHERE e.datedebut > CURRENT_DATE() ORDER BY e.datedebut ASC ");
        return $query->getResult();
    }



}