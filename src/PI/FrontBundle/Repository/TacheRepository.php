<?php
namespace PI\FrontBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TacheRepository extends  EntityRepository
{
    public function FindTacheByDate($date)
    {
        $query = $this->getEntityManager()
        ->createQuery("SELECT t from PIFrontBundle:Tache t where t.datedebut=:date")
            ->setParameter('date',$date);
        return $query->getResult();


    }

    public function Tachenonrealise() // les taches eli date mté7om fétét w mat5edmouch
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT t from PIFrontBundle:Tache t where (t.datefin<CURRENT_DATE() and t.etat='pas encore réalisée')
or (t.datefin<CURRENT_DATE () and t.etat='en train de réalisation')
           ");

        return $query->getResult();

    }

    public function Tachearealise() // les taches eli f lista w mizelou ma t5edmouch
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT t from PIFrontBundle:Tache t where t.datefin> CURRENT_DATE() and t.etat='pas encore réalisée'
      and t.user is not null");

        return $query->getResult();

    }
    //************************

    public function Tachearealisenonaffecte() // les taches eli f lista w mizelou ma t5edmouch w mahom afécté
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT t from PIFrontBundle:Tache t where t.datefin> CURRENT_DATE() and t.etat='pas encore réalisée'
            and t.user is NULL ");

        return $query->getResult();

    }
    //*************************

    public function tachesconnecteduser($user) // taches de l'utilisateur connécté
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT t from PIFrontBundle:Tache t where t.user=:user and (t.etat='pas encore réalisée' or 
                t.etat='en train de réalisation') and t.datefin> CURRENT_DATE()")
            ->setParameter('user',$user);
        return $query->getResult();

    }
    public function convocation($nomuser) // taches de l'utilisateur connécté
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT m from PIFrontBundle:Message m where m.nomUser=:nomUser")
            ->setParameter('nomUser',$nomuser);
        return $query->getResult();

    }
}