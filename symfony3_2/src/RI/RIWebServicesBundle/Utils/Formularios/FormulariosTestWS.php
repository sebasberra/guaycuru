<?php

namespace RI\RIWebServicesBundle\Utils\Formularios;


use RI\RIWebServicesBundle\Utils\RI\RIFormularios;
use RI\RIWebServicesBundle\Utils\Render\RenderTest;


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
                    
                    $form = 
                            RIFormularios::crearFormularioTestWSCamas();
                    break;
                
                case RIFormularios::TEST_WS_FORM_HABITACIONES:
                    
                    $form = 
                            RIFormularios::crearFormularioTestWSHabitaciones();
                    break;
                
                case RIFormularios::TEST_WS_FORM_SALAS:
                    
                    $form = 
                            RIFormularios::crearFormularioTestWSSalas();
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