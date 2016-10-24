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
        
        // ini
        $this->error_debug="";
            
       
        
        // clasificacion cama
        try {
        
            $clasificacion_cama = 
                $this->doctrine->getRepository
                    ('DBHmi2GuaycuruCamasBundle:ClasificacionesCamas')
                    ->findOneByIdClasificacionCama($nueva_cama["id_clasificacion_cama"]);
        
        } catch (\Exception $e) {

            $msg = 'Error al buscar la clasificacion de cama con id: '
                    .$nueva_cama["id_clasificacion_cama"];
            
            $this->error_debug = $e->getMessage();
            
            throw new \Exception($msg);
            
        }
        
        if (!$clasificacion_cama){
            
            $msg = "El id de clasificación de cama: "
                    .$nueva_cama["id_clasificacion_cama"]
                    ." no existe en la base de datos";
            $this->error_debug = $msg;
            
            throw new \Exception ($msg);
            
        }
        
        
        // efector
        try {
        
            $efector = 
                $this->doctrine->getRepository
                    ('DBHmi2GuaycuruCamasBundle:Efectores')
                    ->findOneByIdEfector($nueva_cama["id_efector"]);
            
        } catch (\Exception $e) {

            $msg = 'Error al buscar el efector con id: '
                    .$nueva_cama["id_efector"];
            
            $this->error_debug = $e->getMessage();
            
            throw new \Exception($msg);
            
        }
        
        if (!$efector){
            
            $msg = "El id de efector: "
                    .$nueva_cama["id_efector"]
                    ." no existe en la base de datos";
        
            $this->error_debug = $msg;
            
            throw new \Exception ($msg);
            
        }
        
        // obtiene la habitacion doctrine, solo en caso de que exista
        // una sola habitacion con el nombre en el efector
        try{
            
            $habitacion = $this->obtenerHabitacion(
                $nueva_cama["nombre_habitacion"],
                $nueva_cama["id_efector"]);
            
        } catch (\Exception $e) {

            $msg = $e->getMessage();
            $habitacion=null;
            
        } catch (\ErrorException $ee){
            
            $msg = $ee->getMessage();
            
            throw $ee;
            
        }
            
                
        // chequea que el nombre de cama este libre para usarse en el efector
