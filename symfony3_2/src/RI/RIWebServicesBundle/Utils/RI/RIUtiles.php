<?php

namespace RI\RIWebServicesBundle\Utils\RI;

use RI\RIWebServicesBundle\Utils\RI\RIUtilesOptions;

/** Funciones utiles de la configuracion edilicia
 * 
 */
class RIUtiles extends RI
{

    use RIUtilesOptions;
    
    
    const DB_BUNDLE = 'DBHmi2GuaycuruCamasBundle';
    
    public static function getEfector(
            $id_efector,
            $con_asociaciones=false){
        
        
        // efector
        try {
        
            if ($con_asociaciones){
                $efector = 
                    self::$doctrine->getRepository
                        (self::DB_BUNDLE.':Efectores')
                        ->findOneByIdEfectorConAsociaciones($id_efector);

            }else{
               
                $efector = 
                    self::$doctrine->getRepository
                        (self::DB_BUNDLE.':Efectores')
                        ->findOneByIdEfector($id_efector);
                                
            }
        
        } catch (\Doctrine\ORM\NoResultException $nre){
            
            $msg = "El efector no existe en la base de datos";
            
            $msg_debug = "El id de efector: "
                    .$id_efector
                    ." no existe en la base de datos";
            
            self::$error_debug .= " Función getEfector: "
                    .$msg_debug
                    ." || exception.getMessage: "
                    .$nre->getMessage();
            
            throw new \Exception($msg);
            
        
        } catch (\Doctrine\ORM\NonUniqueResultException $nure){
            
            
            $msg =
                    "Existe más de una efector con el "
                    ."identificador especificado";
            
            $msg_debug = "Existe más de una efector con el id: "
                    .$id_efector;
            
            self::$error_debug .= " Función getEfector: "
                    .$msg_debug
                    ." || exception.getMessage: "
                    .$nure->getMessage();
            
            
            throw new \Exception($msg);
            
        } catch (\Exception $e) {

            $msg = 'Error al buscar el efector';
            
            $msg_debug = 'Error al buscar el efector con id: '
                    .$id_efector;
            
            self::$error_debug .= " Función getEfector: "
                    .$msg_debug
                    ." || exception.getMessage: "
                    .$e->getMessage();
            
            throw new \Exception($msg);
            
        }
        
        
        // check efector encontrado o lanza excepcion
        if (!$efector){
        
            $msg = "El efector no existe en la base de datos";
            
            $msg_debug = "El id de efector: "
                    .$id_efector
                    ." no existe en la base de datos";
            
            self::$error_debug .= " Función getEfector"
                    .$msg_debug;
                    
            throw new \Doctrine\ORM\NoResultException($msg);
            
        }
        
        return $efector;
        
    }
    
    
    public static function getSala(
            $id_sala,
            $con_asociaciones=false){
        
        
        // sala
        try {
        
            if ($con_asociaciones){
            
                $sala = 
                    self::$doctrine->getRepository
                        (self::DB_BUNDLE.':Salas')
                        ->findOneByIdSalaConAsociaciones($id_sala);

            }else{
               
                $sala = 
                    self::$doctrine->getRepository
                        (self::DB_BUNDLE.':Salas')
                        ->findOneByIdSala($id_sala);
            }
        
        } catch (\Doctrine\ORM\NoResultException $nre){
            
            $msg = "La sala no existe en la base de datos";
            
            $msg_debug = "El id de sala: "
                    .$id_sala
                    ." no existe en la base de datos";
            
            self::$error_debug .= " Función getSala: "
                    .$msg_debug
                    ." || exception.getMessage: "
                    .$nre->getMessage();
            
            throw new \Exception($msg);
            
        
        } catch (\Doctrine\ORM\NonUniqueResultException $nure){
            
            
            $msg =
                    "Existe más de una sala con el identificador especificado";
            
            $msg_debug =
                    "Existe más de una sala con el id: "
                    .$id_sala
                    ." especificado";
            
            self::$error_debug .= "<p>Función getSala: "
                    .$msg_debug
                    ." || exception.getMessage: "
                    .$nure->getMessage()
                    ."</p>";
            
            
            
            throw new \Exception($msg);
            
        } catch (\Exception $e) {

            $msg = 'Error al buscar la sala';
            
            $msg_debug = 'Error al buscar la sala con id: '
                    .$id_sala;
            
            self::$error_debug .= "<p>Función getSala: "
                    .$msg_debug
                    ." || exception.getMessage: "
                    .$e->getMessage()
                    ."</p>";
            
            throw new \Exception($msg);
            
        }
        
        // check sala encontrada o lanza excepcion
        if (!$sala){
        
            $msg = "La sala no existe en la base de datos";
            
            $msg_debug = "El id de sala: "
                    .$id_sala
                    ." no existe en la base de datos";
            
            self::$error_debug .= "Función getSala"
                    .$msg_debug;
                    
            throw new \Exception($msg);
            
        }
        
        return $sala;
        
    }
    
