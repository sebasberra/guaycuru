<?php

namespace Pruebas\WSBundle\Utils;

use Pruebas\DBHmi2GuaycuruCamasBundle\Entity\Camas;

/** Realiza el acceso a la DB hmi2guaycuru para actualizacion de
 *  la configuracion edilicia.
 *  NOTA: la sincronizacion entre efectores y base central no puede
 *  ser completa en toda la estructura. Se inicia con la restriccion
 *  a implementar en las bases de hospitales que es nombre unico de
 *  cama por efector. La jararquia hacia arriba de camas, o sea, las
 *  relaciones con tabla habitaciones y salas no se implementara. Se
 *  sugiere nombres de habitaciones unicas por efector para que la 
 *  informacion se refleje en la base central, pero de no ser posible
 *  no se indicara la habitacion de la cama en base central
 */
class ConfiguracionEdilicia
{
    
    public $error_debug;
    private $doctrine;
    private $em;
    private $conn;
    private $validator;
    
    public function __construct($doctrine,$validator) {
    
        
        $this->error_debug="";
        $this->doctrine = $doctrine;
        $this->em = $doctrine->getManager('default');
        $this->conn = $doctrine->getManager('default')->getConnection();
        $this->validator = $validator;
        
    }
    
    public function __destruct() {
    
        
    }

    /** Agrega una cama a la base centralizada
     *  El parametro $nueva_cama es un arreglo con:
     *  ["nombre_cama"]
     *  ["nombre_habitacion"]
     *  ["id_efector"]
     *  ["id_clasificacion_cama"]
     *  ["estado"]
     *  ["rotativa"]
     *  ["baja"]
     * 
     * @param type $nueva_cama
     * @param type $msg
     * @return boolean
     */
    public function agregarCama(
            $nueva_cama){
        
//        id_cama int(10) unsigned NOT NULL AUTO_INCREMENT,
//        id_clasificacion_cama tinyint(3) unsigned NOT NULL 
//          COMMENT 'clasificacion de cama',
//        id_efector int(10) unsigned NOT NULL 
//          COMMENT 'Se guarda el id del efector para cuando la cama no esta asignada a una habitacion',
//        id_habitacion int(10) unsigned DEFAULT NULL 
//          COMMENT 'para camas rotativas esta permitido que la cama no este asignada a una habitacion en un momento dado',
//        NOTA: se agrega nombre de la habitacion y se busca el id_habitacion en base central por nombre
//        nombre_habitacion VARCHAR(50)
//        id_internacion int(10) unsigned DEFAULT NULL 
//          COMMENT 'Id de internacion de quien esta ocupando la cama. Si es NULL la cama esta vacia',
//        nombre varchar(50) NOT NULL,
//        estado char(1) NOT NULL 
//          COMMENT 'L=libre; O=ocupada; F=fuera de servicio; R=en reparacion; V=reservada',
//        rotativa tinyint(1) NOT NULL DEFAULT '0' 
//          COMMENT '0=no es rotativa, 1=es rotativa; Las camas rotativas pueden cambiarse de habitacion o sala o no estar asignada a una habitacion en un momento dado',
//        baja tinyint(1) NOT NULL DEFAULT '0' 
//          COMMENT '0 = habilitada; 1 = baja',
//        fecha_modificacion TIMESTAMP de actualizacion del registro
        
        
        
        // clasificacion cama
        try {
        
            $clasificacion_cama =
                    $this->getClasificacionCama(
                            $nueva_cama["id_clasificacion_cama"]
                            );
        
        } catch (\Exception $e) {

            throw $e;
            
        }
        
        
        // efector
        try{
            
            $efector = $this->getEfector($nueva_cama["id_efector"]);
            
        } catch (\Exception $e) {

            throw $e;
        }
        
        // obtiene la habitacion doctrine, solo en caso de que exista
        // una sola habitacion con el nombre en el efector
        try{
            
            $habitacion = $this->getHabitacion(
                $nueva_cama["nombre_habitacion"],
                $nueva_cama["id_efector"]);
            
        } catch (\ErrorException $ee){
            
            $msg = $ee->getMessage();
            
            throw $ee;
            
        }
        
                     
        // objeto Camas doctrine
        $cama = new Camas();
        
        
        // baja = false
        $baja = ($nueva_cama["baja"]=='true'?'1':'0');
        $cama->setBaja($baja);
        
        // estado libre
        $cama->setEstado($nueva_cama["estado"]);
        
        // timestamp fecha modificacion
        $cama->setFechaModificacion(null);
        
        // clasificacion cama
        $cama->setIdClasificacionCama($clasificacion_cama);
        
        
        // efector
        $cama->setIdEfector($efector);
        
        // habitacion
        $cama->setIdHabitacion($habitacion);
        
        // internacion null
        $cama->setIdInternacion(null);
        
        // nombre de cama
        $cama->setNombre($nueva_cama["nombre_cama"]);
        
        // rotativa
        $rotativa = ($nueva_cama["rotativa"]=='true'?'1':'0');
        $cama->setRotativa($rotativa);
        
        
        // validacion assert
        $this->validacionAssert($cama);
    
        //
        // insert datos en la DB
        $this->em->persist($cama);
        $this->em->flush();

        $msg = "La cama: ".$nueva_cama["nombre_cama"]
                ." fue ingresada al efector: "
                .$efector->getNomEfector();
        if ($habitacion){        
            $msg.=" y en la habitación: ".$habitacion->getNombre();
        }
        
        return $msg;
        
    }
    
