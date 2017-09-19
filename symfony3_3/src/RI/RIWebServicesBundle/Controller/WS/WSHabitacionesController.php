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
 * **Web Services Habitaciones** 
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
trait WSHabitacionesController
{
    
    
    /**
     * **Web Services: Obtiene los datos de la habitación**
     * 
     * @Get("/habitaciones/ver/{id_efector}/{nombre_sala}/{nombre_habitacion}")
     * 
     * @param int $id_efector ID efector
     * @param string $nombre_sala Nombre único de sala en el efector
     * @param string $nombre_habitacion Nombre único de habitación dentro de la sala
     *
     * @return Response Devuelve el código de estado HTTP: 200(OK - Información de habitación) 
     * o 404 (habitación no encontrada)
     *  
     */
    public function habitacionesVerAction(
            $id_efector,
            $nombre_sala,
            $nombre_habitacion) 
    {
        
        // ConfiguracionEdilicia
        $this->get("app.configuracion_edilicia");
        
        
        try {
                
                    
            $data = RIUtiles::getHabitacion
                    ($nombre_habitacion, $nombre_sala, $id_efector);
            
            $status_code = 200;
            
            RIUtiles::logsDebugManual(
                    'WS Ver Habitación', 
                    $status_code.' '.$data);

        } catch (\Exception $e) {

            $status_code = 404;

            $data = array('Error'=>$e->getMessage());
            
            RIUtiles::logsDebugManual(
                    'WS Ver Habitación', 
                    $status_code.' '.$e->getMessage());

        }

        $view = $this->view($data, $status_code);
        
        return $this->handleView($view);    
        
    }
    
    
    /**
     * **Web Services: Modificar datos de la habitación**
     * 
     * @Put("/habitaciones/modificar/{id_efector}/{nombre_sala}/{nombre_habitacion}/{sexo}/{edad_desde}/{edad_hasta}/{tipo_edad}/{baja}")
     *
     * @param integer $id_efector ID efector
     * @param string $nombre_sala Nombre único de sala en el efector
     * @param string $nombre_habitacion Nombre único de habitación dentro de la sala
     * @param integer $sexo 1=varones 2=mujeres 3=mixta
     * @param integer $edad_desde Edad desde 
     * @param integer $edad_hasta Edad hasta
     * @param integer $tipo_edad 1=años 2=meses 3=días 4=horas 5=minutos 6=se ignora
     * @param boolean $baja 0=habilitada; 1=baja
     * 
     * @return Response Devuelve el código de estado HTTP: 204 (habitación actualizada) 
     * o 404 (error de actualización)
     * 
     */
    public function habitacionesModificarAction(
            $id_efector,
            $nombre_sala,
            $nombre_habitacion,
            $sexo,
            $edad_desde,
            $edad_hasta,
            $tipo_edad,
            $baja){
        
        
        // ConfiguracionEdilicia
        $ce = $this->get("app.configuracion_edilicia");
        
        
        $modif_hab = [
            'id_efector' => $id_efector,
            'nombre_sala' => $nombre_sala,
            'nombre_habitacion' => $nombre_habitacion,
            'sexo' => $sexo,
            'edad_desde' => $edad_desde,
            'edad_hasta' => $edad_hasta,
            'tipo_edad' => $tipo_edad,
            'baja' => $baja
        ];
        
        
        try {
        
            // begintrans
            RI::$conn->beginTransaction();
        
            $data = $ce->modificarHabitacion($modif_hab);

            $status_code = 204;
            
            RIUtiles::logsDebugManual(
                    'WS Modificar Habitación', 
                    $status_code.' '.$data);
                        
            RI::$conn->commit();
            
        } catch (\Exception $e) {

            $status_code = 404;

            $data = array('Error'=>$e->getMessage());

            RI::$conn->rollback();
            
            RIUtiles::logsDebugManual(
                    'WS Modificar Habitación', 
                    $status_code.' '.$e->getMessage());
            
        }

        $view = $this->view($data, $status_code);
        
        return $this->handleView($view);
    }
    
