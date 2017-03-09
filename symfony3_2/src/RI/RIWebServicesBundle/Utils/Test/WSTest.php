<?php

namespace RI\RIWebServicesBundle\Utils\Test;

class WSTest
{
    
    
    // Constantes que se usan para saber el estado de la recarga del formulario
    //
    // tipo:
    // 
    // 0 = inicio
    const WS_TEST_INICIO = 0;
    
    
    
    
    public static function dbError($estado){
        
        
        switch ($estado){
            
            // err id_efector
            case -1:
                
                $msg = "El efector no existe";
                
                break;
            
            // err id_sala    
            case -2:
                
                $msg = "La sala no existe";
                
                break;
            
            // err id_efector_servicio
            case -3:
                
                $msg = "El servicio no existe";
                
                break;
                    
            
            // err fecha
            case -4:
                
                $msg = "Controle que la fecha no sea superior al día de hoy";
                
                break;
            
            // err update/insert
            case -5:
                
                $msg = "Error al ingresar o actualizar";
                
                break;
            
        }
        
        return $msg;
    }

}