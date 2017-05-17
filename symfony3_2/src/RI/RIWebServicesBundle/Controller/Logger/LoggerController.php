<?php

namespace RI\RIWebServicesBundle\Controller\Logger;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;

use RI\RIWebServicesBundle\Utils\Render\Render;


class LoggerController extends Controller
{
    
    use Render,
        LoggerTriggersController,
        LoggerConfigController;
    
        
    /**
    * @Route("/consulta")
    */
    public function consultaAction(Request $request)
    {
        
        $data = array();
        
        try {

            $this->get('app.ri_utiles');
            
            
            // form
            $form = RI::$form_factory->create(
                    'RI\RIWebServicesBundle\Form\Logger\LoggerConsultaType');
            

            $form->handleRequest($request);
            
            // check submit
            if ($form->isSubmitted() && 
                    $form->isValid()) {

                
                
                $param = $form->getData();
                
                $loggers = RIUtiles::getLoggers();
                
                foreach($loggers as $log){
                    
                    
                    $id_log_conexion = $log['id_log_conexion'];
                    $id_log_dato = $log['id_log_dato'];
                    $tipo_sql = $log['tipo_sql'];
                    if ($tipo_sql!='N'){
                        $datos=array();
                    }
                    $campos=split(';',$log['campos']);
                    $valores=split(';',$log['valores']);
                    $i=0;
                    foreach($campos as $campo){
                        
                        if ($tipo_sql=='N'){
                            
                            if (substr($datos[$campo],3)!=$valores[$i]){
                                
                                $datos[$campo]='[M]Anterior: '
                                        .substr($datos[$campo],3)
                                        .' Nuevo: '
                                        .$valores[$i];
                            }
                            
                        }else{
                            
                            $flag='[ ]';
                            switch ($tipo_sql){
                                
                                case 'I':
                                    $flag='[I]';
                                    break;
                                case 'O':
                                    $flag='[O]';
                                    break;
                                case 'L':
                                    $flag='[L]';
                                    break;
                                case 'D':
                                    $flag='[D]';
                                    break;
                            }
                            $datos[$campo]=$flag.$valores[$i];
                        }
                        
                        $i++;
                    }
                    
                    if ($tipo_sql=='O'){ continue;}
                    
                    if (!array_key_exists($id_log_conexion,$data)){
                        
                        $data[$id_log_conexion] = array(
                            'id_log_conexion'=>$log['id_log_conexion'],
                            'user_db'=>$log['user_db'],
                            'host_db'=>$log['host_db'],
                            'descripcion'=>$log['descripcion'],
                            'fecha_hora'=>$log['fecha_hora'],
                            'info' => array());
                    }
                    
                    
                    
                    switch ($tipo_sql){
                        
                        case 'I':
                            
                            $tipo_sql = 'INSERT';
                            
                            break;
                        
                        case 'O':
                            
                            $tipo_sql = 'UPDATE';
                            
                            break;
                        
                        case 'N':
                            
                            $tipo_sql = 'UPDATE';
                            
                            break;
                        
                        case 'D':
                            
                            $tipo_sql = 'DELETE';
                            
                            break;
                        
                        case 'L':
                            
                            $tipo_sql = 'LOG';
                            
                            break;
                    }
                    
                    $data[$id_log_conexion]['info'][$id_log_dato]=
                            array(
                                'tipo_sql' => $tipo_sql,
                                'tabla' => $log['tabla'],
                                'datos' => $datos);
                    
                }
                
//                dump($data);die();
                        
            }

        }catch(\Exception $e){
            
            $msg = 'Desconocido';
            
            RI::$error_debug .= 
                    "Funcion consultaAction: "
                    .$e->getMessage();
            
            return $this->renderException(
                    'Error al cargar la consulta de logger', 
                    $msg);

        }
    
        // render
        return $this->render(
                'RIWebServicesBundle:Logger:loggerconsulta.html.twig',
                array(
                    'form' => $form->createView(),
                    'data' => $data)
                );
                
    }
    
    
    
    

}