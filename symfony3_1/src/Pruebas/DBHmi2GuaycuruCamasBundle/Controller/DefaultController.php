<?php

namespace Pruebas\DBHmi2GuaycuruCamasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DBHmi2GuaycuruCamasBundle:Default:index.html.twig');
    }
}
