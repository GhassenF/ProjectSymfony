<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08/04/2019
 * Time: 22:44
 */

namespace FrontBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventFrontController extends Controller
{
    public function eventAutoAction(){

        return $this->render('@Front/EventFront/eventAuto.html.twig');


    }
    public function eventIAAction(){

        return $this->render('@Front/EventFront/eventIA.html.twig');


    }
    public function eventSpaceAction(){

        return $this->render('@Front/EventFront/eventSpace.html.twig');


    }

}