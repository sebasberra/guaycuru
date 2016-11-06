<?php

namespace Pruebas\WSBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ConfiguracionEdiliciaController extends Controller
{
    
    /**
    * @Route("/")
    */
    public function indexAction()
    {
        
        return $this->render('WSBundle:Default:index.html.twig');
    }
    
    /**
    * @Route("/agregarcama/{id_efector}/{nombre_sala}/{nombre_habitacion}/{nombre_cama}/{id_clasificacion_cama}/{estado}/{rotativa}/{baja}")
    */
    public function agregarCamaAction(
            $id_efector,
            $nombre_sala,
            $nombre_habitacion,
            $nombre_cama,
            $id_clasificacion_cama,
            $estado,
            $rotativa,
            $baja){
        
        
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
        
        return 
            $this->execConfiguracionEdilicia(
                $nueva_cama, 
                "agregar_cama");
        
    }    
    
    
    
    /**
    * @Route("/modificarcama/{id_efector}/{nombre_sala}/{nombre_habitacion}/{nombre_cama}/{id_clasificacion_cama}/{estado}/{rotativa}/{baja}")
    */
    public function modificarCamaAction(
            $id_efector,
            $nombre_sala,
            $nombre_habitacion,
            $nombre_cama,
            $id_clasificacion_cama,
            $estado,
            $rotativa,
            $baja){
        
        
        $modif_cama = [
            'id_efector' => $id_efector,
            'nombre_sala' => $nombre_sala,
            'nombre_habitacion' => $nombre_habitacion,
            'nombre_cama' => $nombre_cama,
            'id_clasificacion_cama' => $id_clasificacion_cama,
            'estado' => $estado,
            'rotativa' => $rotativa,
            'baja' => $baja
        ];
        
        return 
            $this->execConfiguracionEdilicia(
                $modif_cama, 
                "modificar_cama");
        
    }
    
    
    /**
    * @Route("/eliminarcama/{id_efector}/{nombre_cama}")
    */
    public function eliminarCamaAction(
            $id_efector,
            $nombre_cama){
        
        
        $elimina_cama = [
            'id_efector' => $id_efector,
            'nombre_cama' => $nombre_cama
        ];
        
        return 
            $this->execConfiguracionEdilicia(
                $elimina_cama,
                "eliminar_cama");
        
    }
    
    /**
    * @Route("/ocuparcama/{id_efector}/{nombre_cama}")
    */
    public function ocuparCamaAction(
            $id_efector,
            $nombre_cama){
        
        
        $ocupa_cama = [
            'id_efector' => $id_efector,
            'nombre_cama' => $nombre_cama
        ];
        
        return 
            $this->execConfiguracionEdilicia(
                $ocupa_cama,
                "ocupar_cama");
        
    }
    
    /**
    * @Route("/liberarcama/{id_efector}/{nombre_cama}")
    */
    public function liberarCamaAction(
            $id_efector,
            $nombre_cama){
        
        
        $libera_cama = [
            'id_efector' => $id_efector,
            'nombre_cama' => $nombre_cama
        ];
        
        return 
            $this->execConfiguracionEdilicia(
                $libera_cama,
                "liberar_cama");
        
    }
    
    
    /**
    * @Route("/agregarhabitacion/{id_efector}/{nombre_sala}/{nombre_habitacion}/{sexo}/{edad_desde}/{edad_hasta}/{tipo_edad}/{baja}")
    */
    public function agregarHabitacionAction(
            $id_efector,
            $nombre_sala,
            $nombre_habitacion,
            $sexo,
            $edad_desde,
            $edad_hasta,
            $tipo_edad,
            $baja){
        
        
        $nueva_hab = [
            'id_efector' => $id_efector,
            'nombre_sala' => $nombre_sala,
            'nombre_habitacion' => $nombre_habitacion,
            'sexo' => $sexo,
            'edad_desde' => $edad_desde,
            'edad_hasta' => $edad_hasta,
            'tipo_edad' => $tipo_edad,
            'baja' => $baja
        ];
        
        return 
            $this->execConfiguracionEdilicia(
                $nueva_hab, 
                "agregar_habitacion");
        
    }
    
    /**
    * @Route("/modificarhabitacion/{id_efector}/{nombre_sala}/{nombre_habitacion}/{sexo}/{edad_desde}/{edad_hasta}/{tipo_edad}/{cant_camas}/{baja}")
    */
    public function modificarHabitacionAction(
            $id_efector,
            $nombre_sala,
            $nombre_habitacion,
            $sexo,
            $edad_desde,
            $edad_hasta,
            $tipo_edad,
            $cant_camas,
            $baja){
        
        
        $modif_hab = [
            'id_efector' => $id_efector,
            'nombre_sala' => $nombre_sala,
            'nombre_habitacion' => $nombre_habitacion,
            'sexo' => $sexo,
            'edad_desde' => $edad_desde,
            'edad_hasta' => $edad_hasta,
            'tipo_edad' => $tipo_edad,
            'cant_camas' => $cant_camas,
            'baja' => $baja
        ];
        
        return 
            $this->execConfiguracionEdilicia(
                $modif_hab, 
                "modificar_habitacion");
        
    }
    
    private function execConfiguracionEdilicia(
            $datos,
            $accion){
        
        
        // ConfiguracionEdilicia
        $ce=$this->get("configuracion_edilicia");
        
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

            }
        
            return $this->render(
                'WSBundle:Default:msg.html.twig',
                array(
                    'datos' => $datos,
                    'msg' => $msg,
                    'error_debug' => $ce::$ERROR_DEBUG)
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
               

            }
            
            // error al generar el censo
            return $this->render(
                    'Exception/error.html.twig',
                    array(
                        'titulo' => $titulo,
                        'msg' => $msg,
                        'debug' => $ce::$ERROR_DEBUG)
                    );
        }
    }
}
