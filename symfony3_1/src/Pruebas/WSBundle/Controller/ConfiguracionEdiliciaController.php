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
    * @Route("/agregarcama/{id_efector}/{nombre_habitacion}/{nombre_cama}/{id_clasificacion_cama}")
    */
    public function agregarcamaAction(
            $id_efector,
            $nombre_habitacion,
            $nombre_cama,
            $id_clasificacion_cama){
        
        $msg="";
        
        $nueva_cama = [
            'id_efector' => $id_efector,
            'nombre_habitacion' => $nombre_habitacion,
            'nombre_cama' => $nombre_cama,
            'id_clasificacion_cama' => $id_clasificacion_cama
        ];
        
        // ConfiguracionEdilicia
        $ce=$this->get("configuracion_edilicia");
        try{
            
            $ce->agregarCama($nueva_cama,$msg);
            
        } catch (\Exception $e) {

            $msg = $e->getMessage();
        }
        
        
        return $this->render(
                'WSBundle:Default:msg.html.twig',
                array(
                    'nueva_cama' => $nueva_cama,
                    'msg' => $msg,
                    'error_debug' => $ce->error_debug)
                    );
        
    }
    
}