    /**
     * **Web Services: Agregar habitación**
     * 
     * @Post("/habitaciones/nueva/{id_efector}/{nombre_sala}/{nombre_habitacion}/{sexo}/{edad_desde}/{edad_hasta}/{tipo_edad}/{baja}")
     * 
     * @param integer $id_efector ID efector
     * @param string $nombre_sala Nombre único de sala en el efector
     * @param string $nombre_habitacion Nombre único de habitación dentro de la sala
     * @param integer $sexo 1=varones 2=mujeres 3=mixta
     * @param integer $edad_desde Edad desde 
     * @param integer $edad_hasta Edad hasta
     * @param integer $tipo_edad 1=años 2=meses 3=días 4=horas 5=minutos 6=se ignora
     * @param boolean $baja 0=habilitada; 1=baja
     * 
     * @return Response Devuelve el código de estado HTTP: 201 (habitación nueva ingresada) 
     * o 404 (error al agregar la habitación)
     * 
     */
    public function habitacionesNuevaAction(
            $id_efector,
            $nombre_sala,
            $nombre_habitacion,
            $sexo,
            $edad_desde,
            $edad_hasta,
            $tipo_edad,
            $baja){
        
        
        // ConfiguracionEdilicia
        $ce = $this->get("app.configuracion_edilicia");
        
        
        $nueva_hab = [
            'id_efector' => $id_efector,
            'nombre_sala' => $nombre_sala,
            'nombre_habitacion' => $nombre_habitacion,
            'sexo' => $sexo,
            'edad_desde' => $edad_desde,
            'edad_hasta' => $edad_hasta,
            'tipo_edad' => $tipo_edad,
            'baja' => $baja
        ];
        
        
        try {
                
            // begintrans
            RI::$conn->beginTransaction();
        
            $data = $ce->agregarHabitacion($nueva_hab);

            $status_code = 201;
            
            RIUtiles::logsDebugManual(
                    'WS Agregar Habitación', 
                    $status_code.' '.$data);
            
            RI::$conn->commit();

        } catch (\Exception $e) {

            $status_code = 404;

            $data = array('Error'=>$e->getMessage());
            
            RI::$conn->rollback();
            
            RIUtiles::logsDebugManual(
                    'WS Agregar Habitación', 
                    $status_code.' '.$e->getMessage());

        }

        $view = $this->view($data, $status_code);
        
        return $this->handleView($view);
        
    }
            
            
    /**
     * **Web Services: Eliminar habitación**
     * 
     * @Delete("/habitaciones/eliminar/{id_efector}/{nombre_sala}/{nombre_habitacion}")
     * 
     * @param int $id_efector ID efector
     * @param string $nombre_sala Nombre único de sala en el efector
     * @param string $nombre_habitacion Nombre único de habitación dentro de la sala
     * 
     * @return Response Devuelve el código de estado HTTP:200 (habitación eliminada) 
     * o 404 (habitación no encontrada o error)
     * 
     */
    public function habitacionesEliminarAction(
            $id_efector,
            $nombre_sala,
            $nombre_habitacion){
        
        
    
        // ConfiguracionEdilicia
        $ce = $this->get("app.configuracion_edilicia");
        
        $elimina_habitacion = [
            'id_efector' => $id_efector,
            'nombre_sala' => $nombre_sala,
            'nombre_habitacion' => $nombre_habitacion
        ];
        
        
        try {
                
            // begintrans
            RI::$conn->beginTransaction();
        
            $data = $ce->eliminarHabitacion($elimina_habitacion);

            $status_code = 200;
            
            RIUtiles::logsDebugManual(
                    'WS Eliminar Habitación', 
                    $status_code.' '.$data);
            
            RI::$conn->commit();

        } catch (\Exception $e) {

            $status_code = 404;

            $data = array('Error'=>$e->getMessage());
            
            RI::$conn->rollback();
            
            RIUtiles::logsDebugManual(
                    'WS Eliminar Habitación', 
                    $status_code.' '.$e->getMessage());

        }

        $view = $this->view($data, $status_code);
        
        return $this->handleView($view);
        
    }
}