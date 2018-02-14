<?php
/**
 * Proyecto Final Ingeniería Informática 2017 - UNL - Santa Fe - Argentina
 * 
 * Web Services Plataforma Web para centralización de camas críticas de internación en hospitales de la Provincia de Santa Fe
 * 
 * @author Sebastián Berra <sebasberra@yahoo.com.ar>
 * 
 * @version 0.1.0
 */
namespace RI\RIWebServicesBundle\Utils\ConfiguracionEdilicia;

use RI\DBHmi2GuaycuruCamasBundle\Entity\Camas;
use RI\DBHmi2GuaycuruCamasBundle\Exception\NoResultExceptionHabitacion;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;


/**
 * **Realiza las operaciones de ABM de Camas**
 * 
 * 
 * @api *Librería de acceso a la base de datos centralizada del sistema de camas críticas de internación*
 * 
 * @author Sebastián Berra <sebasberra@yahoo.com.ar>
 *  
 * @link http://www.doctrine-project.org
 * Doctrine Project
 * 
 * @link https://symfony.com/doc/current/doctrine.html
 * Symfony - Databases and the Doctrine ORM
 * 
 * @link https://symfony.com/doc/current/components/validator.html
 * Symfony - The Validator Component
 * 
 * @see RI\DBHmi2GuaycuruCamasBundle\Entity\Camas
 */
trait ConfiguracionEdiliciaCamas{
    
