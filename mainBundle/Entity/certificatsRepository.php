<?php

namespace mainBundle\Entity;

use Doctrine\ORM\EntityRepository;

class certificatsRepository extends EntityRepository{
    public function findAll(){
        return $this->getEntityManager()
                ->createQuery(
                        'select c from mainBundle:certificats c order by c.dateObtention desc'
                        )
                ->getResult();
        }
}
