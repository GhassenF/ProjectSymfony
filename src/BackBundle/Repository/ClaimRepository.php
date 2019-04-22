<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 14/04/2019
 * Time: 21:36
 */

namespace BackBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ClaimRepository extends EntityRepository
{

    public function findEntitiesByString($str)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT l
                FROM AppBundle:Claimevent l
                WHERE l.object LIKE :str'
            )
            ->setParameter('str', '%' . $str . '%')
            ->getResult();
    }
}