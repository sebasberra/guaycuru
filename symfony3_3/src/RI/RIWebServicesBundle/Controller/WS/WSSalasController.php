<?php
/**
 * Proyecto Final Ingeniería Informática 2017 - UNL - Santa Fe - Argentina
 * 
 * Web Services Plataforma Web para centralización de camas críticas de internación en hospitales de la Provincia de Santa Fe
 * 
 * @author Sebastián Berra <sebasberra@yahoo.com.ar>
 *
 * @version 0.1.0
 */
namespace RI\RIWebServicesBundle\Controller\WS;


use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;

/**
 * **Web Services Salas** 
 * 
 * @api *Librería de Web Services para ABM de la Configuración Edilicia Hospitalaria Prov. de Santa Fe*
 * 
 * @author Sebastián Berra <sebasberra@yahoo.com.ar>
 * 
 * @link http://symfony.com/doc/current/bundles/FOSRestBundle/1-setting_up_the_bundle.html 
 * Documentación de FOSRest Bundle de Symfony
 * 
 * @link https://symfony.com/doc/current/introduction/http_fundamentals.html 
 * Symfony and HTTP Fundamentals
 * 
 * @link http://api.symfony.com/3.4/Symfony/Component/HttpFoundation/Response.html
 * Symfony Response Class
 * 
 */
trait WSSalasController
{
 
