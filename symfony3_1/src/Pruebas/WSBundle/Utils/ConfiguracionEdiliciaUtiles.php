<?php

namespace Pruebas\WSBundle\Utils;

use Pruebas\WSBundle\Utils\ConfiguracionEdilicia;

/** Funciones utiles de la configuracion edilicia
 * 
 */
class ConfiguracionEdiliciaUtiles
{
    
    public $error_debug;
    private $doctrine;
    
    
    public function __construct($doctrine) {
    
        $this->doctrine = $doctrine;
        
    }
    
    public function __destruct() {
    
        
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
    public function getHabitacion(
            $nombre_habitacion,
            $nombre_sala,
            $id_efector){
        
        
        // id_habitacion
        //
        // busca el id_habitacion segun el nombre pasado por parametro
        // si no encuentra registro de habitacion coloca NULL
        // No se puede definir si existe mas de una habitacion con el mismo nombre
        // en el efector
        // busca nombre-id_efector en tabla camas
        try{
        
            $habitacion = 
                $this->doctrine->getRepository
                    ('DBHmi2GuaycuruCamasBundle:Habitaciones')
                    ->findOneByNombreSalaIdEfector(
                            $id_efector,
                            $nombre_sala,
                            $nombre_habitacion);
            
        } catch (\Doctrine\ORM\NonUniqueResultException $nure){
            
            // mas de una habitacion encontrada, no se puede determinar
            // cual es
            ConfiguracionEdilicia::$ERROR_DEBUG .= " Función getHabitacion: "
                    .$nure->getMessage();
            
            return null;
            
        } catch (\Doctrine\ORM\NoResultException $nre){
            
            // no existe habitacion
            ConfiguracionEdilicia::$ERROR_DEBUG .= " Función getHabitacion: "
                    .$nre->getMessage();
            
            return null;
            
        
        } catch (\Exception $e) {

            $msg = "Error al buscar la habitación: "
                    .$nombre_habitacion
                    ." en la sala: "
                    .$nombre_sala
                    ." en el efector con id: "
                    .$id_efector;
            
            ConfiguracionEdilicia::$ERROR_DEBUG .= " Función getHabitacion: "
                    .$e->getMessage();
            
            throw new \ErrorException($msg);
        }
        
        
        // unica habitacion con el nombre pasado por parametro en el efector    
        
        return $habitacion;
        
    }
    
    public function getClasificacionCama($id_clasificacion_cama){
        
        
        try {
        
            // clasificacion cama
            $clasificacion_cama = 
                $this->doctrine->getRepository
                    ('DBHmi2GuaycuruCamasBundle:ClasificacionesCamas')
                    ->findOneByIdClasificacionCama($id_clasificacion_cama);
                
        } catch (\Exception $e) {

            $msg = 'Error al buscar la clasificación de cama con id: '
                    .$id_clasificacion_cama;
            
            ConfiguracionEdilicia::$ERROR_DEBUG .= " Función getClasificacionCama: "
                    .$e->getMessage();
            
            throw new \ErrorException($msg);
        }
        
        // check clasificacion cama encontrada
        if (!$clasificacion_cama){
            
            $msg = "El id de clasificación de cama: "
                    .$id_clasificacion_cama
                    ." no existe en la base de datos";
        
            ConfiguracionEdilicia::$ERROR_DEBUG .= " Función getClasificacionCama: "
                    .$msg;
        
            throw new \Exception($msg);
            
        }
        
        return $clasificacion_cama;
        
    }
    
    
    public function getEfector($id_efector){
        
        // efector
        try {
        
            $efector = 
                $this->doctrine->getRepository
                    ('DBHmi2GuaycuruCamasBundle:Efectores')
                    ->findOneByIdEfector($id_efector);
            
        } catch (\Exception $e) {

            $msg = 'Error al buscar el efector con id: '
                    .$id_efector;
            
            ConfiguracionEdilicia::$ERROR_DEBUG .= " Función getEfector: "
                    .$e->getMessage();
            
            throw new \ErrorException($msg);
            
        }
        
        if (!$efector){
            
            $msg = "El id de efector: "
                    .$id_efector
                    ." no existe en la base de datos";
        
            ConfiguracionEdilicia::$ERROR_DEBUG .= " Función getEfector: "
                    .$msg;
            
            throw new \Exception ($msg);
            
        }
        
        return $efector;
        
    }
 
    public function getSala(
            $nombre_sala,
            $id_efector){
        
        
        try{
        
            $sala = 
                $this->doctrine->getRepository
                    ('DBHmi2GuaycuruCamasBundle:Salas')
                    ->findOneByNombreIdEfector(
                            $nombre_sala,
                            $id_efector);
            
        
        } catch (\Doctrine\ORM\NoResultException $nre){
            
            // no existe sala
            ConfiguracionEdilicia::$ERROR_DEBUG .= " Función getSala: "
                    .$nre->getMessage();
            
            $msg = "La sala: "
                    .$nombre_sala
                    ." no existe en el efector con id: "
                    .$id_efector;
            
            throw new \Exception($msg);
                        
        
        } catch (\Exception $e) {

            $msg = "Error al buscar la sala: "
                    .$nombre_sala
                    ." en el efector con id: "
                    .$id_efector;
            
            ConfiguracionEdilicia::$ERROR_DEBUG .= " Función getSala: "
                    .$e->getMessage();
            
            throw new \ErrorException($msg);
        }
        
        
        return $sala;
        
    }
    
        
    public function getCama(
            $nombre,
            $id_efector){
        
        // cama
        try {
            $cama = 
                $this->doctrine->getRepository
                        ('DBHmi2GuaycuruCamasBundle:Camas')
                        ->findOneByNombreIdEfector(
                                $nombre,
                                $id_efector);
            
        } catch (\Doctrine\ORM\NoResultException $nre){
            
            $msg = "La cama: "
                    .$nombre
                    ." no existe en el efector: "
                    .$id_efector;
            
            ConfiguracionEdilicia::$ERROR_DEBUG .= " Función getCama: "
                    .$nre->getMessage();
            
            throw new \Exception($msg);
            
        } catch (\Exception $e) {
            
            $msg = "Error al buscar la cama: "
                    .$nombre
                    ." en el efector con id: "
                    .$id_efector;
            
            ConfiguracionEdilicia::$ERROR_DEBUG .= " Función cama: "
                    .$e->getMessage();
            
            throw new \Exception($msg);
        }
            
        return $cama;
        
    }
            
    
    
    public function wrapBoolean(
            $strbooleano){
        
        if ($strbooleano=='false'){
            
            return false;
        }
        if ($strbooleano=='true'){
            
            return true;
        }
            
        return (boolean)$strbooleano;
    }
    
    
    

}