    /** La modificacion de cama se aplica a
     * 
     *  id_clasificacion_cama
     *  id_habitacion
     *  baja
     *  estado
     * 
     * 
     * 
     * 
     *  El cambio de nombre es un caso especial y se trata 
     *  independiente porque es clave unica (nombre,id_efector)
     *  
     * @param type $modif_cama
     * @return boolean
     */
    public function modificarCama($modif_cama){
    
        
        // cama
        try {
            
            $cama = 
                    $this->getCama(
                            $modif_cama['nombre_cama'], 
                            $modif_cama['id_efector']
                            );
            
        } catch (\Exception $e) {
            
            throw $e;

        }
        
        
        // clasificacion cama
        try {
        
            $clasificacion_cama =
                    $this->getClasificacionCama(
                            $modif_cama["id_clasificacion_cama"]
                            );
        
        } catch (\Exception $e) {

            throw $e;
            
        }
        
        
        // efector
        try{
            
            $efector = 
                    $this->getEfector(
                            $modif_cama["id_efector"]
                            );
            
        } catch (\Exception $e) {

            throw $e;
        }
        
        
        
        
        // obtiene la habitacion doctrine, solo en caso de que exista
        // una sola habitacion con el nombre en el efector
        try{
            
            $habitacion = $this->getHabitacion(
                $modif_cama["nombre_habitacion"],
                $modif_cama["id_efector"]);
            
        } catch (\ErrorException $ee){
            
            $msg = $ee->getMessage();
            
            throw $ee;
            
        }
             
        
        
        // baja
        $baja = ($modif_cama["baja"]=='true'?'1':'0');
        $cama->setBaja($baja);
        
        // estado libre
        $cama->setEstado($modif_cama["estado"]);
        
        // timestamp fecha modificacion
        $cama->setFechaModificacion(null);
               
        // clasificacion cama
        $cama->setIdClasificacionCama($clasificacion_cama);
        
        // habitacion
        $cama->setIdHabitacion($habitacion);
                
        // internacion null
        $cama->setIdInternacion(null);
        
        // rotativa
        $rotativa = ($modif_cama["rotativa"]=='true'?'1':'0');
        $cama->setRotativa($rotativa);
        
        
        // validacion assert
        $this->validacionAssert($cama);
        
        // update datos en la DB
        $this->em->persist($cama);
        $this->em->flush();

        $msg = "La cama: ".$modif_cama["nombre_cama"]
                ." fue modificada en el efector: "
                .$efector->getNomEfector();
        if ($habitacion){        
            $msg.=", en la habitación: ".$habitacion->getNombre();
        }
        
        return $msg;
        
    }
    
    
    /** Elimina la cama si no tiene usando DELETE, la baja se hace
     *  a traves de la modificacion de cama
     *  
     * @param type $elimina_cama
     * @throws \Exception
     */
    public function eliminarCama($elimina_cama){
        
        // cama
        try {
            
            $cama = 
                    $this->getCama(
                            $elimina_cama['nombre_cama'], 
                            $elimina_cama['id_efector']
                            );
            
        } catch (\Exception $e) {
            
            throw $e;

        }
        
        
        // elimina la cama
        $this->em->remove($cama);
        $this->em->flush();
        
        $msg = "La cama: ".$elimina_cama["nombre_cama"]
                ." fue eliminada del efector: "
                .$cama->getIdEfector()->getNomEfector();
                
        return $msg;
        
    }
    
    public function ocuparCama(
            $ocupa_cama,
            $sobrecarga=false){
        
        // cama
        try {
            
            $cama = 
                    $this->getCama(
                            $ocupa_cama['nombre_cama'], 
                            $ocupa_cama['id_efector']
                            );
            
        } catch (\Exception $e) {
            
            throw $e;

        }
        
        // check cama ocupada
        if ($cama->getEstado()=='O' &&
            $sobrecarga==false){
                
            $msg = "La cama "
                .$ocupa_cama['nombre_cama']
                ." está ocupada";
            throw new \Exception($msg);
                
        }
        
        // estado
        $cama->setEstado('O');
        
        // ocupa la cama
        $this->em->persist($cama);
        $this->em->flush();
        
        $msg = "La cama: ".$ocupa_cama["nombre_cama"]
                ." fue ocupada en el efector: "
                .$cama->getIdEfector()->getNomEfector();
                
        return $msg;
    }
    