    /**
     * **Web Services: Obtiene los datos de la sala**
     * 
     * @Get("/salas/ver/{id_efector}/{nombre_sala}")
     * 
     * @param int $id_efector ID efector
     * @param string $nombre_sala Nombre único de sala en el efector
     * 
     * @return Response Devuelve el código de estado HTTP: 200(OK - Información de sala) 
     * o 404 (sala no encontrada)
     * 
     */
    public function salasVerAction(
            $id_efector,
            $nombre_sala) 
    {
        
        // ConfiguracionEdilicia
        $this->get("app.configuracion_edilicia");
        
        
        try {
                
                    
            $data = RIUtiles::getSalaPorNombre
                    ($nombre_sala, $id_efector);
            
            $status_code = 200;
            
            RIUtiles::logsDebugManual(
                    'WS Ver Sala', 
                    $status_code.' '.$data);

        } catch (\Exception $e) {

            $status_code = 404;

            $data = array('Error'=>$e->getMessage());
            
            RIUtiles::logsDebugManual(
                    'WS Ver Sala', 
                    $status_code.' '.$e->getMessage());

        }

        $view = $this->view($data, $status_code);
        
        return $this->handleView($view);    
        
    }
    
    
    /**
     * **Web Services: Modificar datos de la sala**
     * 
     * @Put("/salas/modificar/{id_efector}/{nombre_sala}/{area_cod_servicio}/{area_sector}/{area_subsector}/{mover_camas}/{baja}")
     * 
     * @param int $id_efector ID efector
     * @param string $nombre_sala Nombre único de sala en el efector
     * @param string $area_cod_servicio código de 3 dígitos del área SIPES
     * @param string $area_sector campo sector correspondiente al área SIPES (1=varones; 2=mujeres; 3=mixto; >3 mixto estudios, talleres, etc)
     * @param string $area_subsector subsector correspondiente al área SIPES (4=internación; 5=CE; 6=atención domiciliaria)
     * @param boolean $mover_camas bandera para el sistema que indica si se permite mover camas entre las habitaciones de la misma sala. por ejemplo: las incubadoras
     * @param boolean $baja 0=habilitada; 1=baja
     * 
     * @return Response Devuelve el código de estado HTTP: 204 (sala actualizada) 
     * o 404 (error de actualización)
     */ 
    public function salasModificarAction(
            $id_efector,
            $nombre_sala,
            $area_cod_servicio,
            $area_sector,
            $area_subsector,
            $mover_camas,
            $baja){
        
        
        // ConfiguracionEdilicia
        $ce = $this->get("app.configuracion_edilicia");
        
        
        $modif_sala = [
            'id_efector' => $id_efector,
            'nombre_sala' => $nombre_sala,
            'area_cod_servicio' => $area_cod_servicio,
            'area_sector' => $area_sector,
            'area_subsector' => $area_subsector,
            'mover_camas' => $mover_camas,
            'baja' => $baja
        ];
        
        
        try {
            
            // begintrans
            RI::$conn->beginTransaction();
        
            $data = $ce->modificarSala($modif_sala);

            $status_code = 204;
            
            RIUtiles::logsDebugManual(
                    'WS Modificar Sala', 
                    $status_code.' '.$data);
                        
            RI::$conn->commit();
            
        } catch (\Exception $e) {

            $status_code = 404;

            $data = array('Error'=>$e->getMessage());

            RI::$conn->rollback();
            
            RIUtiles::logsDebugManual(
                    'WS Modificar Sala', 
                    $status_code.' '.$e->getMessage());
            
        }

        $view = $this->view($data, $status_code);
        
        return $this->handleView($view);
    }
    
    
    /**
     * **Web Services: Agregar sala**
     * 
     * @Post("/salas/nueva/{id_efector}/{nombre_sala}/{nombre_habitacion}/{sexo}/{edad_desde}/{edad_hasta}/{tipo_edad}/{baja}")
     * 
     * @param int $id_efector ID efector
     * @param string $nombre_sala Nombre único de sala en el efector
     * @param string $area_cod_servicio código de 3 dígitos del área SIPES
     * @param string $area_sector campo sector correspondiente al área SIPES (1=varones; 2=mujeres; 3=mixto; >3 mixto estudios, talleres, etc)
     * @param string $area_subsector subsector correspondiente al área SIPES (4=internación; 5=CE; 6=atención domiciliaria)
     * @param boolean $mover_camas bandera para el sistema que indica si se permite mover camas entre las habitaciones de la misma sala. por ejemplo: las incubadoras
     * @param boolean $baja 
     * 
     * @return Response Devuelve el código de estado HTTP: 201 (sala nueva ingresada) 
     * o 404 (error al agregar la sala)
     * 
     */
    public function salasNuevaAction(
            $id_efector,
            $nombre_sala,
            $area_cod_servicio,
            $area_sector,
            $area_subsector,
            $mover_camas,
            $baja){
        
        
        // ConfiguracionEdilicia
        $ce = $this->get("app.configuracion_edilicia");
        
        
        $nueva_sala = [
            'id_efector' => $id_efector,
            'nombre_sala' => $nombre_sala,
            'area_cod_servicio' => $area_cod_servicio,
            'area_sector' => $area_sector,
            'area_subsector' => $area_subsector,
            'mover_camas' => $mover_camas,
            'baja' => $baja
        ];
        
        
        try {
        
            // begintrans
            RI::$conn->beginTransaction();
        
            $data = $ce->agregarSala($nueva_sala);

            $status_code = 201;
            
            RIUtiles::logsDebugManual(
                    'WS Agregar Sala', 
                    $status_code.' '.$data);
            
            RI::$conn->commit();

        } catch (\Exception $e) {

            $status_code = 404;

            $data = array('Error'=>$e->getMessage());
            
            RI::$conn->rollback();
            
            RIUtiles::logsDebugManual(
                    'WS Agregar Sala', 
                    $status_code.' '.$e->getMessage());

        }

        $view = $this->view($data, $status_code);
        
        return $this->handleView($view);
        
    }
    
    
    /**
     * Web Services: Eliminar sala
     *  
     * @param int $id_efector ID efector
     * @param string $nombre_sala Nombre único de sala en el efector
     * 
     * @Delete("/salas/eliminar/{id_efector}/{nombre_sala}")
     * 
     * @return Response Devuelve el código de estado HTTP:200 (sala eliminada) 
     * o 404 (sala no encontrada o error)
     * 
     */
    public function salasEliminarAction(
            $id_efector,
            $nombre_sala){
        
        
    
        // ConfiguracionEdilicia
        $ce = $this->get("app.configuracion_edilicia");
        
        $elimina_sala = [
            'id_efector' => $id_efector,
            'nombre_sala' => $nombre_sala
        ];
        
                
        try {
            
            // begintrans
            RI::$conn->beginTransaction();
                
            $data = $ce->eliminarSala($elimina_sala);

            $status_code = 200;
            
            RIUtiles::logsDebugManual(
                    'WS Eliminar Sala', 
                    $status_code.' '.$data);
            
            RI::$conn->commit();

        } catch (\Exception $e) {

            $status_code = 404;

            $data = array('Error'=>$e->getMessage());
            
            RI::$conn->rollback();
            
            RIUtiles::logsDebugManual(
                    'WS Eliminar Sala', 
                    $status_code.' '.$e->getMessage());

        }

        $view = $this->view($data, $status_code);
        
        return $this->handleView($view);
        
    }
}