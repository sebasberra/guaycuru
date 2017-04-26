<?php

namespace RI\RIWebServicesBundle\Utils\Render;


use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIFormularios;


trait RenderTest{
    
    use Render;
    
    private function renderRedireccionarTestWS(
            $form,
            $test_form){
        
        
        // getdata
        $param = $form->getData();
                
        switch ($test_form){
                    
            // test camas
            case RIFormularios::TEST_WS_FORM_CAMAS:
                
                $datos_cama = 
                        array(
                            'id_efector' => $param['efectores']->getIdEfector(),
                            'nombre_sala' => $param['sala'],
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

                break;
                
            case RIFormularios::TEST_WS_FORM_HABITACIONES:
                
                $datos_habitacion = 
                        array(
                            'id_efector' => $param['efectores']->getIdEfector(),
                            'nombre_sala' => $param['salas']->getNombre(),
                            'nombre_habitacion' => $param['nombre'],
                            'sexo' => $param['sexo'],
                            'tipo_edad' => $param['tipo_edad'],
                            'edad_desde' => $param['edad_desde'],
                            'edad_hasta' => $param['edad_hasta'],
                            'baja' => $param['baja']);


                // agregar
                if ($form->get('bt_agregar')->isClicked()) {

                    // redirect
                    return $this->redirectToRoute(
                            'ws_habitaciones_agregar',
                            $datos_habitacion);

                }

                // modificar
                if ($form->get('bt_modificar')->isClicked()) {

                    // redirect
                    return $this->redirectToRoute(
                            'ws_habitaciones_modificar',
                            $datos_habitacion);

                }

                // eliminar
                if ($form->get('bt_eliminar')->isClicked()) {

                    // redirect
                    return $this->redirectToRoute(
                            'ws_habitaciones_eliminar',
                            $datos_habitacion);

                }
                
                break;
            
            case RIFormularios::TEST_WS_FORM_SALAS:
                
                // area_id_efector_servicio
                $area_efector_servicio = $param['efectores_servicios'];
                if ($area_efector_servicio != null){
                
                    $area_cod_servicio = $area_efector_servicio->getCodServicio();
                    $area_sector = $area_efector_servicio->getSector();
                    $area_subsector = $area_efector_servicio->getSubsector();
                    
                }else{
                    
                    $area_cod_servicio = -1;
                    $area_sector = -1;
                    $area_subsector = -1;
                    
                }
                
                $datos_sala = 
                        array(
                            'id_efector' => $param['efectores']->getIdEfector(),
                            'nombre_sala' => $param['nombre'],
                            'area_cod_servicio' => $area_cod_servicio,
                            'area_sector' => $area_sector,
                            'area_subsector' => $area_subsector,
                            'mover_camas' => $param['mover_camas'],
                            'baja' => $param['baja']);
                
                //dump($datos_sala);die();


                // agregar
                if ($form->get('bt_agregar')->isClicked()) {

                    // redirect
                    return $this->redirectToRoute(
                            'ws_salas_agregar',
                            $datos_sala);

                }

                // modificar
                if ($form->get('bt_modificar')->isClicked()) {

                    // redirect
                    return $this->redirectToRoute(
                            'ws_salas_modificar',
                            $datos_sala);

                }

                // eliminar
                if ($form->get('bt_eliminar')->isClicked()) {

                    // redirect
                    return $this->redirectToRoute(
                            'ws_salas_eliminar',
                            $datos_sala);

                }
                
                break;
            
            default:
                
                throw new \Exception
                    ("Parámetro de formulario de test web services no válido");
                
        }
        
        return null;
        
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

