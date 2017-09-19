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
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\Get;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;

/**
 * **Web Services: ABM de Camas**
 * 
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
trait WSCamasController
{
    
    
    /**
     * **Web Services: Obtiene los datos de la cama**
     * 
     * @Get("/camas/ver/{id_efector}/{nombre_cama}")
     * 
     * @param int $id_efector ID efector
     * @param string $nombre_cama Nombre único de cama en el efector
     * 
     * @return Response Devuelve el código de estado HTTP: 200(OK - Información de cama) 
     * o 404 (cama no encontrada)
     * 
     */
    public function camasVerAction(
            $id_efector,
            $nombre_cama) 
    {
        
        // ConfiguracionEdilicia
        $this->get("app.configuracion_edilicia");
        
        
        try {
                
                    
            $data = RIUtiles::getCama($nombre_cama,$id_efector);
            
            $status_code = 200;
            
            RIUtiles::logsDebugManual(
                    'WS Ver Cama', 
                    $status_code.' '.$data);

        } catch (\Exception $e) {

            $status_code = 404;

            $data = array('Error'=>$e->getMessage());
            
            RIUtiles::logsDebugManual(
                    'WS Ver Cama', 
                    $status_code.' '.$e->getMessage());

        }

        $view = $this->view($data, $status_code);
        
        return $this->handleView($view);    
        
    }
    
    /**
     * **Web Services: Modificar datos de la cama**
     * 
     * @Put("/camas/modificar/{id_efector}/{nombre_sala}/{nombre_habitacion}/{nombre_cama}/{id_clasificacion_cama}/{estado}/{rotativa}/{baja}") 
     * 
     * @param int $id_efector ID efector
     * @param string $nombre_sala Nombre de la sala del efector
     * @param string $nombre_habitacion Nombre de la habitación donde está la cama
     * @param string $nombre_cama Nombre único de cama en el efector
     * @param int $id_clasificacion_cama ID de clasificación de cama. Ver tabla clasificaciones_camas
     * @param string $estado L=libre; O=ocupada; F=fuera de servicio; R=en reparacion; V=reservada
     * @param string $rotativa true o false
     * @param string $baja true o false
     * 
     * @return Response Devuelve el código de estado HTTP: 204 (cama actualizada) 
     * o 404 (error de actualización)
     * 
     */
    public function camasModificarAction(
            $id_efector,
            $nombre_sala,
            $nombre_habitacion,
            $nombre_cama,
            $id_clasificacion_cama,
            $estado,
            $rotativa,
            $baja) 
    {
        
        
        // ConfiguracionEdilicia
        $ce = $this->get("app.configuracion_edilicia");
        
        
        $modif_cama = [
            'id_efector' => $id_efector,
            'nombre_sala' => $nombre_sala,
            'nombre_habitacion' => $nombre_habitacion,
            'nombre_cama' => $nombre_cama,
            'id_clasificacion_cama' => $id_clasificacion_cama,
            'estado' => $estado,
            'rotativa' => $rotativa,
            'baja' => $baja
        ];
        
        
        try {
        
            // begintrans
            RI::$conn->beginTransaction();
        
            $data = $ce->modificarCama($modif_cama);

            $status_code = 204;
            
            RIUtiles::logsDebugManual(
                    'WS Modificar Cama', 
                    $status_code.' '.$data);
                        
            RI::$conn->commit();
            
        } catch (\Exception $e) {

            $status_code = 404;

            $data = array('Error'=>$e->getMessage());

            RI::$conn->rollback();
            
            RIUtiles::logsDebugManual(
                    'WS Modificar Cama', 
                    $status_code.' '.$e->getMessage());
            
        }

        $view = $this->view($data, $status_code);
        
        return $this->handleView($view);
        
    }
    
    

    /**
     * **Web Services: Agregar cama**
     * 
     * @Post("/camas/nueva/{id_efector}/{nombre_sala}/{nombre_habitacion}/{nombre_cama}/{id_clasificacion_cama}/{estado}/{rotativa}/{baja}")
     * 
     * @param int $id_efector ID efector
     * @param string $nombre_sala Nombre de la sala del efector
     * @param string $nombre_habitacion Nombre de la habitación donde está la cama
     * @param string $nombre_cama Nombre único de cama en el efector
     * @param int $id_clasificacion_cama ID de clasificación de cama. Ver tabla clasificaciones_camas
     * @param string $estado L=libre; O=ocupada; F=fuera de servicio; R=en reparacion; V=reservada
     * @param string $rotativa true o false
     * @param string $baja true o false
     * 
     * @return Response Devuelve el código de estado HTTP: 201 (cama nueva ingresada) 
     * o 404 (error al agregar la cama)
     * 
     */
    public function camasNuevaAction(
            $id_efector,
            $nombre_sala,
            $nombre_habitacion,
            $nombre_cama,
            $id_clasificacion_cama,
            $estado,
            $rotativa,
            $baja) 
    {
        
        // ConfiguracionEdilicia
        $ce = $this->get("app.configuracion_edilicia");
        
        
        $nueva_cama = [
            'id_efector' => $id_efector,
            'nombre_sala' => $nombre_sala,
            'nombre_habitacion' => $nombre_habitacion,
            'nombre_cama' => $nombre_cama,
            'id_clasificacion_cama' => $id_clasificacion_cama,
            'estado' => $estado,
            'rotativa' => $rotativa,
            'baja' => $baja
        ];
        
        
        try {
            
            // begintrans
            RI::$conn->beginTransaction();
        
            $data = $ce->agregarCama($nueva_cama);

            $status_code = 201;
            
            RIUtiles::logsDebugManual(
                    'WS Agregar Cama', 
                    $status_code.' '.$data);
            
            RI::$conn->commit();

        } catch (\Exception $e) {

            $status_code = 404;

            $data = array('Error'=>$e->getMessage());
            
            RI::$conn->rollback();
            
            RIUtiles::logsDebugManual(
                    'WS Agregar Cama', 
                    $status_code.' '.$e->getMessage());

        }

        $view = $this->view($data, $status_code);
        
        return $this->handleView($view);
        
    }
    
    /**
     * **Web Services: Eliminar cama**
     * 
     * @Delete("/camas/eliminar/{id_efector}/{nombre_cama}")
     * 
     * @param int $id_efector ID efector
     * @param string $nombre_cama Nombre único de cama en el efector
     * 
     * @return Response Devuelve el código de estado HTTP:200 (cama eliminada) 
     * o 404 (cama no encontrada o error)
     *  
     */
    public function camasEliminarAction(
            $id_efector,
            $nombre_cama) 
    {
        
        // ConfiguracionEdilicia
        $ce = $this->get("app.configuracion_edilicia");
        
        
        $eliminar_cama = [
            'id_efector' => $id_efector,
            'nombre_cama' => $nombre_cama
        ];
        
        
        try {
            
            // begintrans
            RI::$conn->beginTransaction();
        
            $data = $ce->eliminarCama($eliminar_cama);

            $status_code = 200;
            
            RIUtiles::logsDebugManual(
                    'WS Eliminar Cama', 
                    $status_code.' '.$data);
            
            RI::$conn->commit();

        } catch (\Exception $e) {

            $status_code = 404;

            $data = array('Error'=>$e->getMessage());
            
            RI::$conn->rollback();
            
            RIUtiles::logsDebugManual(
                    'WS Eliminar Cama', 
                    $status_code.' '.$e->getMessage());

        }

        $view = $this->view($data, $status_code);
        
        return $this->handleView($view);
        
    }
    
    /**
     * **Web Services: Liberar cama**
     * 
     * @Patch("/camas/liberar/{id_efector}/{nombre_cama}")
     * 
     * @param int $id_efector ID efector
     * @param string $nombre_cama Nombre único de cama en el efector
     * 
     * @return Response Devuelve el código de estado HTTP: 204 (cama liberada) 
     * o 404 (cama no encontrada o error)
     * 
     */
    public function camasLiberarAction(
            $id_efector,
            $nombre_cama) 
    {
        
        // ConfiguracionEdilicia
        $ce = $this->get("app.configuracion_edilicia");
        
        $liberar_cama = [
            'id_efector' => $id_efector,
            'nombre_cama' => $nombre_cama
        ];
        
        
        try {
        
            // begintrans
            RI::$conn->beginTransaction();
        
            $data = $ce->liberarCama($liberar_cama);

            $status_code = 204;
            
            RIUtiles::logsDebugManual(
                    'WS Liberar Cama', 
                    $status_code.' '.$data);
            
            RI::$conn->commit();

        } catch (\Exception $e) {

            $status_code = 404;

            $data = array('Error'=>$e->getMessage());
            
            RI::$conn->rollback();
            
            RIUtiles::logsDebugManual(
                    'WS Liberar Cama', 
                    $status_code.' '.$e->getMessage());

        }

        $view = $this->view($data, $status_code);
        
        return $this->handleView($view);
        
    }
    
    /**
     * **Web Services: Ocupar cama**
     * 
     * @Patch("/camas/ocupar/{id_efector}/{nombre_cama}")
     * 
     * @param int $id_efector ID efector
     * @param string $nombre_cama Nombre único de cama en el efector
     * 
     * @return Response Devuelve el código de estado HTTP: 204 (cama ocupada)
     * o 404 (cama no encontrada o error)
     * 
     */
    public function camasOcuparAction(
            $id_efector,
            $nombre_cama) 
    {
        
        // ConfiguracionEdilicia
        $ce = $this->get("app.configuracion_edilicia");
        
        $ocupar_cama = [
            'id_efector' => $id_efector,
            'nombre_cama' => $nombre_cama
        ];
        
        
        try {
            
            // begintrans
            RI::$conn->beginTransaction();
            
            $data = $ce->ocuparCama($ocupar_cama);

            $status_code = 204;
            
            RIUtiles::logsDebugManual(
                    'WS Ocupar Cama', 
                    $status_code.' '.$data);
            
            RI::$conn->commit();

        } catch (\Exception $e) {

            $status_code = 404;

            $data = array('Error'=>$e->getMessage());
            
            RI::$conn->rollback();
            
            RIUtiles::logsDebugManual(
                    'WS Ocupar Cama', 
                    $status_code.' '.$e->getMessage());

        }

        $view = $this->view($data, $status_code);
        
        return $this->handleView($view);
    }
    
}