<?php

namespace RI\RIWebServicesBundle\Utils\RI;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;


class RIFormularios extends RI
{
    
    const CD_FORM_SALA = 0;
    const CD_FORM_SERVICIO = 1;
    const CD_FORM_SALA_SERVICIO = 2;
    
    const TEST_WS_FORM_CAMAS = 0;
    const TEST_WS_FORM_HABITACIONES = 1;
    const TEST_WS_FORM_SALAS = 2;
    
    
    public static function crearFormularioCDSalas(
            $id_sala,
            $fecha_censo){
        
        
        $id_efector = RI::$user->getEfector()->getIdEfector();
        
        // form options
        if (!isset($id_sala) || !isset($fecha_censo)){
            
            // options
            $options=array(
                'id_efector' => $id_efector,
                'sala' => null,
                'fecha_censo' => date('Y-m-d')
            );
            
        }else{
            
            try{
                
                $form_options = 
                        self::checkOptionsCDSalas(
                                $id_sala, 
                                $fecha_censo);
                
                
            } catch (\Exception $e) {

                throw $e;
            
            }
            
            // options
            $options=array(
                'id_efector' => $id_efector,
                'sala' => $form_options['sala'],
                'fecha_censo' => $form_options['fecha_censo']
            );
            
            
        }
        
        
        
        // form
        $form = RI::$form_factory->create(
                    'RI\RIWebServicesBundle\Form\CensosDiariosSalasType',
                    $options
                );
    
        
    
        return $form;
    }
    
    
    public static function crearFormularioCDServicios(
            $id_efector_servicio,
            $fecha_censo){
        
        
        $id_efector = RI::$user->getEfector()->getIdEfector();
        
        // form options
        if (!isset($id_efector_servicio) || !isset($fecha_censo)){
            
            // options
            $options=array(
                'id_efector' => $id_efector,
                'efector_servicio' => null,
                'fecha_censo' => date('Y-m-d')
            );
            
        }else{
            
            try{
                
                $form_options = 
                        self::checkOptionsCDServicios(
                                $id_efector_servicio, 
                                $fecha_censo);
                
                                
            } catch (\Exception $e) {

                throw $e;
            
            }
            
            // options
            $options=array(
                'id_efector' => $id_efector,
                'efector_servicio' => $form_options['efector_servicio'],
                'fecha_censo' => $form_options['fecha_censo']
            );
            
            
        }
        
        
        
        // form
        $form = RI::$form_factory->create(
                    'RI\RIWebServicesBundle\Form\CensosDiariosServiciosType',
                    $options
                );
    
        
    
        return $form;
    }
    
    
    private static function checkOptionsCDSalas(
            $id_sala,
            $fecha_censo){
        
        // sala
        try {

            $sala = RIUtiles::getSala($id_sala,false);

        } catch(\Exception $e) {

            throw $e;

        }

        // check fecha
        try {

            $fc = new \DateTime($fecha_censo);

        } catch (\Exception $e) {

            $msg = "Fecha: ".$fecha_censo." no válida";

            RI::$error_debug = "<p>".$e->getMessage()."</p>";

            throw new \Exception($msg);
        }
        
        $fecha_censo_my = $fc->format('Y-m-d');
    
        // OK
        return array(
            'sala' => $sala,
            'fecha_censo' => $fecha_censo_my
                );
        
    }
    
    
    private static function checkOptionsCDServicios(
            $id_efector_servicio,
            $fecha_censo){
        
        // sala
        try {

            $efector_servicio = 
                    RIUtiles::getEfectorServicio(
                            $id_efector_servicio,
                            false);

        } catch(\Exception $e) {

            throw $e;

        }

        // check fecha
        try {

            $fc = new \DateTime($fecha_censo);

        } catch (\Exception $e) {

            $msg = "Fecha: ".$fecha_censo." no válida";

            RI::$error_debug = "<p>".$e->getMessage()."</p>";

            throw new \Exception($msg);
        }
        
        $fecha_censo_my = $fc->format('Y-m-d');
    
        // OK
        return array(
            'efector_servicio' => $efector_servicio,
            'fecha_censo' => $fecha_censo_my
                );
        
    }
}
