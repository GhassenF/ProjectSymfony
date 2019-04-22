<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 15/04/2019
 * Time: 02:12
 */

namespace BackBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NotifController extends Controller
{
public function displaynotifAction(){
    $user = $this->get('security.token_storage')->getToken()->getUser();

    $notif= $this->getDoctrine()->getManager()->getRepository('AppBundle:notif')->afficherparusernotif($user);
    return $this->render('@Back/Actualite/notifications.html.twig',array(
        'notification' => $notif
    ));
}




}