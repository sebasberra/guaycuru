<?php

namespace Pruebas\AssetsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AssetsBundle:Default:index.html.twig');
    }
}
