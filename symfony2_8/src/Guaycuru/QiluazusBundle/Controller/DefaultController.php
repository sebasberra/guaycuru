<?php

namespace Guaycuru\QiluazusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    public function indexAction()
    {
        /*
        $camas = new \Guaycuru\DBHmi2Bundle\Entity\Camas();
        
        $filtros = 
                $this
                    ->get('stg.deim.themes.aplicativo.filtro')
                    ->getFiltros($camas);

        $consulta = 
                $this
                    ->get('stg.deim.themes.aplicativo.filtro')
                    ->generarConsultaMultiplesFiltros(
                            'DBHmi2Bundle:Camas', $filtros
                            );
        */
        
        $id_efector = 72;
        $tipo_cama = 2;
        $qb = $this->getDoctrine()->getManager()->createQuery(
                'SELECT c, h, s
                 FROM DBHmi2Bundle:Camas AS c
                 INNER JOIN c.idHabitacion h
                 INNER JOIN h.idSala s 
                 WHERE c.idEfector = :id_efector
                   AND c.estado = :libre
                   AND c.idClasificacionCama = :tipo_cama
                 ORDER BY c.idCama DESC');
        $qb->setParameter('id_efector',$id_efector);
        $qb->setParameter('libre','L');
        $qb->setParameter('tipo_cama',$tipo_cama);
        // doctrine manager
        // $em = $this->getDoctrine()->getManager();

        //$productos = 
        //    $em->getRepository('QiluazusBundle:Camas')->findByIdEfector(72);

        // $dql   = "SELECT c FROM DBHmi2Bundle:Camas c";
        // $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $qb, /* query NOT result */
            1/*page number*/,
            10/*limit per page*/
        );
        
        return $this->render('QiluazusBundle:Default:index.html.twig', array('pagination' => $pagination));
        /* return $this->render(
                'QiluazusBundle:Default:index.html.twig', 
                array(
                    'filtros' => $filtros,
                    'pagination' => $pagination)); */
        
    }
     
}
