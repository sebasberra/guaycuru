<?php

namespace Guaycuru\YaaukanigaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PruebaController extends Controller
{
    
    
    /**
     * @Route("/prueba")
     */
    public function pruebaAction()
    {
        return $this->render('YaaukanigaBundle:Default:index.html.twig');
    }
}
