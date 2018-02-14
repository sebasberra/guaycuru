<?php

namespace RI\RIWebServicesBundle\Utils\Render;


use RI\RIWebServicesBundle\Utils\RI\RI;


trait Render{
    
    
    public static $titulo_exception_cd = 
            "Problema al carga el formulario de Censo Diario";
    
    
    private function renderException($titulo,$msg){
        
        // render exception
        return $this->render(
                'Exception/error.html.twig',
                array(
                    'titulo' => $titulo,
                    'msg' => $msg,
                    'debug' => RI::$error_debug)
                );
    }

}