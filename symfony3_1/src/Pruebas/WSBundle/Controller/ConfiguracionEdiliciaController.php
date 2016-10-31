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
    * @Route("/agregarcama/{id_efector}/{nombre_habitacion}/{nombre_cama}/{id_clasificacion_cama}/{estado}/{rotativa}/{baja}")
    */
    public function agregarCamaAction(
            $id_efector,
            $nombre_habitacion,
            $nombre_cama,
            $id_clasificacion_cama,
            $estado,
            $rotativa,
            $baja){
        
        
        $nueva_cama = [
            'id_efector' => $id_efector,
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
                "a");
        
    }    
    
    
    
    /**
    * @Route("/modificarcama/{id_efector}/{nombre_habitacion}/{nombre_cama}/{id_clasificacion_cama}/{estado}/{rotativa}/{baja}")
    */
    public function modificarCamaAction(
            $id_efector,
            $nombre_habitacion,
            $nombre_cama,
            $id_clasificacion_cama,
            $estado,
            $rotativa,
            $baja){
        
        
        $modif_cama = [
            'id_efector' => $id_efector,
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
                "m");
        
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
                "e");
        
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
                "o");
        
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
                "l");
        
    }
    
    private function execConfiguracionEdilicia(
            $datos,
            $accion){
        
        
        // ConfiguracionEdilicia
        $ce=$this->get("configuracion_edilicia");
        
        try{
                    
            switch ($accion){

                case 'a':
                    
                    $msg = $ce->agregarCama($datos);
                    break;
                
                case 'm':

                    $msg = $ce->modificarCama($datos);
                    break;
                
                case 'e':

                    $msg = $ce->eliminarCama($datos);
                    break;
                
                case 'o':
                    
                    $msg = $ce->ocuparCama($datos);
                    break;
                
                case 'l':
                    
                    $msg = $ce->liberarCama($datos);
                    break;

            }
        
            return $this->render(
                'WSBundle:Default:msg.html.twig',
                array(
                    'datos' => $datos,
                    'msg' => $msg,
                    'error_debug' => $ce->error_debug)
                    );
            
        } catch (\Exception $e) {

            $msg = $e->getMessage();
            
            switch ($accion){

                case 'a':
                    
                    $titulo = "Error al agregar la cama";
                    break;
                
                case 'm':
                    
                    $titulo = "Error al modificar la cama";
                    break;

                case 'e':

                   $titulo = "Error al eliminar la cama";
                   break;
               
                case 'o':
                   
                   $titulo = "Error al ocupar la cama";
                   break;
               
                case 'l':
                    
                   $titulo = "Error al liberar la cama";
                   break;
               

            }
            
            // error al generar el censo
            return $this->render(
                    'Exception/error.html.twig',
                    array(
                        'titulo' => $titulo,
                        'msg' => $msg,
                        'debug' => $ce->error_debug)
                    );
        }
    }
}
