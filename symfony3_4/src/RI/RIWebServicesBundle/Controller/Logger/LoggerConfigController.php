<?php

namespace RI\RIWebServicesBundle\Controller\Logger;    

use Symfony\Component\HttpFoundation\Request;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;


trait LoggerConfigController{
    

    /**
    * @Route("/config")
    */
    public function configAction(Request $request)
    {
        
        $mensaje = '';
        
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
                
                if ($form->get('guardar')->isClicked()) {
                    
                    if ($param['estado']){
                        $estado = '1';
                    } else {
                        $estado = '0';
                    }
                    
                    if ($param['guardar_modificaciones_nulas']){
                        $guardar_modificaciones_nulas = '1';
                    } else {
                        $guardar_modificaciones_nulas = '0';
                    }
                    
                    
                    $sql_delete =
                            "DELETE "
                            ."FROM "
                                ."logs_auditados ";
                    
                    $sql_insert =
                            "INSERT INTO "
                                ."logs_auditados "
                            ."VALUES("
                            
                                // id_log_auditado
                                ."0,"
                            
                                // descripcion
                                ."'".$param['descripcion']."', "
                            
                                // estado
                                .$estado.", "
                            
                                // guardar_modificaciones_nulas
                                .$guardar_modificaciones_nulas
                            
                                .")";
                    

                    try{

                        RI::$conn->beginTransaction();
                        
                        RIUtiles::setLoggerDescripcion
                                ("Modificación del estado logs_auditados");
                        
                        $stmt_delete = RI::$conn->prepare($sql_delete);
                        $stmt_insert = RI::$conn->prepare($sql_insert);

                        // ejecuta consulta
                        $stmt_delete->execute();
                        $stmt_insert->execute();
                        
                        RI::$conn->commit();

                    } catch (\Exception $e) {
                        
                        RI::$conn->rollBack();
                        
                        RIUtiles::logsDebugManual(
                                'Error al modificar el estado de logs_auditado', 
                                $e->getMessage());

                        throw $e;

                    }
                    
                    $mensaje = 'Se modificó el estado de logs_auditados';
                    
                }
                
                if ($form->get('vaciar')->isClicked()) {
                    
                    $sql_delete_logs_datos =
                            "DELETE "
                            ."FROM "
                                ."logs_datos ";
                    
                    $sql_delete_logs_conexiones =
                            "DELETE "
                            ."FROM "
                                ."logs_conexiones ";
                    

                    try{

                        RI::$conn->beginTransaction();
                        
                        RIUtiles::setLoggerDescripcion
                                ("Vaciar Logger");
                        
                        $stmt_delete_logs_datos = 
                                RI::$conn->prepare($sql_delete_logs_datos);
                        
                        $stmt_delete_logs_conexiones = 
                                RI::$conn->prepare($sql_delete_logs_conexiones);

                        // ejecuta consulta
                        $stmt_delete_logs_datos->execute();
                        $stmt_delete_logs_conexiones->execute();
                        
                        RI::$conn->commit();

                    } catch (\Exception $e) {
                        
                        RI::$conn->rollBack();
                        
                        RIUtiles::logsDebugManual(
                                'Error al vaciar el logger', 
                                $e->getMessage());

                        throw $e;

                    }
                    
                    $mensaje = 'Se vació el logger';
                    
                }
                
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
                    'mensaje' => $mensaje)
                );
    }
    
}