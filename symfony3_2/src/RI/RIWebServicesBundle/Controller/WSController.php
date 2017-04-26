<?php

namespace RI\RIWebServicesBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use RI\RIWebServicesBundle\Utils\RI\RI;


class WSController extends Controller
{

    use WSSalasController,
        WSHabitacionesController,
        WSCamasController;
    
    
    /**
    * @Route("/")
    */
    public function indexAction()
    {
        
        return $this->render('RIWebServicesBundle:Default:index.html.twig');
    }
    
    
    
    
    private function execConfiguracionEdilicia(
            $datos,
            $accion){
        
                
        // ConfiguracionEdilicia
        $ce = $this->get("app.configuracion_edilicia");
        
        try{
                    
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
        
            return $this->render(
                'RIWebServicesBundle:Default:msg.html.twig',
                array(
                    'datos' => $datos,
                    'msg' => $msg,
                    'error_debug' => RI::$error_debug)
                    );
            
        } catch (\Exception $e) {

            $msg = $e->getMessage();
            
            switch ($accion){

                case 'agregar_cama':
                    
                    $titulo = "Error al agregar la cama";
                    break;
                
                case 'modificar_cama':
                    
                    $titulo = "Error al modificar la cama";
                    break;

                case 'eliminar_cama':

                   $titulo = "Error al eliminar la cama";
                   break;
               
                case 'ocupar_cama':
                   
                   $titulo = "Error al ocupar la cama";
                   break;
               
                case 'liberar_cama':
                    
                   $titulo = "Error al liberar la cama";
                   break;
               
                case 'agregar_habitacion':
                    
                   $titulo = "Error al agregar la habitación";
                   break;
               
                case 'modificar_habitacion':
                    
                   $titulo = "Error al modificar la habitación";
                   break;
               
                case 'eliminar_habitacion':
                    
                   $titulo = "Error al eliminar la habitación";
                   break;
               
                case 'agregar_sala':
                    
                   $titulo = "Error al agregar la sala";
                   break;
               
                case 'modificar_sala':
                    
                   $titulo = "Error al modificar la sala";
                   break;
                
                case 'eliminar_sala':
                    
                   $titulo = "Error al eliminar la sala";
                   break;
               

            }
            
            // error al generar el censo
            return $this->render(
                    'Exception/error.html.twig',
                    array(
                        'titulo' => $titulo,
                        'msg' => $msg,
                        'debug' => RI::$error_debug)
                    );
        }
    }
}
