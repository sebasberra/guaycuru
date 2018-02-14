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

use RI\DBHmi2GuaycuruCamasBundle\Entity\Habitaciones;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;

/**
 * **Realiza las operaciones de ABM de Habitaciones**
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
 * @see RI\DBHmi2GuaycuruCamasBundle\Entity\Habitaciones
 * 
 */
trait ConfiguracionEdiliciaHabitaciones{
    
    /** 
     * **Agrega una habitación a la base centralizada**
     * 
     * @param array $nueva_hab
     *  
     * <table cellpadding="0" cellspacing="0" border="1" style="border-style: solid; border-color: #cccccc #cccccc;">
     * <tr>
     *  <td>["id_efector"]</td>
     *  <td>ID efector donde pertenece la habitación</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["nombre_sala"]</td>
     *  <td>Nombre de la sala donde pertenece la habitación.
     *      NOTA: se busca el id_sala en base central por nombre</td>
     *  <td>string</td>
     * </tr>
     * <tr>
     *  <td>["nombre_habitacion"]</td>
     *  <td>Nombre de habitación de la nueva habitación
     *  <td>string</td>
     * </tr>
     * 
     * <tr>
     *  <td>["sexo"]</td>
     *  <td>1=masculino, 2=femenino, 3=mixto</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["edad_desde"]</td>
     *  <td>0 a 255. NOTA: Cuando es cero no se valida el límite</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["edad_hasta"]</td>
     *  <td>0 a 255. NOTA: Cuando es 255 no se valida el límite</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["tipo_edad"]</td>
     *  <td>1=años, 2=meses, 3=días, 4=horas, 5=minutos, 6=se ignora</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["baja"]</td>
     *  <td>0 = habilitada; 1 = baja</td>
     *  <td>integer</td>
     * </tr>
     * </table>
     * @return string Mensaje de habitación ingresada
     * 
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
    public function agregarHabitacion($nueva_hab){
        
        
        // sala
        try {
        
            $sala =
                    RIUtiles::getSalaPorNombre(
                            $nueva_hab["nombre_sala"],
                            $nueva_hab["id_efector"]
                            );
            
        } catch (\Exception $e) {

            throw $e;
            
        }
        
                
        // objeto Habitaciones doctrine
        $habitacion = new Habitaciones();
        
        
        // baja
        $habitacion->setBaja(RIUtiles::wrapBoolean($nueva_hab["baja"]));
        
        // sexo
        $habitacion->setSexo($nueva_hab["sexo"]);
        
        // edad_desde
        $habitacion->setEdadDesde($nueva_hab["edad_desde"]);
        
        // edad_hasta
        $habitacion->setEdadHasta($nueva_hab["edad_hasta"]);
        
        // tipo_edad
        $habitacion->setTipoEdad($nueva_hab["tipo_edad"]);

        // cant_camas
        $habitacion->setCantCamas(0);
        
        // timestamp fecha modificacion
        $habitacion->setFechaModificacion(null);
        
        // sala
        $habitacion->setIdSala($sala);
        
        // nombre de habitacion
        $habitacion->setNombre($nueva_hab["nombre_habitacion"]);
        
        
        // validacion assert
        RIUtiles::validacionAssert($habitacion);
    
        
        try{
    
            // begintrans
            RI::$conn->beginTransaction();
        
            // insert datos en la DB
            RI::$em->persist($habitacion);
            RI::$em->flush();

            // commit
            RI::$conn->commit();
            
        } catch (\Exception $e) {

            // rollback
            RI::$conn->rollBack();
            
            throw $e;
            
        }
        
        
        $msg = "La habitación: ".$nueva_hab["nombre_habitacion"]
                ." fue ingresada en la sala: "
                .$sala->getNombre()
                ." del efector: "
                .$sala->getIdEfector()->getNomEfector();
        
        
        return $msg;
        
    }
    
    
    /** 
     * **Modifica una habitación en la base centralizada**
     * 
     * La modificación de habitación se aplica a
     * 
     * <table style="border-style: dashed;">
     *  <tr><td style="border-style: none; text-align:left">sexo</td></tr>
     *  <tr><td style="border-style: none; text-align:left">edad_desde</td></tr>
     *  <tr><td style="border-style: none; text-align:left">edad_hasta</td></tr>
     *  <tr><td style="border-style: none; text-align:left">tipo_edad</td></tr>
     *  <tr><td style="border-style: none; text-align:left">baja</td></tr>
     * </table>
     * 
     *  *NOTA: El id de habitación se busca en la base centralizada a partir de la combinacion de los parámetros [id_efector-nombre_sala-nombre_habitacion]*
     *  
     * @param array $modif_hab
     *  
     * <table cellpadding="0" cellspacing="0" border="1" style="border-style: solid; border-color: #cccccc #cccccc;">
     * <tr>
     *  <td>["id_efector"]</td>
     *  <td>ID efector donde pertenece la habitación</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["nombre_sala"]</td>
     *  <td>Nombre de la sala donde pertenece la habitación</td>
     *  <td>string</td>
     * </tr>
     * <tr>
     *  <td>["nombre_habitacion"]</td>
     *  <td>Nombre de habitación a modificar
     *  <td>string</td>
     * </tr>
     * 
     * <tr>
     *  <td>["sexo"]</td>
     *  <td>1=masculino, 2=femenino, 3=mixto</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["edad_desde"]</td>
     *  <td>0 a 255. NOTA: Cuando es cero no se valida el límite</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["edad_hasta"]</td>
     *  <td>0 a 255. NOTA: Cuando es 255 no se valida el límite</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["tipo_edad"]</td>
     *  <td>1=años, 2=meses, 3=días, 4=horas, 5=minutos, 6=se ignora</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["baja"]</td>
     *  <td>0 = habilitada; 1 = baja</td>
     *  <td>integer</td>
     * </tr>
     * </table>
     * 
     * @return string Mensaje de habitación modificada
     * 
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
    public function modificarHabitacion($modif_hab){
        
        // habitacion
        try {
        
            $habitacion =
                    RIUtiles::getHabitacion(
                            $modif_hab["nombre_habitacion"],
                            $modif_hab["nombre_sala"],
                            $modif_hab["id_efector"]
                            );
            
        } catch (\Exception $e) {

            throw $e;
            
        }
        
        
        // baja actual
        $baja_actual = $habitacion->getBaja();
        
        // baja_nueva
        $baja_nueva = RIUtiles::wrapBoolean($modif_hab["baja"]);
        
        $habitacion->setBaja($baja_nueva);
                
        // sexo
        $habitacion->setSexo($modif_hab["sexo"]);
        
        // edad_desde
        $habitacion->setEdadDesde($modif_hab["edad_desde"]);
        
        // edad_hasta
        $habitacion->setEdadHasta($modif_hab["edad_hasta"]);
        
        // tipo_edad
        $habitacion->setTipoEdad($modif_hab["tipo_edad"]);
        
        // timestamp fecha modificacion
        $habitacion->setFechaModificacion(null);
        
        
        // validacion assert
        RIUtiles::validacionAssert($habitacion);
    
        
        try{
    
            // begintrans
            RI::$conn->beginTransaction();
        
            // update datos en la DB
            RI::$em->persist($habitacion);
            RI::$em->flush();
            
            
            // check actualiza cant camas de habitacion y sala
            if ($baja_nueva != $baja_actual){

                // baja o alta a las camas de la habitacion
                if ($baja_nueva){
                
                    // baja camas
                    $this->setBajaCamasHabitacion(
                            $habitacion->getIdHabitacion(),
                            true);
                    
                }else{
                    
                    // alta camas
                    $this->setBajaCamasHabitacion(
                            $habitacion->getIdHabitacion(),
                            false);
                } 
             
                // cant_camas habitacion
                $this->setCantCamasHab($habitacion);

                // cant_camas sala
                $this->setCantCamasSala($habitacion->getIdSala());

            }
            
            // commit
            RI::$conn->commit();
            
        } catch (\Exception $e) {

            RI::$error_debug .=
                    "Error al modificar la habitación: "
                    .$modif_hab["nombre_habitacion"];
            
            // rollback
            RI::$conn->rollBack();
            
            throw $e;
            
        }
        
        
        $msg = "La habitación: "
                .$modif_hab["nombre_habitacion"]
                ." de la sala: "
                .$modif_hab["nombre_sala"]
                ." fue modificada en el efector: "
                .$habitacion->getIdSala()->getIdEfector()->getNomEfector();
        
        
        return $msg;
        
    }
    
    
    /** 
     * **Elimina una habitación de la base centralizada**
     * 
     * *NOTA: Elimina la habitación usando DELETE, la baja se hace
     * a través de la modificación de habitación*
     * 
     * @param array $elimina_hab
     *  
     * <table cellpadding="0" cellspacing="0" border="1" style="border-style: solid; border-color: #cccccc #cccccc;">
     * <tr>
     *  <td>["id_efector"]</td>
     *  <td>ID efector donde pertenece la habitación</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["nombre_sala"]</td>
     *  <td>Nombre de la sala donde pertenece la habitación</td>
     *  <td>string</td>
     * </tr>
     * <tr>
     *  <td>["nombre_habitacion"]</td>
     *  <td>Nombre de habitación a eliminar
     *  <td>string</td>
     * </tr>
     * </table>
     * 
     * @return string Mensaje de habitación eliminada
     * 
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
    public function eliminarHabitacion($elimina_hab){
        
        // habitacion
        try {
            
            $habitacion = 
                    RIUtiles::getHabitacion(
                            $elimina_hab["nombre_habitacion"],
                            $elimina_hab["nombre_sala"], 
                            $elimina_hab["id_efector"]
                            );
            
        } catch (\Exception $e) {
            
            throw $e;

        }
        
        
        try{
            
            // begintrans
            RI::$conn->beginTransaction();
            
            // count camas habitacion
            $count = 
                RI::$doctrine->getRepository
                    (RIUtiles::DB_BUNDLE.':Habitaciones')
                    ->countCamasTodas(
                            $habitacion->getIdHabitacion());
            
            if ($count==0){
            
                // elimina la habitacion
                RI::$em->remove($habitacion);
                                    
            }else{
                
                // set baja = true
                $habitacion->setBaja(true);
                
                // baja camas de la habitacion
                $this->setBajaCamasHabitacion(
                        $habitacion->getIdHabitacion(),
                        true);
                
                // cant_camas habitacion
                $this->setCantCamasHab($habitacion);

                // cant_camas sala
                $this->setCantCamasSala($habitacion->getIdSala());
                
            }

            // flush habitacion
            RI::$em->flush();            
            
            // commit
            RI::$conn->commit();
            
        }catch(\Exception $e){
            
            RI::$error_debug .=
                    "Error al eliminar/baja la habitación: "
                    .$elimina_hab["nombre_habitacion"];
            
            // rollback
            RI::$conn->rollBack();
            
            throw $e;
            
        }
        
        $msg = "La habitación: "
                .$elimina_hab["nombre_habitacion"]
                ." fue eliminada/baja de la sala: "
                .$habitacion->getIdSala()->getNombre()
                ." del efector: "
                .$habitacion->getIdSala()->getIdEfector()->getNomEfector();
                
        return $msg;
        
    }
    
}