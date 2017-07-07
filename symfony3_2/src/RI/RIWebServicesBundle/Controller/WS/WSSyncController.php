<?php
/**
 * Proyecto Final Ingeniería Informática 2017 - UNL - Santa Fe - Argentina
 * 
 * Web Services Plataforma Web para centralización de camas críticas de internación en hospitales de la Provincia de Santa Fe
 * 
 * @author Sebastián Berra sebasberra@yahoo.com.ar
 * 
 * @version 0.1.0
 */
namespace RI\RIWebServicesBundle\Controller\WS;

use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;


/**
 * Web Services Sincronizador de Configuración Edilicia 
 * 
 * @api
 * 
 * @author Sebastián Berra sebasberra@yahoo.com.ar
 * 
 * @see http://symfony.com/doc/current/bundles/FOSRestBundle/1-setting_up_the_bundle.html Documentación de FOSRest Bundle de Symfony
 */
trait WSSyncController
{
    
    /**
     * 
     * Web Services para la inicialización y resincronización de la 
     * Configuración Edilicia de un efector
     * 
     * Generar un Request que tenga un "content" con la siguiente información:
     * 
     * Efector: Cualquier efector que tenga implementado el módulo HMI2
     * 
     * Base local: hmi2
     * 
     * Formato: .csv
     * 
     * Separador: ,
     * 
     * Campos encerrados con: "
     * 
     * Orden del listado: Salas, Habitaciones, Camas
     * 
     * NULL: -1
     * 
     * Campos:
     * 
     * id_efector  
     * 
     * sala_nombre                        
     * 
     * sala_cant_camas  
     * 
     * sala_mover_camas  
     * 
     * habitacion_nombre                   
     * 
     * habitacion_sexo  
     * 
     * habitacion_edad_desde  
     * 
     * habitacion_edad_hasta  
     * 
     * habitacion_tipo_edad  
     * 
     * habitacion_cant_camas  
     * 
     * habitacion_baja  
     * 
     * cama_nombre                                 
     * 
     * cama_id_clasificacion_cama  
     * 
     * cama_estado  
     * 
     * cama_rotativa  cama_baja  
     * 
     * @api 
     * 
     * @Post("/sync")
     *
     * @param Request $request Listado de la configuración edilicia en el content
     * 
     * @return Response OK: 200 y id_efector; Error: 404 y mensaje de error
     */
    public function syncAction(Request $request){
        
        
        try {
            
            // content
            $content = $request->getContent();

            // csv
            $serializer = $this->get('serializer');
            $csv = $serializer->decode($content,'csv');

            // ConfiguracionEdilicia
            $ce = $this->get("app.configuracion_edilicia");
            
            // begintrans
            RI::$conn->beginTransaction();

            // check efector
            $id_efector = $csv[0]['id_efector'];
            $data = RIUtiles::getEfector($id_efector);
            
            
            // resync add y update
            foreach ($csv as $row){

                // get arrays camas, habitaciones y salas
                $r = $this->getRowInforme($row);

                $cama = $r['cama'];
                $habitacion = $r['habitacion'];
                $sala = $r['sala'];

                
                // sala
                if ($row['cama_nombre'] == '-1' &&
                    $row['habitacion_nombre'] == '-1'){

                    $ce->refreshAgregarModificarSala($sala);

                }

                // habitacion
                if ($row['cama_nombre'] == '-1' &&
                    $row['habitacion_nombre'] != '-1'){

                    $ce->refreshAgregarModificarHabitacion($habitacion);
                }

                // cama
                if ($row['cama_nombre'] != '-1'){

                    $ce->refreshAgregarModificarCama($cama);
                }
                    
            }
            
            // array camas, habitaciones y salas del informe
            $infcamas = $this->getCamasInforme($csv);
            $infhabs = $this->getHabsInforme($csv);
            $infsalas = $this->getSalasInforme($csv);
        
            // resync eliminar camas
            $ce->refreshEliminarCamas($infcamas);
            
            // resync eliminar habitaciones
            $ce->refreshEliminarHab($infhabs);
            
            // resync eliminar salas
            $ce->refreshEliminarSalas($infsalas);
            
            // 200
            $status_code = 200;
            
            RIUtiles::logsDebugManual(
                    'WS Sync Configuración Edilicia ('.$id_efector.')', 
                    'RESPONSE CODE: '
                    .$status_code
                    .' id_efector: '
                    .$id_efector);
            
            // commit
            RI::$conn->commit();
            

        } catch (\Exception $e) {

            // 404
            $status_code = 404;

            $data = array('Error'=>$e->getMessage());
            
            // rollback
            RI::$conn->rollback();
            
            $descripcion = 'WS Sync Configuración Edilicia';
            if (isset($id_efector)){
                $descripcion.=' ('.$id_efector.')';
            }
            RIUtiles::logsDebugManual(
                    $descripcion,  
                    'RESPONSE CODE: '
                    .$status_code
                    .' Error: '
                    .$e->getMessage());

        }
            
        
        $view = $this->view($data, $status_code);
        
        return $this->handleView($view);
        
    }
    
