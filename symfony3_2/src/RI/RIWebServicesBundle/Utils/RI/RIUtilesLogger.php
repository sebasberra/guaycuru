<?php

namespace RI\RIWebServicesBundle\Utils\RI;


trait RIUtilesLogger{
    
    public static function getLoggers(){
        
        $consulta = 
                "SELECT "
                    ."lc.id_log_conexion, "
                    ."lc.user_db, "
                    ."lc.host_db, "
                    ."lc.descripcion, "
                    ."lc.fecha_hora, "
                    ."ld.id_log_dato, "
                    ."ld.tabla, "
                    ."ld.campos, "
                    ."ld.valores, "
                    ."ld.tipo_sql "
                ."FROM "
                    ."logs_conexiones lc "
                ."INNER JOIN "
                    ."logs_datos ld "
                ."ON lc.id_log_conexion = ld.id_log_conexion ";

        $stmt = RI::$conn->prepare($consulta);

        // ejecuta consulta
        $stmt->execute();
        $loggers = $stmt->fetchAll();
        
        return $loggers;
    }
    
    public static function setLoggerDescripcion($descripcion){
        
        $consulta = 
                "SELECT "
                    ."logs_set_descripcion(:descripcion)";

        
        $stmt = RI::$conn->prepare($consulta);
        $stmt->bindValue("descripcion", $descripcion);
        
        // ejecuta consulta
        $stmt->execute();
        $loggers = $stmt->fetchAll();

        return $loggers;
    }
    
    public static function logsDebugManual(
            $descripcion,
            $info){
    
        // columnas
        $consulta = 
                "CALL " 
                    ."logs_debug_manual( "
                    .":descripcion, "
                    .":info,"
                    ."@estado, "
                    ."@msg) ";
        
        try{
                
            $stmt = RI::$conn->prepare($consulta);

            $stmt->bindValue("descripcion", $descripcion);
            $debug='';
            if (RI::$error_debug != ''){
                $debug=' DEBUG: '.RI::$error_debug;
            }
            $stmt->bindValue("info", $info.' '.$debug);
        
            $stmt->execute();
            
            $result = self::getEstadoMsg();
             
        } catch (\Exception $e) {

            RI::$error_debug.=' logsDebugManual: '.$e->getMessage();
            
            if (isset($result)){
                RI::$error_debug.=' @msg='.$result['msg'];
            }
            
            throw $e;
            
        }
        
        return $result['estado'];
    }
    
}