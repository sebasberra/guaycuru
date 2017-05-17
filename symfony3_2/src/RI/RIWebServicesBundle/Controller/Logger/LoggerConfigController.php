<?php

namespace RI\RIWebServicesBundle\Controller\Logger;    

use Symfony\Component\HttpFoundation\Request;

use RI\RIWebServicesBundle\Utils\RI\RI;


trait LoggerConfigController{
    

    /**
    * @Route("/config")
    */
    public function configAction(Request $request)
    {
        $data = array();
        
        try {

            $this->get('app.ri_utiles');
            
            
            // form
            $form = RI::$form_factory->create(
                    'RI\RIWebServicesBundle\Form\Logger\LoggerConfigType');
            

            $form->handleRequest($request);
            
            // check submit
            if ($form->isSubmitted() && 
                    $form->isValid()) {
                
                $param = $form->getData();
                
            }
                
                

        }catch(\Exception $e){
            
            $msg = 'Desconocido';
            
            RI::$error_debug .= 
                    "Funcion configAction: "
                    .$e->getMessage();
            
            return $this->renderException(
                    'Error al cargar logger config', 
                    $msg);

        }
    
        // render
        return $this->render(
                'RIWebServicesBundle:Logger:loggerconfig.html.twig',
                array(
                    'form' => $form->createView(),
                    'data' => $data)
                );
    }
    
}