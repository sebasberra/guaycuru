<?php

namespace Guaycuru\TemburesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TemburesBundle:Default:index.html.twig');
    }
}
