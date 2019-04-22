<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 15/04/2019
 * Time: 16:55
 */

namespace FrontBundle\Controller;


use AppBundle\Entity\Actualite;
use AppBundle\Entity\Likes;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LikesController extends Controller
{
public function likeaddAction(Request $request)
{
       $actid = $request ->get('id');

       $em = $this->getDoctrine()->getManager();
   $act = $em ->getRepository(Actualite::class)->find($actid);
       $user = $this->get('security.token_storage')->getToken()->getUser();


       $like  = new Likes();

       $like ->setIdActualite($act);
       $like ->setIdUser($user);
       $em = $this->getDoctrine()->getManager();
       $em->persist($like);
       $em->flush();
       return $this->render('@Front/Actualite/likepage.html.twig');
}

}