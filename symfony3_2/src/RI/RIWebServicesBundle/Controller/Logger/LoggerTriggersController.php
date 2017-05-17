<?php

namespace RI\RIWebServicesBundle\Controller\Logger;    

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use RI\RIWebServicesBundle\Utils\RI\RI;


trait LoggerTriggersController{
    

    /**
    * @Route("/triggers")
    */
    public function triggersAction(Request $request)
    {
        
        $data = array();
        
        try {

            $this->get('app.ri_utiles');
            
            
            // form
            $form = RI::$form_factory->create(
                    'RI\RIWebServicesBundle\Form\Logger\LoggerTriggersType');
            

            $form->handleRequest($request);
            
            // check submit
            if ($form->isSubmitted() && 
                    $form->isValid()) {
                
                $param = $form->getData();
                
            }
                
                

        }catch(\Exception $e){
            
            $msg = 'Desconocido';
            
            RI::$error_debug .= 
                    "Funcion triggersAction: "
                    .$e->getMessage();
            
            return $this->renderException(
                    'Error al cargar logger triggers', 
                    $msg);

        }
    
        // render
        return $this->render(
                'RIWebServicesBundle:Logger:loggertriggers.html.twig',
                array(
                    'form' => $form->createView(),
                    'data' => $data)
                );
    }
    
    
    /**
    * @Route("/triggers/{tabla}",name="logger_triggers")
    */
    public function triggersTablaAction($tabla)
    {
        
        $this->get('app.ri_utiles');
        
        // columnas
        $consulta = 
                "SELECT " 
                    ."c.COLUMN_NAME, "
                    ."c.IS_NULLABLE "
                ."FROM "
                    ."INFORMATION_SCHEMA.COLUMNS c "
                ."WHERE "
                    ."c.TABLE_SCHEMA = :table_schema "
                ."AND c.TABLE_NAME = :table_name";
        
        $stmt = RI::$conn->prepare($consulta);
            
        $stmt->bindValue("table_schema", $this->getParameter('database_name'));
        $stmt->bindValue("table_name", $tabla);
        
        try {
        
            // ejecuta consulta
            $stmt->execute();
            $columnas = $stmt->fetchAll();
                        
        } catch (\Exception $e) {

            $msg = "Error al consultar las columnas de la tabla ".$tabla;
                    
            RI::$error_debug = "<p>".$e->getMessage()."</p>";

            return $this->renderException(
                    'Error al cargar la consulta de logger', 
                    $msg);
            
        }
                
        
        $template='RIWebServicesBundle:Logger:loggertriggerstabla.html.twig';
        $parameters=array(
                    'tabla' => $tabla,
                    'columnas' => $columnas
                );
        $content = $this->get('templating')->render($template, $parameters);
        $textResponse = new Response($content , 200);
        $textResponse->headers->set('Content-Type', 'text/plain');
        return $textResponse;
        
        
    }

}