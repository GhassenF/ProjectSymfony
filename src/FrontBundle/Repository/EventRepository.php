<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 12/04/2019
 * Time: 17:58
 */

namespace FrontBundle\Repository;


class EventRepository extends \Doctrine\ORM\EntityRepository
{
    public function incrementPart()
    {
        return $this->getEntityManager()->createQuery('
update AppBundle:Event e SET e.nombreparticipants=e.nombreparticipants+1 where e.id=');
    }



}