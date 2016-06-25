<?php

namespace Guaycuru\YaaukanigaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('YaaukanigaBundle:Default:index.html.twig');
    }
}
