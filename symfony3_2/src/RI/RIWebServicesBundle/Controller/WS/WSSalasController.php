<?php

namespace RI\RIWebServicesBundle\Controller\WS;


use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Patch;
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
    
}