    public static function getSalaPorNombre(
            $nombre_sala,
            $id_efector){
        
        
        // sala
        try {
        
            $sala = 
                self::$doctrine->getRepository
                    (self::DB_BUNDLE.':Salas')
                    ->findOneByNombreIdEfector(
                            $nombre_sala,
                            $id_efector);
            
        
        } catch (\Doctrine\ORM\NoResultException $nre){
            
            $msg = "La sala no existe en la base de datos";
            
            $msg_debug = "El nombre de sala: "
                    .$nombre_sala
                    ." en el efector "
                    .$id_efector
                    ." no existe en la base de datos";
            
            self::$error_debug .= " Función getSalaPorNombre: "
                    .$msg_debug
                    ." || exception.getMessage: "
                    .$nre->getMessage();
            
            throw new \Exception($msg);
            
        
        } catch (\Doctrine\ORM\NonUniqueResultException $nure){
            
            
            $msg =
                    "Existe más de una sala con el nombre y efector especificados";
            
            $msg_debug =
                    "Existe más de una sala con el nombre: "
                    .$nombre_sala
                    ." en el efector "
                    .$id_efector
                    ." especificados";
            
            self::$error_debug .= "<p>Función getSalaPorNombre: "
                    .$msg_debug
                    ." || exception.getMessage: "
                    .$nure->getMessage()
                    ."</p>";
            
            
            
            throw new \Exception($msg);
            
        } catch (\Exception $e) {

            $msg = 'Error al buscar la sala';
            
            $msg_debug = 'Error al buscar la sala con nombre: '
                    .$nombre_sala
                    ." en el efector "
                    .$id_efector;
            
            self::$error_debug .= "<p>Función getSalaPorNombre: "
                    .$msg_debug
                    ." || exception.getMessage: "
                    .$e->getMessage()
                    ."</p>";
            
            throw new \Exception($msg);
            
        }
        
        // check sala encontrada o lanza excepcion
        if (!$sala){
        
            $msg = "La sala no existe en la base de datos";
            
            $msg_debug = "El nombre de sala: "
                    .$nombre_sala
                    ." en el efector "
                    .$id_efector
                    ." no existe en la base de datos";
            
            self::$error_debug .= "Función getSalaPorNombre"
                    .$msg_debug;
                    
            throw new \Exception($msg);
            
        }
        
        return $sala;
        
    }
    
    public static function getEfectorServicio(
            $id_efector_servicio,
            $con_asociaciones=false){
        
        
        // efector servicio
        try {
        
            if ($con_asociaciones){
            
                $efector_servicio = 
                    self::$doctrine->getRepository
                        (self::DB_BUNDLE.':EfectoresServicios')
                        ->findOneByIdEfectorServicioConAsociaciones($id_efector_servicio);

            }else{
               
                $efector_servicio = 
                    self::$doctrine->getRepository
                        (self::DB_BUNDLE.':EfectoresServicios')
                        ->findOneByIdEfectorServicio($id_efector_servicio);
            }
        
        } catch (\Doctrine\ORM\NoResultException $nre){
            
            $msg = "El servicio no existe en el efector";
            
            $msg_debug = "El id de efector servicio: "
                    .$id_efector_servicio
                    ." no existe en la base de datos";
            
            self::$error_debug .= " Función getEfectorServicio: "
                    .$msg_debug
                    ." || exception.getMessage: "
                    .$nre->getMessage();
            
            throw new \Exception($msg);
            
        
        } catch (\Doctrine\ORM\NonUniqueResultException $nure){
            
            
            $msg =
                    "Existe más de un servicio con el identificador especificado";
            
            $msg_debug =
                    "Existe más de un servicio con el id: "
                    .$id_efector_servicio
                    ." especificado";
            
            self::$error_debug .= "<p>Función getEfectorServicio: "
                    .$msg_debug
                    ." || exception.getMessage: "
                    .$nure->getMessage()
                    ."</p>";
            
            
            
            throw new \Exception($msg);
            
        } catch (\Exception $e) {

            $msg = 'Error al buscar servicio en el efector';
            
            $msg_debug = 'Error al buscar el efector_servicio con id: '
                    .$id_efector_servicio;
            
            self::$error_debug .= "<p>Función getEfectorServicio: "
                    .$msg_debug
                    ." || exception.getMessage: "
                    .$e->getMessage()
                    ."</p>";
            
            throw new \Exception($msg);
            
        }
        
        // check efector servicio encontrada o lanza excepcion
        if (!$efector_servicio){
        
            $msg = "El servicio no existe en el efector";
            
            $msg_debug = "El id efector servicio: "
                    .$id_efector_servicio
                    ." no existe en la base de datos";
            
            self::$error_debug .= "Función getEfectorServicio"
                    .$msg_debug;
                    
            throw new \Exception($msg);
            
        }
        
        return $efector_servicio;
        
    }
    
    
    
