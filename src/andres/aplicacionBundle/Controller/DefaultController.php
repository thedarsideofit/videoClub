<?php

namespace andres\aplicacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('aplicacionBundle:Default:index.html.twig', array('name' => $name));
    }
}
