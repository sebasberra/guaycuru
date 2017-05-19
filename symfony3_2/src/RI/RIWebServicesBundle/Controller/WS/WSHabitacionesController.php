<?php

namespace RI\RIWebServicesBundle\Controller\WS;


use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\Get;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;


trait WSHabitacionesController
{
    
    
    /**
    * @Get("/habitaciones/ver/{id_efector}/{nombre_sala}/{nombre_habitacion}")
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
    * @Put("/habitaciones/modificar/{id_efector}/{nombre_sala}/{nombre_habitacion}/{sexo}/{edad_desde}/{edad_hasta}/{tipo_edad}/{baja}")
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
        
        // begintrans
        RI::$conn->beginTransaction();
        
        try {
        
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
    * @Post("/habitaciones/nueva/{id_efector}/{nombre_sala}/{nombre_habitacion}/{sexo}/{edad_desde}/{edad_hasta}/{tipo_edad}/{baja}")
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
        
        // begintrans
        RI::$conn->beginTransaction();
        
        try {
                
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
    * @Delete("/habitaciones/eliminar/{id_efector}/{nombre_sala}/{nombre_habitacion}")
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
        
        
        // begintrans
        RI::$conn->beginTransaction();
        
        try {
                
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