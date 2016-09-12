<?php

namespace Guaycuru\QiluazusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    public function indexAction()
    {
        // doctrine manager
        $em = $this->getDoctrine()->getManager();
        
        $q = $em->createQuery(
                'SELECT c, h, s, e 
                FROM DBHmi2Bundle:Camas AS c
                INNER JOIN c.idHabitacion h
                INNER JOIN h.idSala s
                INNER JOIN s.idEfector e
                ORDER BY c.nombre');
        $camas = $q->getResult();
        
        return $this->render(
                'QiluazusBundle:Default:index.html.twig',               
                array(
                    'camas' => $camas)
                );        
    }
     
}
