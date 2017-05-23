<?php

namespace RI\RIWebServicesBundle\Utils\ConfiguracionEdilicia;

use RI\DBHmi2GuaycuruCamasBundle\Entity\Camas;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;


trait ConfiguracionEdiliciaCamas{
    
    /** Agrega una cama a la base centralizada
     *  El parametro $nueva_cama es un arreglo con:
     *  ["id_efector"]
     *  ["nombre_sala"]
     *  ["nombre_habitacion"]
     *  ["nombre_cama"]
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
        
        
        // efector
        try{
            
            $efector = RIUtiles::getEfector($nueva_cama["id_efector"]);
            
        } catch (\Exception $e) {

            throw $e;
        }
        
        // clasificacion cama
        try {
        
            $clasificacion_cama =
                    RIUtiles::getClasificacionCama(
                            $nueva_cama["id_clasificacion_cama"]
                            );
        
        } catch (\Exception $e) {

            throw $e;
            
        }
        
        
        // rotativa
        $rotativa = RIUtiles::wrapBoolean($nueva_cama["rotativa"]);
        
        // cama rotativa entonces puede tener la habitacion null, en otro caso
        // controla que exista la habitacion
        if ($rotativa==true &&                
                $nueva_cama["nombre_sala"] == '' &&
                $nueva_cama["nombre_habitacion"] == ''){
            
            // cama rotativa sin habitacion asignada
            $habitacion = null;
            
        }else{
            
            // habitacion
            try{
    
                $habitacion = RIUtiles::getHabitacion(
                        $nueva_cama["nombre_habitacion"],
                        $nueva_cama["nombre_sala"],
                        $nueva_cama["id_efector"]);

            } catch (\ErrorException $ee){

                throw $ee;

            }
            
        }
        
         
                     
        // objeto Camas doctrine
        $cama = new Camas();
        
        
        // baja
        $cama->setBaja(RIUtiles::wrapBoolean($nueva_cama["baja"]));
        
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
        $cama->setRotativa($rotativa);
        
        
        // validacion assert
        RIUtiles::validacionAssert($cama);
    
        
        
        try{
        
            // begintrans
            RI::$conn->beginTransaction();
        
            // insert datos en la DB
            RI::$em->persist($cama);
            RI::$em->flush();

            // check actualiza cant camas de habitacion y sala
            if ($habitacion){

                // cant_camas habitacion
                $this->setCantCamasHab($habitacion);

                // cant_camas sala
                $this->setCantCamasSala($habitacion->getIdSala());

            }
        
            // commit
            RI::$conn->commit();
            
        }catch(\Exception $e){
            
            RI::$error_debug .=
                    "Error al agregar la cama: "
                    .$nueva_cama["nombre_cama"];
            
            // rollback
            RI::$conn->rollBack();
            
            throw $e;
            
        }
        
        $msg = "La cama: ".$nueva_cama["nombre_cama"]
                ." fue ingresada al efector: "
                .$efector->getNomEfector();
        if ($habitacion){        
            $msg.=" en la sala: "
                    .$nueva_cama["nombre_sala"]
                    ." y la habitación: "
                    .$nueva_cama["nombre_habitacion"];
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
                    RIUtiles::getCama(
                            $modif_cama['nombre_cama'], 
                            $modif_cama['id_efector']
                            );
            
        } catch (\Exception $e) {
            
            throw $e;

        }
        
        
        // clasificacion cama
        try {
        
            $clasificacion_cama =
                    RIUtiles::getClasificacionCama(
                            $modif_cama["id_clasificacion_cama"]
                            );
        
        } catch (\Exception $e) {

            throw $e;
            
        }
        
        
        // efector
        try{
            
            $efector = 
                    RIUtiles::getEfector(
                            $modif_cama["id_efector"]
                            );
            
        } catch (\Exception $e) {

            throw $e;
        }
        
        
        
        // rotativa
        $rotativa = RIUtiles::wrapBoolean($modif_cama["rotativa"]);
        
        // cama rotativa entonces puede tener la habitacion null, en otro caso
        // controla que exista la habitacion
        if ($rotativa==true &&                
                $modif_cama["nombre_sala"]="" &&
                $modif_cama["nombre_habitacion"] = ""){
            
            // cama rotativa sin habitacion asignada
            $habitacion = null;
            
        }else{
            
            // habitacion
            try{

                $habitacion = RIUtiles::getHabitacion(
                        $modif_cama["nombre_habitacion"],
                        $modif_cama["nombre_sala"],
                        $modif_cama["id_efector"]);

            } catch (\ErrorException $ee){

                throw $ee;

            }
            
        }
        
        // baja actual
        $baja_actual = $cama->isBaja();
        
        // baja_nueva
        $baja_nueva = RIUtiles::wrapBoolean($modif_cama["baja"]);
        
        $cama->setBaja($baja_nueva);
        
        // estado
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
        $cama->setRotativa($rotativa);
        
        
        // validacion assert
        RIUtiles::validacionAssert($cama);
        
       
        
        try{
       
            // begintrans
            RI::$conn->beginTransaction();
            
            
            // update datos en la DB
            RI::$em->persist($cama);
            RI::$em->flush();

            // check actualiza cant camas de habitacion y sala
            if (($baja_nueva != $baja_actual) && 
                    $habitacion != null){
            
                // baja cambia, entonces cambia stock de camas habitacion y sala
            
                // cant_camas habitacion
                $this->setCantCamasHab($habitacion);

                // cant_camas sala
                $this->setCantCamasSala($habitacion->getIdSala());

            }
        
            // commit
            RI::$conn->commit();
            
        }catch(\Exception $e){
            
            RI::$error_debug .=
                    "Error al modificar la cama: "
                    .$modif_cama["nombre_cama"];
            
            // rollback
            RI::$conn->rollBack();
            
            throw $e;
            
        }
        

        $msg = "La cama: ".$modif_cama["nombre_cama"]
                ." fue modificada en el efector: "
                .$efector->getNomEfector();
        if ($habitacion){        
            $msg.=" en la sala: "
                    .$modif_cama["nombre_sala"]
                    ." y la habitación: "
                    .$modif_cama["nombre_habitacion"];
        }
        
        return $msg;
        
    }
    
    
    /** Elimina la cama usando DELETE, la baja se hace
     *  a traves de la modificacion de cama
     *  
     * @param type $elimina_cama
     * @throws \Exception
     */
    public function eliminarCama($elimina_cama){
        
        // cama
        try {
            
            $cama = 
                    RIUtiles::getCama(
                            $elimina_cama['nombre_cama'], 
                            $elimina_cama['id_efector']
                            );
            
        } catch (\Exception $e) {
            
            throw $e;

        }
        
        // habitacion
        $habitacion=$cama->getIdHabitacion();
        
        
        // begintrans
        RI::$conn->beginTransaction();
        
        try{
            
            // begintrans
            RI::$conn->beginTransaction();
            
            // elimina la cama
            RI::$em->remove($cama);
            RI::$em->flush();

            // check actualiza cant camas de habitacion y sala
            if ($habitacion){

                // cant_camas habitacion
                $this->setCantCamasHab($habitacion);

                // cant_camas sala
                $this->setCantCamasSala($habitacion->getIdSala());

            }
            
            // commit
            RI::$conn->commit();
            
        }catch(\Exception $e){
            
            RI::$error_debug .=
                    "Error al eliminar la cama: "
                    .$elimina_cama["nombre_cama"];
            
            // rollback
            RI::$conn->rollBack();
            
            throw $e;
            
        }
        
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
                    RIUtiles::getCama(
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
        
        // validacion assert
        RIUtiles::validacionAssert($cama);
        
        
        try{
        
            // begintrans
            RI::$conn->beginTransaction();
        
            // ocupa la cama
            RI::$em->persist($cama);
            RI::$em->flush();
        
            // commit
            RI::$conn->commit();
            
        } catch (\Exception $e) {

            // rollback
            RI::$conn->rollBack();
            
            throw $e;
            
        }
        
        $msg = "La cama: ".$ocupa_cama["nombre_cama"]
                ." fue ocupada en el efector: "
                .$cama->getIdEfector()->getNomEfector();
                
        return $msg;
    }
    
    public function liberarCama($libera_cama){
        
        // cama
        try {
            
            $cama = 
                    RIUtiles::getCama(
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
        
        // validacion assert
        RIUtiles::validacionAssert($cama);
        
        
        try{
        
            // begintrans
            RI::$conn->beginTransaction();
        
            // ocupa la cama
            RI::$em->persist($cama);
            RI::$em->flush();
        
            // commit
            RI::$conn->commit();
            
        } catch (\Exception $e) {

            // rollback
            RI::$conn->rollBack();
            
            throw $e;
            
        }
        
        
        $msg = "La cama: ".$libera_cama["nombre_cama"]
                ." fue liberada en el efector: "
                .$cama->getIdEfector()->getNomEfector();
                
        return $msg;
        
    }
    
    
}

