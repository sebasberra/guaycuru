<?php

namespace RI\RIWebServicesBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


trait WSHabitacionesController{
    
    /**
    * @Route("/agregarhabitacion/{id_efector}/{nombre_sala}/{nombre_habitacion}/{sexo}/{edad_desde}/{edad_hasta}/{tipo_edad}/{baja}",
    *   name="ws_habitaciones_agregar")
    */
    public function agregarHabitacionAction(
            $id_efector,
            $nombre_sala,
            $nombre_habitacion,
            $sexo,
            $edad_desde,
            $edad_hasta,
            $tipo_edad,
            $baja){
        
        
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
        
        return 
            $this->execConfiguracionEdilicia(
                $nueva_hab, 
                "agregar_habitacion");
        
    }
    
    /**
    * @Route("/modificarhabitacion/{id_efector}/{nombre_sala}/{nombre_habitacion}/{sexo}/{edad_desde}/{edad_hasta}/{tipo_edad}/{cant_camas}/{baja}",
    *   name="ws_habitaciones_modificar")
    */
    public function modificarHabitacionAction(
            $id_efector,
            $nombre_sala,
            $nombre_habitacion,
            $sexo,
            $edad_desde,
            $edad_hasta,
            $tipo_edad,
            $cant_camas,
            $baja){
        
        
        $modif_hab = [
            'id_efector' => $id_efector,
            'nombre_sala' => $nombre_sala,
            'nombre_habitacion' => $nombre_habitacion,
            'sexo' => $sexo,
            'edad_desde' => $edad_desde,
            'edad_hasta' => $edad_hasta,
            'tipo_edad' => $tipo_edad,
            'cant_camas' => $cant_camas,
            'baja' => $baja
        ];
        
        return 
            $this->execConfiguracionEdilicia(
                $modif_hab, 
                "modificar_habitacion");
        
    }
    
    
    /**
    * @Route("/eliminarhabitacion/{id_efector}/{nombre_sala}/{nombre_habitacion}",
    *   name="ws_habitaciones_eliminar")
    */
    public function eliminarHabitacionAction(
            $id_efector,
            $nombre_sala,
            $nombre_habitacion){
        
        
        $elimina_habitacion = [
            'id_efector' => $id_efector,
            'nombre_sala' => $nombre_sala,
            'nombre_habitacion' => $nombre_habitacion
        ];
        
        return 
            $this->execConfiguracionEdilicia(
                $elimina_habitacion,
                "eliminar_habitacion");
        
    }
    
}

