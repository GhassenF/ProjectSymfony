<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 15/04/2019
 * Time: 16:51
 */

namespace BackBundle\Repository;


use Doctrine\ORM\EntityRepository;

class LikesRepository extends EntityRepository
{
public function countlikes($id) {
    $query=$this->getEntityManager()
        ->createQuery("SELECT COUNT(l.idactualite) FROM AppBundle:Likes l WHERE l.idactualite = :id")
        ->setParameter('id',$id);
    return $query->getSingleScalarResult();
}
public function likejustonetime($idact,$iduser){
    $query=$this->getEntityManager()
        ->createQuery("SELECT l FROM AppBundle:Likes l WHERE l.idactualite = :idact AND l.iduser = :iduser")
        ->setParameters(
        array(
            'idact' => $idact,
            'iduser' =>$iduser));
    return $query->getResult();
}





}