<?php

namespace Guaycuru\YaaukanigaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('YaaukanigaBundle:Default:index.html.twig');
    }
    
    /**
     * @Route("/camas")
     */
    public function camasAction()
    {
        return $this->render('YaaukanigaBundle:Default:index.html.twig');
    }
}
