<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 10/04/2019
 * Time: 00:53
 */

namespace BackBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\OrderBy;

class ActualiteRepository extends EntityRepository
{
    //backkkkkkkkkkkkkkkkkkActualite
    public function affactbyadmin($userid)
    {
        $query=$this->getEntityManager()
            ->createQuery(" SELECT a FROM AppBundle:Actualite a WHERE IDENTITY(a.user)= :user_id AND a.archivestatut = 1 AND a.date <= CURRENT_DATE() ORDER BY a.date DESC")
            ->setParameter('user_id',$userid);


        return $query->getResult();


    }
    public function afficherpardate($userid){//actualitedautreetab
        $query=$this->getEntityManager()
        ->createQuery(" SELECT a FROM AppBundle:Actualite a WHERE IDENTITY(a.user)!= :user_id AND a.archivestatut = 1 AND  a.date <= CURRENT_DATE() ORDER BY a.date DESC")
            ->setParameter('user_id',$userid);
             return $query->getResult();
    }
    public function actualitebyid($id){
        $query=$this->getEntityManager()
            ->createQuery(" SELECT a FROM AppBundle:Actualite a WHERE  a.id = :id ")
            ->setParameter('id',$id);
        return $query->getResult();
    }
    public function affichearchiveact()
    {
        $query=$this->getEntityManager()
            ->createQuery(" SELECT a FROM AppBundle:Actualite a WHERE a.archivestatut = 0 AND a.date <= CURRENT_DATE() ORDER BY a.date DESC");

        return $query->getResult();
    }
public function findEntitiesByString($str){

        return $this->getEntityManager()
            ->createQuery(
                'SELECT a
                FROM AppBundle:Actualite a
                WHERE a.titre LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }


    //fronttttttttttttttttttttttttttttttttttttttttttttt Actualite
    public function affichetodayactualite($id){
        $query=$this->getEntityManager()
            ->createQuery(" SELECT a FROM AppBundle:Actualite a JOIN UserBundle:User u WITH a.user =  u.id WHERE u.roles LIKE :id AND a.archivestatut = 1  AND a.date = CURRENT_DATE() ORDER BY a.date DESC ")
             ->setParameter('id',$id);
            return $query->getResult();
    }
    public function affichageparcategory($x){
        $limit=('6');
    $query=$this->getEntityManager()
        ->createQuery('SELECT a from AppBundle:Actualite a  JOIN AppBundle:Category c  WITH a.categories = c.id WHERE c.name LIKE :x  AND a.archivestatut = 1 AND a.date <= CURRENT_DATE() ORDER BY a.date DESC ')
        ->setMaxResults($limit)
        ->setParameter('x',$x);

        return $query->getResult();
    }
    public function affichageparlikenumber(){
        $limit=('5');
        $query=$this->getEntityManager()
            ->createQuery('SELECT a from AppBundle:Actualite a JOIN AppBundle:Likes l WITH l.idactualite = a.id GROUP BY l.idactualite ORDER BY  COUNT(*) DESC')
        ->setMaxResults($limit);
        return $query->getResult();
    }
    public function parcountaffichage()
    {
        $query = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('a, COUNT(l.idactualite) AS mycount')

            ->from('\AppBundle\Actualite', 'a')
            ->join('\AppBundle\Likes','l')
            ->where('l.idactualite = a.id')

            ->orderBy('mycount', 'DESC')
        ->setMaxResults('5');
        return $query;
    }
    public function parcountactualite()
    {

        $query=$this->getEntityManager()
            ->createQuery("SELECT a.id , COUNT(l.id) AS score FROM AppBundle:Actualite a LEFT JOIN AppBundle:Likes l WITH a.id = l.idactualite GROUP BY l.id ORDER BY score DESC ");
//SELECT COUNT(l.idactualite) FROM AppBundle:Likes l WHERE l.idactualite = :id
        return $query->getResult();
    }

public function mostliked(){
        $query=$this ->getEntityManager()
            ->createQuery('SELECT a FROM AppBundle:Actualite a WHERE  a.archivestatut = 1 ORDER BY a.nbrelike DESC')
           ->setMaxResults(5);
        return $query->getResult();
}

}