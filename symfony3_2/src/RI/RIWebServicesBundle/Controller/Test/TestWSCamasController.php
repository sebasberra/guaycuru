<?php

namespace RI\RIWebServicesBundle\Controller\Test;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


trait TestWSCamasController{
    
    /**
    * @Route("/agregarcama/{id_efector}/{nombre_sala}/{nombre_habitacion}/{nombre_cama}/{id_clasificacion_cama}/{estado}/{rotativa}/{baja}",
    *   name="ws_camas_agregar")
    */
    public function agregarCamaAction(
            $id_efector,
            $nombre_sala,
            $nombre_habitacion,
            $nombre_cama,
            $id_clasificacion_cama,
            $estado,
            $rotativa,
            $baja){
        
        
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
        
        return 
            $this->execConfiguracionEdilicia(
                $nueva_cama, 
                "agregar_cama");
        
    }    
    
    
    
    /**
    * @Route("/modificarcama/{id_efector}/{nombre_sala}/{nombre_habitacion}/{nombre_cama}/{id_clasificacion_cama}/{estado}/{rotativa}/{baja}",
    *   name="ws_camas_modificar")
    */
    public function modificarCamaAction(
            $id_efector,
            $nombre_sala,
            $nombre_habitacion,
            $nombre_cama,
            $id_clasificacion_cama,
            $estado,
            $rotativa,
            $baja){
        
        
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
        
        return 
            $this->execConfiguracionEdilicia(
                $modif_cama, 
                "modificar_cama");
        
    }
    
    
    /**
    * @Route("/eliminarcama/{id_efector}/{nombre_cama}",
    *   name="ws_camas_eliminar")
    */
    public function eliminarCamaAction(
            $id_efector,
            $nombre_cama){
        
        
        $elimina_cama = [
            'id_efector' => $id_efector,
            'nombre_cama' => $nombre_cama
        ];
        
        return 
            $this->execConfiguracionEdilicia(
                $elimina_cama,
                "eliminar_cama");
        
    }
    
    /**
    * @Route("/ocuparcama/{id_efector}/{nombre_cama}",
    *   name="ws_camas_ocupar")
    */
    public function ocuparCamaAction(
            $id_efector,
            $nombre_cama){
        
        
        $ocupa_cama = [
            'id_efector' => $id_efector,
            'nombre_cama' => $nombre_cama
        ];
        
        return 
            $this->execConfiguracionEdilicia(
                $ocupa_cama,
                "ocupar_cama");
        
    }
    
    /**
    * @Route("/liberarcama/{id_efector}/{nombre_cama}",
    *   name="ws_camas_liberar")
    */
    public function liberarCamaAction(
            $id_efector,
            $nombre_cama){
        
        
        $libera_cama = [
            'id_efector' => $id_efector,
            'nombre_cama' => $nombre_cama
        ];
        
        return 
            $this->execConfiguracionEdilicia(
                $libera_cama,
                "liberar_cama");
        
    }
    
}