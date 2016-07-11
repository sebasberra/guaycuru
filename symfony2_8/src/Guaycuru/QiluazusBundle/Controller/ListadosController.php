<?php

namespace Guaycuru\QiluazusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListadosController extends Controller
{
    
    public function internacionesAction()
    {

        $camas = new \Guaycuru\DBHmi2Bundle\Entity\Camas();
        
        $filtros = 
                $this
                    ->get('stg.deim.themes.aplicativo.filtro')
                    ->getFiltros($camas);

        $query = 
                $this
                    ->get('stg.deim.themes.aplicativo.filtro')
                    ->generarConsultaMultiplesFiltros(
                            'DBHmi2Bundle:Camas', $filtros
                            );
        
        /* doctrine manager
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT c FROM DBHmi2Bundle:Camas c";
        $query = $em->createQuery($dql);
        
        $filtro = array();
        $filtro[0]["columna"] = "nombre";
        $filtro[0]["type"] = "text";
        $filtro[0]["source"] = "";
        $filtro[0]["propiedad"] = "nombre";
        $filtro[0]["label"] = " Nombre de cama";
        $filtro[0]["value"] = null;
        $filtro[0]["options"] = null;
        
        dump($filtros);
        dump($filtro);
        dump($consulta);
        dump($query);
        die();*/
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            1/*page number*/,
            10/*limit per page*/
         );

        // parameters to template
        return $this->render(
                'QiluazusBundle:Default:camas.html.twig', 
                array(
                    'filtros' => $filtros,
                    'pagination' => $pagination)
                );
        
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
        
        // doctrine manager
        $em = $this->getDoctrine()->getManager();
        
        // clasificaciones_camas
        $q4 = $em->createQuery(
                'SELECT c '.
                'FROM DBHmi2Bundle:ClasificacionesCamas c ');/*.
                'WHERE 1 '.
                'ORDER BY cc.clasificacionCama');*/
        $clasificacionesCamas = $q4->getResult();
        
        // efectores
        $q1 = $em->createQuery(
                'SELECT e 
                FROM DBHmi2Bundle:Efectores AS e
                ORDER BY e.nomEfector');
        $efectores = $q1->getResult();
        
        /*
        dump($clasificacionesCamas);
        dump($efectores);
        die();*/
        
        // salas
        $q2 = $em->createQuery(
                'SELECT s 
                FROM DBHmi2Bundle:Salas AS s
                ORDER BY s.nombre');
        $salas = $q2->getResult();
        
        // habitaciones
        $q3 = $em->createQuery(
                'SELECT h 
                FROM DBHmi2Bundle:Habitaciones AS h
                ORDER BY h.nombre');
        $habitaciones = $q3->getResult();
        
        
        
        $qb = $em->createQuery(
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
        
        
        /* filtros
        $filtros = array();
        $filtros[0]["columna"] = "id_efector";
        $filtros[0]["type"] = "text";
        $filtros[0]["source"] = "";
        $filtros[0]["propiedad"] = "id_efector";
        $filtros[0]["label"] = " Nombre de cama";
        $filtros[0]["value"] = null;
        $filtros[0]["options"] = null;*/
        
        /*
        return $this->render(
                'QiluazusBundle:Default:listados.html.twig',               
                array(
                    'pagination' => $pagination,
                    'filtros' => $filtros)
                ); */
        
        return $this->render(
                'QiluazusBundle:Default:listados.html.twig',               
                array(
                    'pagination' => $pagination,
                    'efectores' => $efectores,
                    'salas' => $salas,
                    'habitaciones' => $habitaciones,
                    'clasificacionesCamas' => $clasificacionesCamas)
                );
        
    }
    
}

