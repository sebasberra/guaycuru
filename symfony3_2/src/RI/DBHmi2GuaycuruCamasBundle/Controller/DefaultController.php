<?php

namespace RI\DBHmi2GuaycuruCamasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('DBHmi2GuaycuruCamasBundle:Default:index.html.twig');
    }
}
