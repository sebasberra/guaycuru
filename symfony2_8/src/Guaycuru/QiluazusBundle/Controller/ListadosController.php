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
    
}

