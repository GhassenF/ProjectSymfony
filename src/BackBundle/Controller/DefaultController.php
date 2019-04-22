<?php

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('default/back.html.twig');
    }
    public function goAction()
    {
        return $this->render('@Back/navigation/event.html.twig');
    }
}
