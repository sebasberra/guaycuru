<?php

namespace RI\RIWebServicesBundle\Utils\RI;

use Doctrine\ORM\NoResultException;
use Doctrine\ORM\NonUniqueResultException;

use RI\DBHmi2GuaycuruCamasBundle\Exception\NoResultExceptionCodigoServicio;
use RI\DBHmi2GuaycuruCamasBundle\Exception\NoResultExceptionCama;
use RI\DBHmi2GuaycuruCamasBundle\Exception\NoResultExceptionHabitacion;
use RI\DBHmi2GuaycuruCamasBundle\Exception\NoResultExceptionSala;


/** Funciones utiles de la configuracion edilicia
 * 
 */
class RIUtiles extends RI
{

    use RIUtilesOptions,
        RIUtilesLogger,
        RIUtilesREST;
    
    
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
        
        } catch (NoResultException $nre){
            
            $msg_debug = "El id de efector: "
                    .$id_efector
                    ." no existe en la base de datos";
            
            self::$error_debug .= " Función getEfector: "
                    .$msg_debug
                    ." || exception.getMessage: "
                    .$nre->getMessage();
            
            throw new NoResultException($msg);
            
        
        } catch (NonUniqueResultException $nure){
            
            $msg_debug = "Existe más de una efector con el id: "
                    .$id_efector;
            
            self::$error_debug .= " Función getEfector: "
                    .$msg_debug
                    ." || exception.getMessage: "
                    .$nure->getMessage();
            
            throw $nure;
            
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
        
            $msg_debug = "El id de efector: "
                    .$id_efector
                    ." no existe en la base de datos";
            
            self::$error_debug .= " Función getEfector"
                    .$msg_debug;
                    
            throw new NoResultException();
            
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
        
        } catch (NoResultExceptionSala $nres){
            
            throw $nres;
            
        } catch (NonUniqueResultException $nure){
            
            $msg_debug =
                    "Existe más de una sala con el id: "
                    .$id_sala
                    ." especificado";
            
            self::$error_debug .= "<p>Función getSala: "
                    .$msg_debug
                    ." || exception.getMessage: "
                    .$nure->getMessage()
                    ."</p>";
                        
            throw $nure;
            
            
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
        
            $msg_debug = "El id de sala: "
                    .$id_sala
                    ." no existe en la base de datos";
            
            self::$error_debug .= "Función getSala"
                    .$msg_debug;
                    
            throw new NoResultException();
            
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
            
        
        } catch (NoResultExceptionSala $nres){
            
            throw $nres;
            
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
        
            throw new NoResultExceptionSala($id_efector,$nombre_sala);
            
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
        
        } catch (NoResultException $nre){
            
            $msg_debug = "El id de efector servicio: "
                    .$id_efector_servicio
                    ." no existe en la base de datos";
            
            self::$error_debug .= " Función getEfectorServicio: "
                    .$msg_debug
                    ." || exception.getMessage: "
                    .$nre->getMessage();
            
            throw $nre;
            
        
        } catch (NonUniqueResultException $nure){
            
            $msg_debug =
                    "Existe más de un servicio con el id: "
                    .$id_efector_servicio
                    ." especificado";
            
            self::$error_debug .= "<p>Función getEfectorServicio: "
                    .$msg_debug
                    ." || exception.getMessage: "
                    .$nure->getMessage()
                    ."</p>";
            
            throw $nure;
            
            
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
        
            $msg_debug = "El id efector servicio: "
                    .$id_efector_servicio
                    ." no existe en la base de datos";
            
            self::$error_debug .= "Función getEfectorServicio"
                    .$msg_debug;
                    
            throw new NoResultException();
            
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
                    ->findOneByCodigoEstadistica(
                            $id_efector,
                            $cod_servicio,
                            $sector,
                            $subsector);
            
        
        } catch (NoResultExceptionCodigoServicio $nrecs){
            
            self::$error_debug .= " Función getEfectorServicioCodigoEstadistica: "
                    ." || exception.getMessage: "
                    .$nrecs->getMessage();
            
            throw $nrecs;
            
        
        } catch (NonUniqueResultException $nure){
            
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
            
            throw $nure;
            
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
                    
            throw NoResultException;
            
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
     * @param string $nombre_habitacion Nombre único de habitación en la sala
     * @param string $nombre_sala Nombre único de sala en el efector
     * @param integer $id_efector ID efector
     * @return Habitaciones
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
            
        } catch (NoResultExceptionSala $nres) {

            // no existe sala
            self::$error_debug .= " Función getHabitacion: "
                    . $nres->getMessage();

            throw $nres;
        
        } catch (NoResultExceptionHabitacion $nreh) {

            // no existe habitacion
            self::$error_debug .= " Función getHabitacion: "
                    . $nreh->getMessage();

            throw $nreh;
        
        } catch (\Exception $e) {

            self::$error_debug .= " Función getHabitacion: "
                    . $e->getMessage();

            throw new \Exception($msg);
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
            //dump($cama);die();
        } catch (NoResultExceptionCama $nrec) {

            self::$error_debug .= " Función getCama: "
                    . $nrec->getMessage();

            throw $nrec;
            
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

    /**
     * Si se pasan los string "false" o "true" devuelve el tipo booleano 
     * correspondiente, en caso contrario aplica la transformación forzada
     * del string pasado como parámetro al tipo booleano.
     * 
     * @param string $strbooleano
     * @return boolean 
     */
    public static function wrapBoolean($strbooleano) {

        if ($strbooleano == 'false') {

            return false;
        }
        if ($strbooleano == 'true') {

            return true;
        }

        return (boolean) $strbooleano;
    }
    
    /**
     * Cuando se pasa el string "NULL" como parámetro devuelve el tipo null de
     * php, en caso contrario devuelve el mismo string de entrada
     * 
     * @param string $strnull
     * @return type Si el string = "NULL" entonces devuelve null, si no devuelve
     * el mismo string de entrada
     */
//    public static function wrapNull($strnull) {
//
//        if (strtoupper($strnull) == 'NULL') {
//
//            return null;
//        }
//        
//        return $strnull;
//    }
    
    
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
                
                $msg.=" (".($i+1).") ".$errors[$i]->getMessage();
                
            }
            
            throw new \Exception($msg);
        }
        
    }
    
}