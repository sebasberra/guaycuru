<?php

namespace Guaycuru\QiluazusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('QiluazusBundle:Default:index.html.twig');
    }
}
