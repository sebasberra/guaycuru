<?php

namespace RI\RIWebServicesBundle\Controller\WS;

use FOS\RestBundle\Controller\FOSRestController;



class WSController extends FOSRestController
{
  
    use WSCamasController,
        WSHabitacionesController,
        WSSalasController;
    
    
    private function execConfiguracionEdilicia(
            $datos,
            $accion){
        
                
        // ConfiguracionEdilicia
        $ce = $this->get("app.configuracion_edilicia");
                            
        switch ($accion){

            
        
            case 'agregar_cama':

                $msg = $ce->agregarCama($datos);
                break;

            case 'modificar_cama':

                $msg = $ce->modificarCama($datos);
                break;

            case 'eliminar_cama':

                $msg = $ce->eliminarCama($datos);
                break;

            case 'ocupar_cama':

                $msg = $ce->ocuparCama($datos);
                break;

            case 'liberar_cama':

                $msg = $ce->liberarCama($datos);
                break;

            case 'agregar_habitacion':

                $msg = $ce->agregarHabitacion($datos);
                break;

            case 'modificar_habitacion':

                $msg = $ce->modificarHabitacion($datos);
                break;

            case 'eliminar_habitacion':

                $msg = $ce->eliminarHabitacion($datos);
                break;

            case 'agregar_sala':

                $msg = $ce->agregarSala($datos);
                break;

            case 'modificar_sala':

                $msg = $ce->modificarSala($datos);
                break;

            case 'eliminar_sala':

                $msg = $ce->eliminarSala($datos);
                break;

        }
        
        
        
        
    }
}
