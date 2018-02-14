<?php
/** 
 * Red Internacion
 * 
 * Llamadas Ajax del sistema
 * 
 * @author Sebastian Berra
 * 
 * @since 0.1.6
 * 
 */
namespace RI\RIWebServicesBundle\Controller\Ajax;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use RI\RIWebServicesBundle\Utils\RI\RIUtiles;

/**
 * Ajax que obtiene los json para cargar los objetos JavaScript OrgChart
 *
 * @author Sebastian Berra <sberra@santafe.gov.ar>
 * 
 */
trait AjaxOrgCharts {
    
    /** 
     * @Route("/configuracion_edilicia/salas_hab_camas/orgchart/json", name="ajax_config_edilicia_salas_hab_camas_orgchart_json")
     * @Method({"GET"})
     */
    public function configEdiliciaSalasHabCamasOrgChartAction(Request $request){
        
        
        $queryString = split('=',$request->getQueryString());
        $id_efector = $queryString[1];
        $content ='{}';
        
        // AJAX
        if ( $request->isXmlHttpRequest()) {

            $this->get('app.ri_utiles');
            
            $config_edilicia = RIUtiles::getSalasHabCamasOrgChartInfo($id_efector);

            $template = 'RIWebServicesBundle:Ajax:ajax_config_edilicia_salas_hab_camas_orgchart_json.html.twig';
            $parameters = array(
                'config_edilicia' => $config_edilicia);
            
            $content = $this->get('templating')->render($template, $parameters);
        }
        
        $jsonResponse = new Response($content , 200);
        $jsonResponse->headers->set('Content-Type', 'application/json');
        return $jsonResponse;
        
    }
    
    /** 
     * @Route("/configuracion_edilicia/servicios_salas/orgchart/json", name="ajax_config_edilicia_servicios_salas_orgchart_json")
     * @Method({"GET"})
     */
    public function configEdiliciaServiciosSalasOrgChartAction(Request $request){
        
        
        $queryString = split('=',$request->getQueryString());
        $id_efector = $queryString[1];
        $content ='{}';
        
        // AJAX
        if ( $request->isXmlHttpRequest()) {

            $this->get('app.ri_utiles');
            
            $config_edilicia = RIUtiles::getServiciosSalasOrgChartInfo($id_efector);

            $template = 'RIBundle:Ajax:ajax_config_edilicia_servicios_salas_orgchart_json.html.twig';
            $parameters = array(
                'config_edilicia' => $config_edilicia);
            
            $content = $this->get('templating')->render($template, $parameters);
        }
        
        $jsonResponse = new Response($content , 200);
        $jsonResponse->headers->set('Content-Type', 'application/json');
        return $jsonResponse;
        
    }
    
    
    /** 
     * @Route("/configuracion_edilicia/efectores_servicios/orgchart/json", name="ajax_config_edilicia_efectores_servicios_orgchart_json")
     * @Method({"GET"})
     */
    public function configEdiliciaEfectoresServiciosOrgChartAction(Request $request){
        
        
        $queryString = split('=',$request->getQueryString());
        $id_efector = $queryString[1];
        $content ='{}';
        
        // AJAX
        if ( $request->isXmlHttpRequest()) {

            $this->get('app.ri_utiles');
            
            $config_edilicia = RIUtiles::getEfectoresServiciosOrgChartInfo($id_efector);

            $template = 'RIBundle:Ajax:ajax_config_edilicia_efectores_servicios_orgchart_json.html.twig';
            $parameters = array(
                'config_edilicia' => $config_edilicia);
            
            $content = $this->get('templating')->render($template, $parameters);
        }
        
        $jsonResponse = new Response($content , 200);
        $jsonResponse->headers->set('Content-Type', 'application/json');
        return $jsonResponse;
        
    }
    
}
