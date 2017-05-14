<?php

namespace PI\FrontBundle\Repository;
use Doctrine\ORM\EntityRepository ;
use PI\FrontBundle\Entity\Conge;
class CongeRepository extends  EntityRepository
{
    public function findByTypeMaladie()
    {
        $query=$this->getEntityManager()
            ->createQuery("
                      SELECT c FROM PIFrontBundle:Conge c WHERE c.TypeConge = 'Maladie'
                        ");
        return $query->getResult();
    }

    public function findByType($TypeConge)
    {
        $query=$this->getEntityManager()
            ->createQuery("
                      SELECT c FROM PIFrontBundle:Conge c WHERE c.TypeConge LIKE :TypeConge
                        ")->setParameter('TypeConge', $TypeConge) ;
        return $query->getResult();
    }

}