    /** 
     * **Agrega una cama a la base centralizada**
     * 
     * @param array $nueva_cama
     *  
     * <table cellpadding="0" cellspacing="0" border="1" style="border-style: solid; border-color: #cccccc #cccccc;">
     * <tr>
     *  <td>["id_efector"]</td>
     *  <td>ID efector donde pertenece la cama</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["nombre_sala"]</td>
     *  <td>Nombre de la sala donde pertenece la cama.
     *      NOTA: se busca el id_sala en base central por nombre</td>
     *  <td>string</td>
     * </tr>
     * <tr>
     *  <td>["nombre_habitacion"]</td>
     *  <td>Nombre de habitación donde pertenece la cama.
     *      NOTA: se busca el id_habitacion en base central por nombre
     *  <td>string</td>
     * <tr>
     *  <td>["nombre_cama"]</td>
     *  <td>Nombre de la cama. 
     *      NOTA: El nombre de la cama debe ser único en el efector. 
     *      El cambio de un nombre de cama en el sistema cliente implica una 
     *      eliminación y un alta de cama en la base centralizada</td>
     *  <td>string</td>
     * </tr>
     * <tr>
     *  <td>["id_clasificacion_cama"]</td>
     *  <td>Clasificación de camas. Ver tabla: clasificaciones_camas</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["estado"]</td>
     *  <td>L=libre; O=ocupada; F=fuera de servicio; R=en reparación; V=reservada</td>
     *  <td>string</td>
     * </tr>
     * <tr>
     *  <td>["rotativa"]</td>
     *  <td>0=no es rotativa, 1=es rotativa; 
     *  NOTA: Las camas rotativas pueden cambiarse de habitación o sala o no estar asignada a una habitación en un momento dado</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["baja"]</td>
     *  <td>0 = habilitada; 1 = baja</td>
     *  <td>integer</td>
     * </tr>
     * </table>
     * @return string Mensaje de cama ingresada
     * 
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
    public function agregarCama(
            $nueva_cama){
        
        /**
         * @internal
         * 
         * id_cama int(10) unsigned NOT NULL AUTO_INCREMENT,
         * id_clasificacion_cama tinyint(3) unsigned NOT NULL 
         * id_efector int(10) unsigned NOT NULL 
         * id_habitacion int(10) unsigned DEFAULT NULL 
         * nombre_habitacion VARCHAR(50)
         * id_internacion int(10) unsigned DEFAULT NULL 
         * nombre varchar(50) NOT NULL,
         * estado char(1) NOT NULL 
         * rotativa tinyint(1) NOT NULL DEFAULT '0' 
         * baja tinyint(1) NOT NULL DEFAULT '0' 
         * fecha_modificacion TIMESTAMP 
         * 
         */
        
        
        try{
        
            // efector
            $efector = RIUtiles::getEfector($nueva_cama["id_efector"]);
            
            // clasificacion cama
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
                
            } catch (NoResultExceptionHabitacion $nreh){

            } catch (\Exception $e){

                throw $e;

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
    
    /** 
     * **Modifica una cama en la base centralizada**
     * 
     * La modificación de cama se aplica a
     * 
     * <table style="border-style: dashed;">
     *  <tr><td style="border-style: none; text-align:left">id_clasificacion_cama</td></tr>
     *  <tr><td style="border-style: none; text-align:left">id_habitacion</td></tr>
     *  <tr><td style="border-style: none; text-align:left">estado</td></tr>
     *  <tr><td style="border-style: none; text-align:left">rotativa</td></tr>
     *  <tr><td style="border-style: none; text-align:left">baja</td></tr>
     * </table>
     * 
     *  *NOTA: El cambio de nombre es un caso especial y no se permire modificar porque es clave única (nombre,id_efector)*
     *  
     * @param array $modif_cama
     * 
     * <table cellpadding="0" cellspacing="0" border="1" style="border-style: solid; border-color: #cccccc #cccccc;">
     * <tr>
     *  <td>["id_efector"]</td>
     *  <td>ID efector donde pertenece la cama</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["nombre_sala"]</td>
     *  <td>Nombre de la sala donde pertenece la cama.
     *      NOTA: se busca el id_sala en base central por nombre</td>
     *  <td>string</td>
     * </tr>
     * <tr>
     *  <td>["nombre_habitacion"]</td>
     *  <td>Nombre de habitación donde pertenece la cama.
     *      NOTA: se busca el id_habitacion en base central por nombre
     *  <td>string</td>
     * <tr>
     *  <td>["nombre_cama"]</td>
     *  <td>Nombre de la cama. 
     *      NOTA: Se utiliza solo para encontrar la cama, <strong>no se modifica</strong></td>
     *  <td>string</td>
     * </tr>
     * <tr>
     *  <td>["id_clasificacion_cama"]</td>
     *  <td>Clasificación de camas. Ver tabla: clasificaciones_camas</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["estado"]</td>
     *  <td>L=libre; O=ocupada; F=fuera de servicio; R=en reparación; V=reservada</td>
     *  <td>string</td>
     * </tr>
     * <tr>
     *  <td>["rotativa"]</td>
     *  <td>0=no es rotativa, 1=es rotativa; 
     *  NOTA: Las camas rotativas pueden cambiarse de habitación o sala o no estar asignada a una habitación en un momento dado</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["baja"]</td>
     *  <td>0 = habilitada; 1 = baja</td>
     *  <td>integer</td>
     * </tr>
     * </table>
     * 
     * @return string Mensaje de cama modificada
     * 
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
    public function modificarCama($modif_cama){
    
//        dump($modif_cama);die();
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
        
        /**
         * @internal cama rotativa entonces puede tener la habitacion null, 
         * en otro caso controla que exista la habitación
         */
        if ($rotativa==true &&                
                $modif_cama["nombre_sala"] == "" &&
                $modif_cama["nombre_habitacion"] == ""){
            
            // cama rotativa sin habitacion asignada
            $habitacion = null;
            
        }else{
            
            // habitacion
            try{

                $habitacion = RIUtiles::getHabitacion(
                        $modif_cama["nombre_habitacion"],
                        $modif_cama["nombre_sala"],
                        $modif_cama["id_efector"]);
                
            } catch (NoResultExceptionHabitacion $nreh){
                
            } catch (\Exception $e){

                throw $e;

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
    
    
    /** 
     * **Elimina una cama en la base centralizada**
     * 
     * *NOTA: Elimina la cama usando DELETE, la baja se hace
     * a través de la modificación de cama*
     *  
     * @param array $elimina_cama
     * 
     * <table cellpadding="0" cellspacing="0" border="1" style="border-style: solid; border-color: #cccccc #cccccc;">
     * <tr>
     *  <td>["id_efector"]</td>
     *  <td>ID efector donde pertenece la cama</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["nombre_cama"]</td>
     *  <td>Nombre de la cama</td>
     *  <td>string</td>
     * </tr>
     * </table>
     * 
     * @return string Mensaje de cama eliminada
     * 
     * @throws \Exception Las excepciones son capturadas y relanzadas
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
    
    /** 
     * **Cambia el estado de la cama a "ocupada" en la base centralizada**
     *  
     * @param array $ocupa_cama
     * 
     * <table cellpadding="0" cellspacing="0" border="1" style="border-style: solid; border-color: #cccccc #cccccc;">
     * <tr>
     *  <td>["id_efector"]</td>
     *  <td>ID efector donde pertenece la cama</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["nombre_cama"]</td>
     *  <td>Nombre de la cama</td>
     *  <td>string</td>
     * </tr>
     * </table>
     * 
     * @param boolean $sobrecarga Si la cama está ocupada lanza una excepción
     * 
     * @return string Mensaje de cama ocupada
     * 
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
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
        
        /**
         * @internal check cama ocupada
         */
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
    
    
    /** 
     * **Cambia el estado de la cama a "libre" en la base centralizada**
     *  
     * @param array $libera_cama
     * 
     * <table cellpadding="0" cellspacing="0" border="1" style="border-style: solid; border-color: #cccccc #cccccc;">
     * <tr>
     *  <td>["id_efector"]</td>
     *  <td>ID efector donde pertenece la cama</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["nombre_cama"]</td>
     *  <td>Nombre de la cama</td>
     *  <td>string</td>
     * </tr>
     * </table>
     * 
     * @return string Mensaje de cama liberada
     * 
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
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

