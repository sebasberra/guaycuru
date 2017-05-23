<?php

namespace RI\RIWebServicesBundle\Controller\WS;


use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;


trait WSSalasController
{
 
    /**
    * @Get("/salas/ver/{id_efector}/{nombre_sala}")
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
    * @Put("/salas/modificar/{id_efector}/{nombre_sala}/{area_cod_servicio}/{area_sector}/{area_subsector}/{mover_camas}/{baja}")
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
    * @Post("/salas/nueva/{id_efector}/{nombre_sala}/{nombre_habitacion}/{sexo}/{edad_desde}/{edad_hasta}/{tipo_edad}/{baja}")
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
    * @Delete("/salas/eliminar/{id_efector}/{nombre_sala}")
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