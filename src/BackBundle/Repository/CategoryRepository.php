<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 13/04/2019
 * Time: 19:52
 */

namespace BackBundle\Repository;


use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository{
    public function listname(){
        $query=$this->getEntityManager()
            ->createQuery(" SELECT c.name FROM AppBundle:Category c ");
        return $query->getResult();
    }



}