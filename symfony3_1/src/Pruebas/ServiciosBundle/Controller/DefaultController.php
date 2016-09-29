<?php

namespace Pruebas\ServiciosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ServiciosBundle:Default:index.html.twig');
    }
}
