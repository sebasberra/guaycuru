<?php

namespace RI\RIWebServicesBundle\Controller\WS;

use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;

use Doctrine\ORM\NoResultException;


trait WSSyncController
{
    
    /**
    * @Post("/sync/{id_efector}")
    */
    public function syncAction(
            Request $request,
            $id_efector){
        
        $status_code = 201;
//        dump($request);die();
        $data = $request->getContent();
//        $csv = new CsvEncoder(',', '"');
//        $csvd = $csv->decode($data, 'csv');
        
        $serializer = $this->get('serializer');
        $csv = $serializer->decode($data,'csv');
        
        foreach ($csv as $row){
            
            $nombre_cama = $row['nombre_cama'];
            $nombre_habitacion = $row['nombre_habitacion'];
            $nombre_sala = $row['nombre_sala'];
            
            if ($nombre_cama == '-1'){
                
                if ($nombre_habitacion == '-1'){
                    
                    $tipo = 'sala';
                }else{
                    
                    $tipo = 'habitacion';
                }
            
            }else{
                
                $tipo = 'cama';
            }
            
            switch ($tipo){
                
                case 'cama':
                    
                    try{
                    
                        $cama = RIUtiles::getCama($nombre_cama, $id_efector);
                        
                    } catch (NoResultException $nre) {

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
                                    'WS Agregar Cama en Sync Controller', 
                                    $status_code.' '.$data);

                            RI::$conn->commit();

                        } catch (\Exception $e) {

                            $status_code = 404;

                            $data = array('Error'=>$e->getMessage());

                            RI::$conn->rollback();

                            RIUtiles::logsDebugManual(
                                    'WS Agregar Cama en Sync Controller', 
                                    $status_code.' '.$e->getMessage());

                        }
                    }
                    
                    
                    break;
                
                case 'habitacion':
                    
                    RIUtiles::getHabitacion($nombre_habitacion, $nombre_sala, $id_efector);
                    
                    break;
                
                case 'sala':
                    
                    RIUtiles::getSalaPorNombre($nombre_sala, $id_efector);
                    
                    break;
            }
            
        }
//        dump($data);
//        die();
        
        $view = $this->view($csv, $status_code);
        
        return $this->handleView($view);
        
    }
            
}