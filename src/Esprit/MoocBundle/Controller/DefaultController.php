<?php

namespace Esprit\MoocBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EspritMoocBundle:Default:index.html.twig', array('name' => $name));
    }
}
