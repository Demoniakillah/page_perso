<?php

namespace mainBundle\Entity;

use Doctrine\ORM\EntityRepository;

class expProRepository extends EntityRepository{
    public function findAll(){
        return $this->getEntityManager()
                ->createQuery(
                        'select c from mainBundle:expPro c order by c.dateDebut desc'
                        )
                ->getResult();
        }
}