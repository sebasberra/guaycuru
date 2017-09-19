<?php

namespace RI\RIWebServicesBundle\Controller\Logger;    

use Symfony\Component\HttpFoundation\Request;


use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;


trait LoggerConsultaController{
    
    /**
    * @Route("/consulta")
    */
    public function consultaAction(Request $request)
    {
        
        $data = array();
        
        try {

            $this->get('app.ri_utiles');
            
            // tablas
            $consulta = 
                    "SELECT " 
                        ."DISTINCT ld.tabla "
                    ."FROM "
                        ."logs_datos ld ";

            $stmt_tablas = RI::$conn->prepare($consulta);
            
            // ejecuta consulta
            $stmt_tablas->execute();
            $tablas = $stmt_tablas->fetchAll();
            
            // user_db
            $consulta = 
                    "SELECT " 
                        ."DISTINCT lc.user_db "
                    ."FROM "
                        ."logs_conexiones lc ";

            $stmt_user_db = RI::$conn->prepare($consulta);
            
            // ejecuta consulta
            $stmt_user_db->execute();
            $user_db = $stmt_user_db->fetchAll();
            
            // columnas
            $consulta = 
                    "SELECT " 
                        ."DISTINCT lc.host_db "
                    ."FROM "
                        ."logs_conexiones lc ";

            $stmt_host_db = RI::$conn->prepare($consulta);
            
            // ejecuta consulta
            $stmt_host_db->execute();
            $host_db = $stmt_host_db->fetchAll();
            
            // form
            $form = RI::$form_factory->create(
                    'RI\RIWebServicesBundle\Form\Logger\LoggerConsultaType',
                    array(
                        $tablas,
                        $user_db,
                        $host_db));
            

            $form->handleRequest($request);
            
            // check submit
            if ($form->isSubmitted() && 
                    $form->isValid()) {

                
                
                $param = $form->getData();
//                dump($param);die();
                
                $loggers = RIUtiles::getLoggers(
                        $param['tablas'],
                        $param['user_db'],
                        $param['host_db'],
                        $param['descripcion'],
                        $param['fecha_desde'],
                        $param['fecha_hasta'],
                        $param['order_fecha']);
                
//                dump($loggers);die();
                foreach($loggers as $log){
                    
                    
                    $id_log_conexion = $log['id_log_conexion'];
                    $id_log_dato = $log['id_log_dato'];
                    $tipo_sql = $log['tipo_sql'];
                    
                    if ($tipo_sql!='N'){
                        $datos=array();
                    }
                    
                    // campos
                    $campos=explode('|;|',$log['campos']);
                    
                    // quita fin de linea y retorno de carro a valores
                    $log['valores'] = str_replace(["\r\n", "\r", "\n"], " ", $log['valores']);
                    
                    // valores
                    $valores= explode('|;|',$log['valores']);

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