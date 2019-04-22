<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 12/04/2019
 * Time: 18:13
 */

namespace FrontBundle\Repository;


use Doctrine\ORM\EntityRepository;

class PayEventRepository extends EntityRepository
{
    public function PayEvenement($numCarte)
    {
        $query=$this->getEntityManager()->createQuery('
        SELECT p.code FROM AppBundle:Pay p WHERE p.numCarte=:numCarte
        ')->setParameter('numCarte',$numCarte);


        return $query->getResult();
    }
    public function incr()
    {

        return $this->getEntityManager()
            ->createQuery(
                'UPDATE  AppBundle:Event  a SET a.nombreParticipants=a.nombreParticipants+1 where a.id=\'' . $_GET['Id'] . '\''
            )
            ->getResult();

    }

}

