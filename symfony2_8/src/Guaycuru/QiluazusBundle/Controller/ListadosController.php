<?php

namespace Guaycuru\QiluazusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListadosController extends Controller
{
    
    public function internacionesAction()
    {

        $filtros = 
                $this
                    ->get('stg.deim.themes.aplicativo.filtro')
                    ->getFiltros(new Entity());

        $consulta = 
                $this
                    ->get('stg.deim.themes.aplicativo.filtro')
                    ->generarConsultaMultiplesFiltros(
                            $this->Camas, $filtros
                            );
        
        // doctrine manager
        $em = $this->getDoctrine()->getManager();

        //$productos = 
        //    $em->getRepository('QiluazusBundle:Camas')->findByIdEfector(72);

        // $dql   = "SELECT c FROM DBHmi2Bundle:Camas c";
        // $query = $em->createQuery($dql);
        $query = $consulta;
        
        // $paginator  = $this->get('knp_paginator');
        // $pagination = $paginator->paginate(
        //    $query, /* query NOT result */
        //    1/*page number*/,
        //    10/*limit per page*/
        // );

        // parameters to template
        return $this->render('QiluazusBundle:Default:listados.html.twig', array('filtros' => $filtros));
    }
    
    public function ejemploAction()
    {
        // parameters to template
        return $this->render('QiluazusBundle:Default:section_example.html.twig');
        
    }
    
    public function camasAction(
            $id_efector,
            $estado,
            $idClasificacionCama)
    {
        
        $qb = $this->getDoctrine()->getManager()->createQuery(
                'SELECT c, h, s, e
                 FROM DBHmi2Bundle:Camas AS c
                 INNER JOIN c.idHabitacion h
                 INNER JOIN h.idSala s 
                 INNER JOIN c.idEfector e
                 INNER JOIN c.idClasificacionCama cc
                 WHERE c.idEfector = :id_efector
                   AND c.estado = :estado
                   AND c.idClasificacionCama = :idClasificacionCama
                 ORDER BY c.idCama DESC');
        
        $qb->setParameter('id_efector',$id_efector);
        $qb->setParameter('estado',$estado);
        $qb->setParameter('idClasificacionCama',$idClasificacionCama);
        
        //$result = $qb->getResult();
                
        //dump($result);die();
              
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $qb, /* query NOT result */
            1/*page number*/,
            10/*limit per page*/
        );
        
        
        
        return $this->render(
                'QiluazusBundle:Default:camas.html.twig', 
                array('pagination' => $pagination));
        
    }
    
}