    /**
     * @internal Separa una fila del informe en 3 arreglos
     * 
     * @param array $row Fila leida del informe de configuración edilicia
     * @return array Arreglo asociativo de camas, habitaciones y salas
     * 
     */
    private function getRowInforme($row){
    
        // informe configuracion edilicia
        //             
        //    sala_nombre
        //    sala_cant_camas
        //    sala_mover_camas
        //
        //    habitacion_nombre
        //    habitacion_sexo
        //    habitacion_edad_desde
        //    habitacion_edad_hasta
        //    habitacion_tipo_edad
        //    habitacion_cant_camas
        //    habitacion_baja
        //
        //    cama_nombre
        //    cama_id_clasificacion_cama
        //    cama_estado
        //    cama_rotativa
        //    cama_baja
                   
            
        /**
         * arreglo cama
         *
         * {id_efector}/{nombre_sala}/{nombre_habitacion}/{nombre_cama}/{id_clasificacion_cama}/{estado}/{rotativa}/{baja}
         * 
         */
        $cama = array(
            'id_efector' => $row['id_efector'],
            'nombre_sala' => $row['sala_nombre'],
            'nombre_habitacion' => $row['habitacion_nombre'],
            'nombre_cama' => $row['cama_nombre'],
            'id_clasificacion_cama' => $row['cama_id_clasificacion_cama'],
            'estado' => $row['cama_estado'],
            'rotativa' => $row['cama_rotativa'],
            'baja' => $row['cama_baja']
                );


        /**
         * arreglo habitacion
         *
         * {id_efector}/{nombre_sala}/{nombre_habitacion}/{sexo}/{edad_desde}/{edad_hasta}/{tipo_edad}/{baja}
         * 
         */
        $habitacion = array(
            'id_efector' => $row['id_efector'],
            'nombre_sala' => $row['sala_nombre'],
            'nombre_habitacion' => $row['habitacion_nombre'],
            'sexo' => $row['habitacion_sexo'],
            'edad_desde' => $row['habitacion_edad_desde'],
            'edad_hasta' => $row['habitacion_edad_hasta'],
            'tipo_edad' => $row['habitacion_tipo_edad'],
            'baja' => $row['habitacion_baja']
                );

        /**
         * arreglo sala
         *
         * {id_efector}/{nombre_sala}/{area_cod_servicio}/{area_sector}/{area_subsector}/{mover_camas}/{baja}
         * 
         */
        $sala = array(
            'id_efector' => $row['id_efector'],
            'nombre_sala' => $row['sala_nombre'],
            'area_cod_servicio' => -1,
            'area_sector' => -1,
            'area_subsector' => -1,
            'mover_camas' => $row['sala_mover_camas'],
            'baja' => false
            );

        return 
            array(
                'cama' => $cama,
                'habitacion' => $habitacion,
                'sala' => $sala
                );
            
    }
    
    /**
     * @internal Obtiene un arreglo de camas del informe de la configuración
     * edilicia recibido
     * 
     * @param array $csv
     * @return array
     * 
     */
    private function getCamasInforme($csv){
        
        $camas = array();
        $i=0;
        
        // bucle informe
        foreach ($csv as $row){

            // cama
            if ($row['cama_nombre'] != '-1'){

                $cama = array(
                    'id_efector' => $row['id_efector'],
                    'nombre_sala' => $row['sala_nombre'],
                    'nombre_habitacion' => $row['habitacion_nombre'],
                    'nombre_cama' => $row['cama_nombre'],
                    'id_clasificacion_cama' => $row['cama_id_clasificacion_cama'],
                    'estado' => $row['cama_estado'],
                    'rotativa' => $row['cama_rotativa'],
                    'baja' => $row['cama_baja']
                        );
                        
                $camas[$i] = $cama;
                $i++;
            }

        }
        
        return $camas;
    
    }
    
    /**
     * @internal Obtiene un arreglo de habitaciones del informe de la 
     * configuración edilicia recibido
     *  
     * @param array $csv
     * @return array
     * 
     * @internal
     */
    private function getHabsInforme($csv){
        
        $habitaciones = array();
        $i=0;
        // bucle informe
        foreach ($csv as $row){

            // habitacion
            if ($row['cama_nombre'] == '-1' &&
                $row['habitacion_nombre'] != '-1'){

                $habitacion = array(
                    'id_efector' => $row['id_efector'],
                    'nombre_sala' => $row['sala_nombre'],
                    'nombre_habitacion' => $row['habitacion_nombre'],
                    'sexo' => $row['habitacion_sexo'],
                    'edad_desde' => $row['habitacion_edad_desde'],
                    'edad_hasta' => $row['habitacion_edad_hasta'],
                    'tipo_edad' => $row['habitacion_tipo_edad'],
                    'baja' => $row['habitacion_baja']
                        );
                        
                $habitaciones[$i] = $habitacion;
                $i++;
            }

        }
    
        return $habitaciones;
    }
    
    /**
     * @internal Obtiene un arreglo de salas del informe de la configuración 
     * edilicia recibido
     * 
     * @param array $csv
     * @return array
     * 
     */
    private function getSalasInforme($csv){
        
        $salas = array();
        $i=0;
        
        // bucle informe
        foreach ($csv as $row){

            // sala
            if ($row['cama_nombre'] == '-1' &&
                $row['habitacion_nombre'] == '-1'){

                $sala = array(
                    'id_efector' => $row['id_efector'],
                    'nombre_sala' => $row['sala_nombre'],
                    'area_cod_servicio' => -1,
                    'area_sector' => -1,
                    'area_subsector' => -1,
                    'mover_camas' => $row['sala_mover_camas'],
                    'baja' => false
                    );
                        
                $salas[$i] = $sala;
                $i++;
                
            }

        }
    
        return $salas;
    }
    
}