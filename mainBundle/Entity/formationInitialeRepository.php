<?php

namespace mainBundle\Entity;

use Doctrine\ORM\EntityRepository;

class formationInitialeRepository extends EntityRepository{
    public function findAll(){
        return $this->getEntityManager()
                ->createQuery(
                        'select c from mainBundle:formationInitiale c order by c.dateDebut desc'
                        )
                ->getResult();
        }
}