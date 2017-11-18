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

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\JsonResponse;

use RI\RIWebServicesBundle\Utils\RI\RIUtiles;

/**
 * Ajax que obtiene array (json) de consultas específicas, en general se
 * utilizan para carga de combos
 *
 * @author Sebastian Berra <sberra@santafe.gov.ar>
 * 
 */
trait AjaxArraysConfigEdilicia {
    
    
    /** 
     * @Route("/configuracion_edilicia/efector/json", name="ajax_config_edilicia_efector_json")
     * @Method({"GET"})
     */
    public function configEdiliciaEfectorAction(Request $request){
        
        
        $queryString = split('=',$request->getQueryString());
        $id_efector = $queryString[1];
        
        $jsonResponse = new JsonResponse(array(),404);
        
        // AJAX
        if ( $request->isXmlHttpRequest()) {

            $this->get('app.ri_utiles');
            
            try{
                
                $jsonResponse->setData
                        (RIUtiles::getEfectorArray($id_efector,true));
                $jsonResponse->setStatusCode(200);
                
            }catch(\Exception $e){
                
                $jsonResponse->setData($e->getMessage());
                $jsonResponse->setStatusCode(500);
                
                RIUtiles::logsDebugManual(
                        "AJAX: ajax_config_edilicia_efector_json",
                        $e->getMessage());
                
            }
            
        }
        
        return $jsonResponse;
        
    }
    
    /** 
     * @Route("/configuracion_edilicia/sala/json", name="ajax_config_edilicia_sala_json")
     * @Method({"GET"})
     */
    public function configEdiliciaSalaAction(Request $request){
        
        
        $queryString = split('=',$request->getQueryString());
        $id_sala = $queryString[1];
        
        $jsonResponse = new JsonResponse(array(),404);
        
        // AJAX
        if ( $request->isXmlHttpRequest()) {

            $this->get('app.ri_utiles');
            
            try{
                
                $jsonResponse->setData
                        (RIUtiles::getSalaArray($id_sala,true));
                $jsonResponse->setStatusCode(200);
                
            }catch(\Exception $e){
                
                $jsonResponse->setData($e->getMessage());
                $jsonResponse->setStatusCode(500);
                
                RIUtiles::logsDebugManual(
                        "AJAX: ajax_config_edilicia_sala_json",
                        $e->getMessage());
                
            }
            
        }
        
        return $jsonResponse;
        
    }
    
    /** 
     * @Route("/configuracion_edilicia/habitacion/json", name="ajax_config_edilicia_habitacion_json")
     * @Method({"GET"})
     */
    public function configEdiliciaHabitacionAction(Request $request){
        
        
        $queryString = split('=',$request->getQueryString());
        $id_habitacion = $queryString[1];
        
        $jsonResponse = new JsonResponse(array(),404);
        
        // AJAX
        if ( $request->isXmlHttpRequest()) {

            $this->get('app.ri_utiles');
            
            try{
                
                $jsonResponse->setData
                        (RIUtiles::getHabitacionArray($id_habitacion,true));
                $jsonResponse->setStatusCode(200);
                
            }catch(\Exception $e){
                
                $jsonResponse->setData($e->getMessage());
                $jsonResponse->setStatusCode(500);
                
                RIUtiles::logsDebugManual(
                        "AJAX: ajax_config_edilicia_habitacion_json",
                        $e->getMessage());
                
            }
            
        }
        
        return $jsonResponse;
        
    }
    
    
    /** 
     * @Route("/configuracion_edilicia/cama/json", name="ajax_config_edilicia_cama_json")
     * @Method({"GET"})
     */
    public function configEdiliciaCamaAction(Request $request){
        
        
        $queryString = split('=',$request->getQueryString());
        $id_cama = $queryString[1];
        
        $jsonResponse = new JsonResponse(array(),404);
        
        // AJAX
//        if ( $request->isXmlHttpRequest()) {

            $this->get('app.ri_utiles');
            
            try{
                
                $jsonResponse->setData
                        (RIUtiles::getCamaArray($id_cama,true));
                $jsonResponse->setStatusCode(200);
                
            }catch(\Exception $e){
                
                $jsonResponse->setData($e->getMessage());
                $jsonResponse->setStatusCode(500);
                
                RIUtiles::logsDebugManual(
                        "AJAX: ajax_config_edilicia_cama_json",
                        $e->getMessage());
                
            }
            
//        }
        
        return $jsonResponse;
        
    }
    