//        try {
//            
//            $this->validarNombreCama(
//                $nueva_cama["nombre_cama"], 
//                $nueva_cama["id_efector"]);
//            
//        } catch (\Exception $e){
//            
//            // nombre de cama existe
//            throw $e;
//                    
//        } catch (\ErrorException $ee) {
//
//            // error en consulta
//            throw $ee;
//        }
                     
        // objeto Camas doctrine
        $cama = new Camas();
        
        // baja = false
        $cama->setBaja(false);
        
        // estado libre
        $cama->setEstado("L");
        
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
        
        // rotativa falso
        $cama->setRotativa(false);
        
        
        $errors = $this->validator->validate($cama);
    
        if (count($errors) > 0) {
            /*
             * Uses a __toString method on the $errors variable which is a
             * ConstraintViolationList object. This gives us a nice string
             * for debugging.
             */
            $errorsString = (string) $errors;

            return new \Exception($errorsString);
        }
    
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
     * !!!!!!! rever ingreso nueva cama, campos baja estado etc
     * 
     * 
     *  La cambio de nombre es un caso especial y se trata 
     *  independiente porque es clave unica (nombre,id_efector)
     *  
     * @param type $modif_cama
     * @return boolean
     */
    public function modificarCama($modif_cama){
    
        
        // cama
        try {
            $cama = 
                $this->doctrine->getRepository
                        ('DBHmi2GuaycuruCamasBundle:Camas')
                        ->findOneByNombreIdEfector(
                                $modif_cama['nombre_cama'],
                                $modif_cama['id_efector']);
            
        } catch (\ErrorException $ee) {
            
            throw $ee;

        }
        
        if (!$cama){
            
            $msg = "La cama: "
                    .$modif_cama
                    ." no existe en el efector: "
                    .$modif_cama['id_efector'];
            
            throw new \Exception($msg);
            
        }
        
        
        // clasificacion cama
        $clasificacion_cama = 
            $this->doctrine->getRepository
                ('DBHmi2GuaycuruCamasBundle:ClasificacionesCamas')
                ->findOneByIdClasificacionCama($modif_cama["id_clasificacion_cama"]);
        
        if (!$clasificacion_cama){
            
            $msg = "El id de clasificación de cama: "
                    .$nueva_cama["id_clasificacion_cama"]
                    ." no existe en la base de datos";
        
            $this->error_debug = $msg;
        
            return false;
            
        }
        
        
        // efector
        $efector = 
            $this->doctrine->getRepository
                ('DBHmi2GuaycuruCamasBundle:Efectores')
                ->findOneByIdEfector($modif_cama["id_efector"]);
        
        if (!$efector){
            
            $msg = "El id de efector: "
                    .$modif_cama["id_efector"]
                    ." no existe en la base de datos";
        
            $this->error_debug = $msg;
        }
        
        // obtiene la habitacion doctrine, solo en caso de que exista
        // una sola habitacion con el nombre en el efector
        try{
            
            $habitacion = $this->obtenerHabitacion(
                $modif_cama["nombre_habitacion"],
                $modif_cama["id_efector"]);
            
        } catch (\Exception $e) {

            $msg = $e->getMessage();
            $habitacion=null;
            
        } catch (\ErrorException $ee){
            
            $msg = $ee->getMessage();
            
            throw $ee;
            
        }
             
        
        
        // baja = false
        $cama->setBaja(false);
        
        // estado libre
        $cama->setEstado("L");
        
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
        
        // rotativa falso
        $cama->setRotativa(false);
        
        // insert datos en la DB
        $this->em->persist($cama);
        $this->em->flush();

        $msg = "La cama: ".$nueva_cama["nombre_cama"]
                ." fue ingresada al efector: "
                .$efector->getNomEfector();
        if ($habitacion){        
            $msg+=" y en la habitación: ".$habitacion->getNombre();
        }
        
        return true;
        
    }
    
    public function eliminarCama($elimina_cama){
        
    }
    
    public function ocuparCama($ocupa_cama){
        
    }
    
    public function liberarCama($libera_cama){
        
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
    private function obtenerHabitacion(
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
            
        } catch (\ErrorException $ee) {

            throw $ee;
        }
        
        
        // check habitacion encontrada en el efector
        $count = count($habitacion);
        if ($count == 0){
            
            // no existe habitacion
            $msg = "No existe habitación: ".$nombre_habitacion
                ." en el efector: ".$id_efector." ";
            
            throw new \Exception($msg);
            
        }elseif ($count > 1){
            
            // mas de una habitacion encontrada, no se puede determinar
            // cual es
            $msg = "Existe más de una habitación con el nombre: "
                    .$nombre_habitacion
                    ." en el efector: "
                    .$id_efector;
            
            // reset habitaciones
            throw new \Exception($msg);
                        
        }
        
        
        // unica habitacion con el nombre pasado por parametro en el efector    
        
        return $habitacion;
        
    }
    
    
    /** Valida si el nombre de cama esta libre para usarse en el efector
     *  NOTA: nombres de camas unicos por efector
     * 
     * @param type $nombre_cama
     * @param type $id_efector
     * @param type $msg
     * @return boolean
     */
    private function validarNombreCama(
            $nombre_cama,
            $id_efector){
        
        
        // busca nombre-id_efector en tabla camas
        try {
            
            $cama = 
                $this->doctrine->getRepository
                    ('DBHmi2GuaycuruCamasBundle:Camas')
                    ->findOneByNombreIdEfector(
                            $nombre_cama,
                            $id_efector);
            
        } catch (\ErrorException $ee) {
            
            throw $ee;

        }
        
                
        // check nombre de cama existe en el efector
        if ($cama){
            
            // existe cama
            $msg = "El nombre de cama: ".$nombre_cama
                ." ya existe para el efector: ".$id_efector." ";
            
            throw new \Exception($msg);
            
        }
        
        // el nombre de cama esta libre para usarse
        
    }
}