    public function liberarCama($libera_cama){
        
        // cama
        try {
            
            $cama = 
                    $this->getCama(
                            $libera_cama['nombre_cama'], 
                            $libera_cama['id_efector']
                            );
            
        } catch (\Exception $e) {
            
            throw $e;

        }
        
        // check cama libre
        if ($cama->getEstado()=='L'){
                
            $msg = "La cama "
                .$libera_cama['nombre_cama']
                ." ya está libre";
            throw new \Exception($msg);
                
        }
        
        // estado
        $cama->setEstado('L');
        
        // ocupa la cama
        $this->em->persist($cama);
        $this->em->flush();
        
        $msg = "La cama: ".$libera_cama["nombre_cama"]
                ." fue liberada en el efector: "
                .$cama->getIdEfector()->getNomEfector();
                
        return $msg;
        
    }
    
    public function agregarHabitacion($nueva_hab){
        
    }
    
    public function modificarHabitacion($modif_hab){
        
    }
    
    public function eliminarHabitacion($elimina_hab){
        
    }
    
    public function agregarSala($nueva_sala){
        
    }
    
    public function modificarSala($modif_sala){
        
    }
    
    public function eliminarSala($elimina_sala){
        
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
    private function getHabitacion(
            $nombre_habitacion,
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
                    ->findOneByNombreIdEfector(
                            $nombre_habitacion,
                            $id_efector);
            
        } catch (\Doctrine\ORM\NonUniqueResultException $nure){
            
            // mas de una habitacion encontrada, no se puede determinar
            // cual es
            $this->error_debug .= " Función getHabitacion: "
                    .$nure->getMessage();
            
            return null;
            
        } catch (\Doctrine\ORM\NoResultException $nre){
            
            // no existe habitacion
            $this->error_debug .= " Función getHabitacion: "
                    .$nre->getMessage();
            
            return null;
            
        
        } catch (\Exception $e) {

            $msg = "Error al buscar la habitación: "
                    .$nombre_habitacion
                    ." en el efector con id: "
                    .$id_efector;
            
            $this->error_debug .= " Función getHabitacion: "
                    .$e->getMessage();
            
            throw new \ErrorException($msg);
        }
        
        
        // unica habitacion con el nombre pasado por parametro en el efector    
        
        return $habitacion;
        
    }
    
    private function getClasificacionCama($id_clasificacion_cama){
        
        
        try {
        
            // clasificacion cama
            $clasificacion_cama = 
                $this->doctrine->getRepository
                    ('DBHmi2GuaycuruCamasBundle:ClasificacionesCamas')
                    ->findOneByIdClasificacionCama($id_clasificacion_cama);
                
        } catch (\Exception $e) {

            $msg = 'Error al buscar la clasificación de cama con id: '
                    .$id_clasificacion_cama;
            
            $this->error_debug .= " Función getClasificacionCama: "
                    .$e->getMessage();
            
            throw new \ErrorException($msg);
        }
        
        // check clasificacion cama encontrada
        if (!$clasificacion_cama){
            
            $msg = "El id de clasificación de cama: "
                    .$id_clasificacion_cama
                    ." no existe en la base de datos";
        
            $this->error_debug .= " Función getClasificacionCama: "
                    .$msg;
        
            throw new \Exception($msg);
            
        }
        
        return $clasificacion_cama;
        
    }
    
    
    private function getEfector($id_efector){
        
        // efector
        try {
        
            $efector = 
                $this->doctrine->getRepository
                    ('DBHmi2GuaycuruCamasBundle:Efectores')
                    ->findOneByIdEfector($id_efector);
            
        } catch (\Exception $e) {

            $msg = 'Error al buscar el efector con id: '
                    .$id_efector;
            
            $this->error_debug .= " Función getEfector: "
                    .$e->getMessage();
            
            throw new \ErrorException($msg);
            
        }
        
        if (!$efector){
            
            $msg = "El id de efector: "
                    .$id_efector
                    ." no existe en la base de datos";
        
            $this->error_debug .= " Función getEfector: "
                    .$msg;
            
            throw new \Exception ($msg);
            
        }
        
        return $efector;
        
    }
 
    private function getCama(
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
            
            $this->error_debug .= " Función getCama: "
                    .$nre->getMessage();
            
            throw new \Exception($msg);
            
        } catch (\Exception $e) {
            
            $msg = "Error al buscar la cama: "
                    .$nombre
                    ." en el efector con id: "
                    .$id_efector;
            
            $this->error_debug .= " Función cama: "
                    .$e->getMessage();
            
            throw new \Exception($msg);
        }
            
        return $cama;
        
    }
            
    private function validacionAssert($entidad){
        
        //
        // validator assert
        //
        $errors = $this->validator->validate($entidad);
    
        if (count($errors) > 0) {
            /*
             * Uses a __toString method on the $errors variable which is a
             * ConstraintViolationList object. This gives us a nice string
             * for debugging.
             */
            $this->error_debug .= (string) $errors;

            // concatena los errores
            $msg="(1) ".$errors[0]->getMessage();
            for ($i=1;$i<count($errors);$i++){
                
                $msg.=" (".($i+1).") ".$errors[$i]->getMessage();
                
            }
            
            throw new \Exception($msg);
        }
        
    }
}