    /** 
     * @Route("/configuracion_edilicia/efector_serviciohist_ultimo_vigente/json", name="ajax_config_edilicia_efectores_servicioshist_ultimo_vigente_json")
     * @Method({"GET"})
     */
    public function configEdiliciaEfectorServicioHistUltimoVigenteAction(Request $request){
        
        
        $queryString = split('=',$request->getQueryString());
        $id_efector_servicio = $queryString[1];
        
        $jsonResponse = new JsonResponse(array(),404);
        
        // AJAX
        if ( $request->isXmlHttpRequest()) {

            $this->get('app.ri_utiles');
            
            try{
                
                $jsonResponse->setData
                        (RIUtiles::getEfectoresServiciosHistUltimoVigenteArray($id_efector_servicio,true));
                $jsonResponse->setStatusCode(200);
                
            }catch(\Exception $e){
                
                $jsonResponse->setData($e->getMessage());
                $jsonResponse->setStatusCode(500);
                
                RIUtiles::logsDebugManual(
                        "AJAX: ajax_config_edilicia_efectores_servicioshist_ultimo_vigente_json",
                        $e->getMessage());
                
            }
            
        }
        
        return $jsonResponse;
        
    }
    
    
    /** 
     * @Route("/configuracion_edilicia/salahist_ultimo_vigente/json", name="ajax_config_edilicia_salashist_ultimo_vigente_json")
     * @Method({"GET"})
     */
    public function configEdiliciaSalaHistUltimoVigenteAction(Request $request){
        
        
        $queryString = split('=',$request->getQueryString());
        $id_sala = $queryString[1];
        
        $jsonResponse = new JsonResponse(array(),404);
        
        // AJAX
        if ( $request->isXmlHttpRequest()) {

            $this->get('app.ri_utiles');
            
            try{
                
                $jsonResponse->setData
                        (RIUtiles::getSalasHistUltimoVigenteArray($id_sala,true));
                $jsonResponse->setStatusCode(200);
                
            }catch(\Exception $e){
                
                $jsonResponse->setData($e->getMessage());
                $jsonResponse->setStatusCode(500);
                
                RIUtiles::logsDebugManual(
                        "AJAX: ajax_config_edilicia_salashist_ultimo_vigente_json",
                        $e->getMessage());
            }
            
        }
        
        return $jsonResponse;
        
    }
    
    /** 
     * @Route("/configuracion_edilicia/servicio_salahist_ultimo_vigente/json", name="ajax_config_edilicia_servicios_salashist_ultimo_vigente_json")
     * @Method({"GET"})
     */
    public function configEdiliciaServicioSalaHistUltimoVigenteAction(Request $request){
        
        
        $queryString = split('=',$request->getQueryString());
        $id_servicio_sala = $queryString[1];
        
        $jsonResponse = new JsonResponse(array(),404);
        
        // AJAX
        if ( $request->isXmlHttpRequest()) {

            $this->get('app.ri_utiles');
            
            try{
                
                $jsonResponse->setData
                        (RIUtiles::getServiciosSalasHistUltimoVigenteArray($id_servicio_sala,true));
                $jsonResponse->setStatusCode(200);
                
            }catch(\Exception $e){
                
                $jsonResponse->setData($e->getMessage());
                $jsonResponse->setStatusCode(500);
                
                RIUtiles::logsDebugManual(
                        "AJAX: ajax_config_edilicia_servicios_salashist_ultimo_vigente_json",
                        $e->getMessage());
            }
            
        }
        
        return $jsonResponse;
        
    }
    
}
