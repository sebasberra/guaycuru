<?php

namespace RI\RIWebServicesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/",name="default")
     */
    public function indexAction()
    {
        return $this->render('RIWebServicesBundle:Default:index.html.twig');
    }
}
