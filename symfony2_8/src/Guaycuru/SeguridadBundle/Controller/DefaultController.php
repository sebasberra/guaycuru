<?php

namespace Guaycuru\SeguridadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SeguridadBundle:Default:index.html.twig');
    }
}
