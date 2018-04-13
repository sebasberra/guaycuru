<?php
/**
 * Controlador para el anexo del sistema de SET
 * 
 * @author Sebastián Berra sebasberra@yahoo.com.ar
 */
namespace RI\RIWebServicesBundle\Controller\Ayuda;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * Controlador para la ayuda
 * 
 * @author Sebastián Berra sebasberra@yahoo.com.ar
 */
class AyudaController extends Controller
{
        
    /**
     * Ayuda consulta de camas
     * 
     * @Route("/consultas/camas")
     * 
     */
    public function consultaAction(){
    
        return $this->render(
                'RIWebServicesBundle:Ayuda:Consultas/camas.html.twig');
    }
    
    /**
     * Acerca de
     * 
     * @Route("/acercade")
     * 
     */
    public function acercadeAction(){
    
        $configuraciones_sistemas =
                $this
                ->getDoctrine()
                ->getRepository('DBHmi2GuaycuruCamasBundle:ConfiguracionesSistemas')
                ->findAll();
        
        return $this->render(
                'RIWebServicesBundle:Ayuda:acercade.html.twig',
                array(
                    'configuraciones_sistemas' => $configuraciones_sistemas
                    )
                );
    }
    
    /**
     * Contacto
     * 
     * @Route("/contacto")
     * 
     */
    public function contactoAction(){
    
        return $this->render(
                'RIWebServicesBundle:Ayuda:contacto.html.twig');
    }
    
}