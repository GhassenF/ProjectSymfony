<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13/04/2019
 * Time: 23:36
 */

namespace FrontBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileController extends Controller
{
    public function showProfileAction(){

        return $this->render('@Front/ProfileFront/profileUser.html.twig');


    }
}