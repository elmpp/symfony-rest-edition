<?php

namespace BorderForce\Drt\FlightsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BorderForceDrtFlightsBundle:Default:index.html.twig', array('name' => $name));
    }
}
