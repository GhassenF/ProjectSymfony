<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12/04/2019
 * Time: 20:21
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;

class ArticleRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a FROM AppBundle:Article  a INNER JOIN AppBundle:Statarticle st WITH a.Statarticle=st.idart  ORDER BY st.nbrvue ASC'
            )
            ->getResult();
    }
    public function incr()
    {

        return $this->getEntityManager()
            ->createQuery(
                'UPDATE  AppBundle:Statarticle  a SET a.nbrvue=a.nbrvue+1 where a.idart=\'' . $_GET['Id'] . '\''
            )
            ->getResult();

    }

}