    public static function getEfectorServicioCodigoEstadistica(
            $id_efector,
            $cod_servicio,
            $sector,
            $subsector){
        
        
        // efector servicio
        try {
        
            $efector_servicio = 
                self::$doctrine->getRepository
                    (self::DB_BUNDLE.':EfectoresServicios')
                    ->findOneByCodigoServicio(
                            $id_efector,
                            $cod_servicio,
                            $sector,
                            $subsector);
            
        
        } catch (\Doctrine\ORM\NoResultException $nre){
            
            $msg = "El servicio no existe en el efector";
            
            $msg_debug = "El id de efector servicio con "
                    ."id_efector = "
                    .$id_efector.", "
                    ."cod_servicio = "
                    .$cod_servicio.", "
                    ."sector = "
                    .$sector.", "
                    ."subsector = "
                    .$subsector
                    ." no existe en la base de datos";
            
            self::$error_debug .= " Función getEfectorServicioCodigoEstadistica: "
                    .$msg_debug
                    ." || exception.getMessage: "
                    .$nre->getMessage();
            
            throw new \Exception($msg);
            
        
        } catch (\Doctrine\ORM\NonUniqueResultException $nure){
            
            
            $msg =
                    "Existe más de un servicio con el identificador especificado";
            
            $msg_debug =
                    "Existe más de un servicio con: "
                    ."id_efector = "
                    .$id_efector.", "
                    ."cod_servicio = "
                    .$cod_servicio.", "
                    ."sector = "
                    .$sector.", "
                    ."subsector = "
                    .$subsector
                    ." especificados";
            
            self::$error_debug .= "<p>Función getEfectorServicioCodigoEstadistica: "
                    .$msg_debug
                    ." || exception.getMessage: "
                    .$nure->getMessage()
                    ."</p>";
            
            
            
            throw new \Exception($msg);
            
        } catch (\Exception $e) {

            $msg = 'Error al buscar servicio en el efector';
            
            $msg_debug = 'Error al buscar el efector_servicio con: '
                    ."id_efector = "
                    .$id_efector.", "
                    ."cod_servicio = "
                    .$cod_servicio.", "
                    ."sector = "
                    .$sector.", "
                    ."subsector = "
                    .$subsector;
            
            self::$error_debug .= "<p>Función getEfectorServicioCodigoEstadistica: "
                    .$msg_debug
                    ." || exception.getMessage: "
                    .$e->getMessage()
                    ."</p>";
            
            throw new \Exception($msg);
            
        }
        
        // check efector servicio encontrada o lanza excepcion
        if (!$efector_servicio){
        
            $msg = "El servicio no existe en el efector";
            
            $msg_debug = "El id efector servicio con: "
                    ."id_efector = "
                    .$id_efector.", "
                    ."cod_servicio = "
                    .$cod_servicio.", "
                    ."sector = "
                    .$sector.", "
                    ."subsector = "
                    .$subsector
                    ." no existe en la base de datos";
            
            self::$error_debug .= "Función getEfectorServicioCodigoEstadistica"
                    .$msg_debug;
                    
            throw new \Exception($msg);
            
        }
        
        return $efector_servicio;
        
    }
    
    
    public static function getEstadoMsg(){
        
        
        // estado/mensaje 
        $sql=
            "SELECT "
                ."@estado AS 'estado', "
                ."@msg AS 'msg'";
        
        // prepara la consulta
        $stmt_estado = self::$conn->prepare($sql);
        
        
        try {
        
            // ejecuta la consulta
            $stmt_estado->execute();
            $result = $stmt_estado->fetchAll();
            
        } catch (\Exception $e) {
            
            $msg = 
                    "Error al recuperar información del estado "
                    ."luego de la operación realizada";
                    
            self::$error_debug = 
                    "Función getEstadoMsg: "
                    .$e->getMessage()
                    ." SQL: "
                    .$sql;
            
            throw new \Exception($msg);
        }
        
        
        self::$error_debug .= $result[0]['msg'];
        
        return $result[0];
        
    }
    
