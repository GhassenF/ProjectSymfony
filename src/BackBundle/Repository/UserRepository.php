<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 14/04/2019
 * Time: 22:41
 */

namespace BackBundle\Repository;


use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function selectionnerRoleadmin()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT u.id FROM UserBundle:User u WHERE u.roles LIKE :role'
            )->setParameter('role', '%"ROLE_ADMIN"%');

       return $users = $query->getResult();
    }
    public function selectionnerRoleetab()
    {
        $query =$this->getEntityManager()
            ->createQuery(
                'SELECT u FROM UserBundle:User u WHERE u.roles LIKE :role'
            )->setParameter('role', '%"ROLE_ETAB"%');

       return $users = $query->getResult();
    }
}