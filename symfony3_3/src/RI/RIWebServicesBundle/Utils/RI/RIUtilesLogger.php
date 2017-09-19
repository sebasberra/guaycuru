<?php

namespace RI\RIWebServicesBundle\Utils\RI;


trait RIUtilesLogger{
    
    public static function getLoggers(
            $tablas,
            $user_db,
            $host_db,
            $descripcion,
            $fecha_desde,
            $fecha_hasta,
            $order_fecha){
        
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
                ."ON lc.id_log_conexion = ld.id_log_conexion "
                ."WHERE 1 ";
        
        // tablas
        if ($tablas!=null){
            $consulta.="AND ld.tabla = :tabla ";
        }
        
        // user db
        if ($user_db!=null){
            $consulta.="AND lc.user_db = :user_db ";
        }
        
        // host db
        if ($host_db!=null){
            $consulta.="AND lc.host_db = :host_db ";
        }
        
        // descripcion
        if ($descripcion!=null){
            $consulta.="AND lc.descripcion LIKE :descripcion ";
        }
        
        // fecha desde
        if ($fecha_desde!=''){
            $consulta.="AND DATE(lc.fecha_hora) >= :fecha_desde ";
        }
        
        // fecha hasta
        if ($fecha_hasta!=''){
            $consulta.="AND DATE(lc.fecha_hora) <= :fecha_hasta ";
        }

        // order
        $consulta.="ORDER BY "
                ."lc.fecha_hora ".$order_fecha;
        
        $stmt = RI::$conn->prepare($consulta);

        if ($tablas!=null){
            $stmt->bindValue("tabla", $tablas);
        }
        
        if ($user_db!=null){
            $stmt->bindValue("user_db", $user_db);
        }
        
        if ($host_db!=null){
            $stmt->bindValue("host_db", $host_db);
        }
        
        if ($descripcion!=''){
            $stmt->bindValue("descripcion", '%'.$descripcion.'%');
        }
        
        if ($fecha_desde!=''){
            $stmt->bindValue("fecha_desde", $fecha_desde);
        }
        
        if ($fecha_hasta!=''){
            $stmt->bindValue("fecha_hasta", $fecha_hasta);
        }
        
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

            
            if (RI::$error_debug==''){
                $debug='';
            }else{
                $debug=' DEBUG:'.RI::$error_debug;
            }
            $stmt->bindValue("info", $info.' '.$debug);
            $stmt->bindValue("descripcion", $descripcion);
        
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