    /** busca el id_habitacion segun el nombre de habitacion y id_efector
     *  pasado por parametro. si no encuentra registro de habitacion 
     *  devuelve NULL en $id_habitacion. No se puede definir si existe mas 
     *  de una habitacion con el mismo nombre en el efector y tambien
     *  devuelve NULL en tal caso
     * 
     * @param type $nombre_habitacion
     * @param type $id_efector
     * @param type $id_habitacion
     * @param type $msg
     * @return boolean
     */
    public static function getHabitacion(
            $nombre_habitacion, 
            $nombre_sala, 
            $id_efector) {


        // id_habitacion
        //
        // busca el id_habitacion segun el nombre pasado por parametro
        // si no encuentra registro de habitacion coloca NULL
        // No se puede definir si existe mas de una habitacion con el mismo nombre
        // en el efector
        // busca nombre-id_efector en tabla camas
        try {

            $msg = "Error al buscar la habitación: "
                    . $nombre_habitacion
                    . ", en la sala: "
                    . $nombre_sala
                    . ", del efector con id: "
                    . $id_efector
                    . ". ";

            $habitacion = self::$doctrine->getRepository
                            (self::DB_BUNDLE.':Habitaciones')
                    ->findOneByNombreSalaIdEfector(
                    $id_efector, $nombre_sala, $nombre_habitacion);
        } catch (\Doctrine\ORM\NonUniqueResultException $nure) {

            // mas de una habitacion encontrada, no se puede determinar
            // cual es
            self::$error_debug .= " Función getHabitacion: "
                    . $nure->getMessage();

            $msg .= "Existe más de una habitación con el nombre especificado";

            throw new \Exception($msg);
        } catch (\Doctrine\ORM\NoResultException $nre) {

            // no existe habitacion
            self::$error_debug .= " Función getHabitacion: "
                    . $nre->getMessage();

            $msg .= "No existe una habitación con el nombre especificado";
            //dump($msg);die();
            throw new \Exception($msg);
        } catch (\Exception $e) {


            self::$error_debug .= " Función getHabitacion: "
                    . $e->getMessage();

            throw new \ErrorException($msg);
        }


        // unica habitacion con el nombre pasado por parametro en el efector    

        return $habitacion;
    }

    public static function getClasificacionCama($id_clasificacion_cama) {


        try {

            // clasificacion cama
            $clasificacion_cama = self::$doctrine->getRepository
                            (self::DB_BUNDLE.':ClasificacionesCamas')
                    ->findOneByIdClasificacionCama($id_clasificacion_cama);
        } catch (\Exception $e) {

            $msg = 'Error al buscar la clasificación de cama con id: '
                    . $id_clasificacion_cama;

            self::$error_debug .= " Función getClasificacionCama: "
                    . $e->getMessage();

            throw new \ErrorException($msg);
        }

        // check clasificacion cama encontrada
        if (!$clasificacion_cama) {

            $msg = "El id de clasificación de cama: "
                    . $id_clasificacion_cama
                    . " no existe en la base de datos";

            self::$error_debug .= " Función getClasificacionCama: "
                    . $msg;

            throw new \Exception($msg);
        }

        return $clasificacion_cama;
    }
    
    public static function getCama(
            $nombre, 
            $id_efector) {

        // cama
        try {
            $cama = self::$doctrine->getRepository
                            (self::DB_BUNDLE.':Camas')
                    ->findOneByNombreIdEfector(
                    $nombre, $id_efector);
        } catch (\Doctrine\ORM\NoResultException $nre) {

            $msg = "La cama: "
                    . $nombre
                    . " no existe en el efector: "
                    . $id_efector;

            self::$error_debug .= " Función getCama: "
                    . $nre->getMessage();

            throw new \Exception($msg);
        } catch (\Exception $e) {

            $msg = "Error al buscar la cama: "
                    . $nombre
                    . " en el efector con id: "
                    . $id_efector;

            self::$error_debug .= " Función cama: "
                    . $e->getMessage();

            throw new \Exception($msg);
        }

        return $cama;
    }

    
    public static function wrapBoolean($strbooleano) {

        if ($strbooleano == 'false') {

            return false;
        }
        if ($strbooleano == 'true') {

            return true;
        }

        return (boolean) $strbooleano;
    }
    
    
    /** formula que genera el token
     * 
     * @param type $usuario
     * @param type $id_efector
     * @return type
     */
    public static function encriptarToken($usuario,$id_efector){
        
        
        $fecha1 = date('Ymd');
        $fecha2 = date('dmY');
        
        $token = md5($fecha1.$usuario.$id_efector.$fecha2);
        
        return $token;
    }
    
    
    
    public static function validacionAssert($entidad){
        
        //
        // validator assert
        //
        $errors = RI::$validator->validate($entidad);
    
        if (count($errors) > 0) {
            /*
             * Uses a __toString method on the $errors variable which is a
             * ConstraintViolationList object. This gives us a nice string
             * for debugging.
             */
            RI::$error_debug .= (string) $errors;

            // concatena los errores
            $msg="(1) ".$errors[0]->getMessage();
            for ($i=1;$i<count($errors);$i++){
                
                //$msg.=" (".($i+1).") ".$errors[$i]->getMessage();
                $msg.="<p> (".($i+1).") ".$errors[$i]->getMessage()."</p>";
                
            }
            
            throw new \Exception($msg);
        }
        
    }
    
}