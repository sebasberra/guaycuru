<?php

namespace RI\RIWebServicesBundle\Controller\WS;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


trait WSSalasController 
{

    
    
    /**
    * @Route("/agregarsala/{id_efector}/{nombre_sala}/{area_cod_servicio}/{area_sector}/{area_subsector}/{mover_camas}/{baja}",
    *   name="ws_salas_agregar")
    */
    public function agregarSalaAction(
            $id_efector,
            $nombre_sala,
            $area_cod_servicio,
            $area_sector,
            $area_subsector,
            $mover_camas,
            $baja){
        
        
        
        $nueva_sala = [
            'id_efector' => $id_efector,
            'nombre_sala' => $nombre_sala,
            'area_cod_servicio' => $area_cod_servicio,
            'area_sector' => $area_sector,
            'area_subsector' => $area_subsector,
            'mover_camas' => $mover_camas,
            'baja' => $baja
        ];
        
        
        return 
            $this->execConfiguracionEdilicia(
                $nueva_sala, 
                "agregar_sala");
        
    }
    
    
    /**
    * @Route("/modificarsala/{id_efector}/{nombre_sala}/{area_cod_servicio}/{area_sector}/{area_subsector}/{mover_camas}/{baja}",
    *   name="ws_salas_modificar")
    */
    public function modificarSalaAction(
            $id_efector,
            $nombre_sala,
            $area_cod_servicio,
            $area_sector,
            $area_subsector,
            $mover_camas,
            $baja){
        
        
        $nueva_sala = [
            'id_efector' => $id_efector,
            'nombre_sala' => $nombre_sala,
            'area_cod_servicio' => $area_cod_servicio,
            'area_sector' => $area_sector,
            'area_subsector' => $area_subsector,
            'mover_camas' => $mover_camas,
            'baja' => $baja
        ];
        
        return 
            $this->execConfiguracionEdilicia(
                $nueva_sala, 
                "modificar_sala");
        
    }
    
    /**
    * @Route("/eliminarsala/{id_efector}/{nombre_sala}",
    *   name="ws_salas_eliminar")
    */
    public function eliminarSalaAction(
            $id_efector,
            $nombre_sala){
        
        
        $elimina_sala = [
            'id_efector' => $id_efector,
            'nombre_sala' => $nombre_sala
        ];
        
        return 
            $this->execConfiguracionEdilicia(
                $elimina_sala,
                "eliminar_sala");
        
    }
    
}