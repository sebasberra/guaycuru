<?php

namespace Guaycuru\QiluazusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListadosController extends Controller
{
    
    public function internacionesAction()
    {

        // doctrine manager
        $em = $this->getDoctrine()->getManager();

        //$productos = 
        //    $em->getRepository('QiluazusBundle:Camas')->findByIdEfector(72);

        $dql   = "SELECT c FROM QiluazusBundle:Camas c";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            1/*page number*/,
            10/*limit per page*/
        );

        // parameters to template
        return $this->render('QiluazusBundle:Default:listados.html.twig', array('pagination' => $pagination));
    }
}

