<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15/04/2019
 * Time: 21:46
 */

namespace FrontBundle\Repository;


use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository
{
    public function findEntitiesByKind()
    {
        $query = $this->getEntityManager()->createQuery("SELECT i FROM AppBundle:Comment i where i.idArticle IS NOT NULL");

        return $query->getResult();
    }
    public function findEntitiesByIdArtc($id)
    {
        $query = $this->getEntityManager()->createQuery("SELECT i FROM AppBundle:Comment i where i.idArticle = '$id'");

        return $query->getResult();
    }






    public function findEntitiesByIdEv($id)
    {
        $query = $this->getEntityManager()->createQuery("SELECT i FROM AppBundle:Comment i where i.idEvent = '$id'");

        return $query->getResult();
    }


    public function findEntitiesByKinde()
    {
        $query = $this->getEntityManager()->createQuery("SELECT i FROM AppBundle:Comment i where i.idEvent IS NOT NULL");

        return $query->getResult();
    }




}