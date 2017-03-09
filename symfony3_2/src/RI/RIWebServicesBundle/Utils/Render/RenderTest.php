<?php

namespace RI\RIWebServicesBundle\Utils\Render;


use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIFormularios;


trait RenderTest{
    
    
    private function renderRedireccionarTestWS($form){
        
        
        // getdata
        $param = $form->getData();
                
        $datos_cama = 
                array(
                    'id_efector' => $param['efectores']->getIdEfector(),
                    'nombre_sala' => 72001,
                    'nombre_habitacion' => $param['habitaciones']->getNombre(),
                    'nombre_cama' => $param['nombre'],
                    'id_clasificacion_cama' => $param['clasificaciones_camas']->getIdClasificacionCama(),
                    'estado' => $param['estado'],
                    'rotativa' => $param['rotativa'],
                    'baja' => $param['baja']);
        
        
        // agregar
        if ($form->get('bt_agregar')->isClicked()) {
        
            // redirect
            return $this->redirectToRoute(
                    'ws_camas_agregar',
                    $datos_cama);

        }
        
        // modificar
        if ($form->get('bt_modificar')->isClicked()) {
            
            // redirect
            return $this->redirectToRoute(
                    'ws_camas_modificar',
                    $datos_cama);

        }

        // eliminar
        if ($form->get('bt_eliminar')->isClicked()) {
            
            // redirect
            return $this->redirectToRoute(
                    'ws_camas_eliminar',
                    $datos_cama);

        }
        
        
        // liberar
        if ($form->get('bt_liberar')->isClicked()) {
            
            // redirect
            return $this->redirectToRoute(
                    'ws_camas_liberar',
                    $datos_cama);

        }

        // ocupar
        if ($form->get('bt_ocupar')->isClicked()) {

            // redirect
            return $this->redirectToRoute(
                    'ws_camas_ocupar',
                    $datos_cama);
            
        }

        
        // baja
        if ($form->get('bt_baja')->isClicked()) {
        
            // redirect
            return $this->redirectToRoute(
                    'ws_camas_baja',
                    $datos_cama);

        }
                
    }
    
    
    
    private function renderFormularioTestWS(
            $form,
            $test_estado,
            $test_form,
            $msg){
        
        
        switch ($test_form){
                    
            // test camas
            case RIFormularios::TEST_WS_FORM_CAMAS:
                
                $twig_templete = 'RIWebServicesBundle:Test:RITestWSCamas.html.twig';
                
                break;   
            
            case RIFormularios::TEST_WS_FORM_HABITACIONES:
                
                $twig_templete = 'RIWebServicesBundle:Test:RITestWSHabitaciones.html.twig';
                
                break;
            
            case RIFormularios::TEST_WS_FORM_SALAS:
                
                $twig_templete = 'RIWebServicesBundle:Test:RITestWSSalas.html.twig';
                
                break;
            
            default:
                
                throw new \Exception
                    ("Parámetro de formulario de test web services no válido");
                
        }
        
        
        
        // render formulario
        return $this->render(
                $twig_templete,
                array(
                    'form' => $form->createView(),
                    'test_estado' => $test_estado,
                    'msg' => $msg,
                    'debug' => RI::$error_debug)
                );
    }
    
}

