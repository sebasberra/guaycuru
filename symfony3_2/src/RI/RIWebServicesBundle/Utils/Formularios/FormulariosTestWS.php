<?php

namespace RI\RIWebServicesBundle\Utils\Formularios;


use RI\RIWebServicesBundle\Utils\RI\RIFormularios;
use RI\RIWebServicesBundle\Utils\Render\RenderTest;

use RI\RIWebServicesBundle\Utils\RI\RI;


trait FormulariosTestWS
{

    use RenderTest;
    
    private function crearFormularioTestWS(
            $request,
            $test_form){
        
        try {
            
            $this->get('app.ri_formularios');
        
            switch ($test_form){
            
                // camas
                case RIFormularios::TEST_WS_FORM_CAMAS:
                    
                    $form = RI::$form_factory->create(
                            'RI\RIWebServicesBundle\Form\Test\TestWSCamasType');
                    
                    break;
                
                case RIFormularios::TEST_WS_FORM_HABITACIONES:
                    
                    $form = RI::$form_factory->create(
                            'RI\RIWebServicesBundle\Form\Test\TestWSHabitacionesType');
                    
                    break;
                
                case RIFormularios::TEST_WS_FORM_SALAS:
                    
                    $form = RI::$form_factory->create(
                            'RI\RIWebServicesBundle\Form\Test\TestWSSalasType');
                    
                    break;
                
                default:
                    
                    throw new \Exception
                    ("Parámetro de formulario de test web services no válido");
            
            }
                            
            $form->handleRequest($request);
            
            
        } catch (\Exception $e) {
            
            throw $e;
            
        }
        
        return $form;
        
    }
    
    
}