<?php

namespace andres\videoclubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('videoBundle:Default:index.html.twig', array('name' => $name));
    }
}
