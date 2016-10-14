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
        
        return $this->render(
                'WSBundle:Default:msg.html.twig',
                array(
                    'nueva_cama' => $nueva_cama,
                    'msg' => $msg)
                    );
        
    }
    
}
