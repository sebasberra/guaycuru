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

use RI\DBHmi2GuaycuruCamasBundle\Entity\Salas;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;

/**
 * **Realiza las operaciones de ABM de Salas**
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
 * @see RI\DBHmi2GuaycuruCamasBundle\Entity\Salas
 * 
 */
trait ConfiguracionEdiliciaSalas{
    
    
    /** 
     * **Agrega una sala a la base centralizada**
     * 
     * @param array $nueva_sala
     *  
     * <table cellpadding="0" cellspacing="0" border="1" style="border-style: solid; border-color: #cccccc #cccccc;">
     * <tr>
     *  <td>["id_efector"]</td>
     *  <td>ID efector donde pertenece la sala</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["nombre_sala"]</td>
     *  <td>Nombre de la sala</td>
     *  <td>string</td>
     * </tr>
     * <tr>
     *  <td>["area_cod_servicio"]</td>
     *  <td>*(Opcional)* Código de 3 dígitos del área (SIPES) o -1 </td>
     *  <td>string</td>
     * </tr>
     * 
     * <tr>
     *  <td>["area_sector"]</td>
     *  <td>*(Opcional)* Campo sector correspondiente al área (SIPES) (1=varones; 2=mujeres; 3=mixto; >3 mixto estudios, talleres, etc)</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["area_subsector"]</td>
     *  <td>*(Opcional)* Subsector correspondiente al área (SIPES) (4=internación; 5=CE; 6=atención domiciliaria)</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["mover_camas"]</td>
     *  <td>0 = No 1 = Si</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["baja"]</td>
     *  <td>0 = habilitada; 1 = baja</td>
     *  <td>integer</td>
     * </tr>
     * </table>
     * @return string Mensaje de sala ingresada
     * 
     * @throws \Exception Las excepciones son capturadas y relanzadas
     * 
     * @method agregarSala
     * 
     */
    public function agregarSala($nueva_sala){
        
        
        
        try{
            
            // get efector
            $efector = RIUtiles::getEfector($nueva_sala['id_efector']);
        
            // check area
            if (
                    $nueva_sala['area_cod_servicio']!=-1 &&
                    strtoupper($nueva_sala['area_cod_servicio'])!='NULL'){

                $area_efector_servicio = 
                        RIUtiles::getEfectorServicioCodigoEstadistica(
                                $nueva_sala['id_efector'], 
                                $nueva_sala['area_cod_servicio'], 
                                $nueva_sala['area_sector'], 
                                $nueva_sala['area_subsector']);

                $area_cod_servicio = $area_efector_servicio->getCodServicio();
                $area_sector = $area_efector_servicio->getSector();
                $area_subsector = $area_efector_servicio->getSubsector();

            }else{

                $area_efector_servicio = null;
                $area_cod_servicio = null;
                $area_sector = null;
                $area_subsector = null;

            }
        
        } catch (\Exception $e) {
            
            RI::$error_debug .= " Función agregarSala";
            
            throw $e;
            
        }
        
        
        // objeto Salas doctrine
        $sala = new Salas();
        
        
        // areaEfectorServicio
        $sala->setAreaEfectorServicio($area_efector_servicio);
        
        // area_cod_servicio
        $sala->setAreaCodServicio($area_cod_servicio);
        
        // area_sector
        $sala->setAreaSector($area_sector);
        
        // area_subsector
        $sala->setAreaSubsector($area_subsector);
        
        // cant_camas
        $sala->setCantCamas(0);
        
        // fecha modificacion [timestamp]
        $sala->setFechaModificacion(null);
        
        // id_efector
        $sala->setIdEfector($efector);
         
        // mover_camas
        $sala->setMoverCamas(RIUtiles::wrapBoolean($nueva_sala["mover_camas"]));
        
        // nombre sala
        $sala->setNombre($nueva_sala["nombre_sala"]);
        
        // baja
        $sala->setBaja(RIUtiles::wrapBoolean($nueva_sala["baja"]));
        
       
        
        try{
            
            // begintrans
            RI::$conn->beginTransaction();
        
            // nro_sala
            $nro_sala = 
                RI::$doctrine->getRepository
                    (RIUtiles::DB_BUNDLE.':Salas')
                    ->getProximoNroSala($efector->getIdEfector())
                    ['proximo_nro_sala'];
            
            
            if ($nro_sala<=0){
            
                RI::$error_debug .=
                    "No se pudo recuperar el próximo nro de sala en el "
                    ." efector. La función servicios_get_proximo_nro_sala "
                    ." ("
                    .$efector->getIdEfector()
                    .") devolvió: "
                    .$nro_sala;
            
                $msg = "Error al recupar el próximo nro de sala del efector: "
                        .$efector->getIdEfector();
                
                // rollback
                RI::$conn->rollBack();

                throw new \Exception($msg);
            
            }
            
            $sala->setNroSala($nro_sala);
            
            
            // id_sala
            $id_sala = 
                RI::$doctrine->getRepository
                    (RIUtiles::DB_BUNDLE.':Salas')
                    ->getProximoIdSala($efector->getIdEfector())
                    ['proximo_id_sala'];
            
            if ($id_sala<=0){
            
                RI::$error_debug .=
                    "No se pudo recuperar el próximo id de sala en el "
                    ." efector. La función servicios_get_proximo_id_sala "
                    ." ("
                    .$efector->getIdEfector()
                    .") devolvió: "
                    .$id_sala;
            
                $msg = "Error al recupar el próximo id de sala del efector: "
                        .$efector->getIdEfector();
                
                // rollback
                RI::$conn->rollBack();

                throw new \Exception($msg);
            
            }
            
            $sala->setIdSala($id_sala);
        
        
            // validacion assert
            RIUtiles::validacionAssert($sala);
    
        
            // insert datos en la DB
            RI::$em->persist($sala);
            RI::$em->flush();

            // commit
            RI::$conn->commit();
            
            
        } catch (\Exception $e) {

            // rollback
            RI::$conn->rollBack();
            
            throw $e;
            
        }
        
        
        $msg = "La sala: ".$nueva_sala["nombre_sala"]
                ." fue ingresada al efector: "
                .$efector->getIdEfector().". "
                ."El id de sala asignado es: "
                .$id_sala;
        
        
        return $msg;
        
    }
    
    
    /** 
     * **Modifica una sala en la base centralizada**
     * 
     * La modificación de sala se aplica a
     * 
     * <table style="border-style: dashed;">
     *  <tr><td style="border-style: none; text-align:left">area_cod_servicio</td></tr>
     *  <tr><td style="border-style: none; text-align:left">area_sector</td></tr>
     *  <tr><td style="border-style: none; text-align:left">area_subsector</td></tr>
     *  <tr><td style="border-style: none; text-align:left">mover_camas</td></tr>
     *  <tr><td style="border-style: none; text-align:left">baja</td></tr>
     * </table>
     * 
     *  *NOTA: El id de sala se busca en la base centralizada a partir de la combinacion de los parámetros [id_efector-nombre_sala]*
     *  
     * @param array $modif_sala
     * 
     * <table cellpadding="0" cellspacing="0" border="1" style="border-style: solid; border-color: #cccccc #cccccc;">
     * <tr>
     *  <td>["id_efector"]</td>
     *  <td>ID efector donde pertenece la sala</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["nombre_sala"]</td>
     *  <td>Nombre de la sala a modificar</td>
     *  <td>string</td>
     * </tr>
     * <tr>
     *  <td>["area_cod_servicio"]</td>
     *  <td>*(Opcional)* Código de 3 dígitos del área (SIPES) o -1 </td>
     *  <td>string</td>
     * </tr>
     * 
     * <tr>
     *  <td>["area_sector"]</td>
     *  <td>*(Opcional)* Campo sector correspondiente al área (SIPES) (1=varones; 2=mujeres; 3=mixto; >3 mixto estudios, talleres, etc)</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["area_subsector"]</td>
     *  <td>*(Opcional)* Subsector correspondiente al área (SIPES) (4=internación; 5=CE; 6=atención domiciliaria)</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["mover_camas"]</td>
     *  <td>0 = No 1 = Si</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["baja"]</td>
     *  <td>0 = habilitada; 1 = baja</td>
     *  <td>integer</td>
     * </tr>
     * </table>
     * 
     * @return string Mensaje de sala modificada
     * 
     * @throws \Exception Las excepciones son capturadas y relanzadas
     * 
     */
    public function modificarSala($modif_sala){
    
        // sala
        try {
        
            $sala =
                    RIUtiles::getSalaPorNombre(
                            $modif_sala["nombre_sala"],
                            $modif_sala["id_efector"]
                            );
            
        
            // check area
            if (
                    $modif_sala['area_cod_servicio']!=-1 &&
                    strtoupper($modif_sala['area_cod_servicio'])!='NULL'){

                $area_efector_servicio = 
                        RIUtiles::getEfectorServicioCodigoEstadistica(
                                $modif_sala['id_efector'], 
                                $modif_sala['area_cod_servicio'], 
                                $modif_sala['area_sector'], 
                                $modif_sala['area_subsector']);

                $area_cod_servicio = $area_efector_servicio->getCodServicio();
                $area_sector = $area_efector_servicio->getSector();
                $area_subsector = $area_efector_servicio->getSubsector();

            }else{

                $area_efector_servicio = null;
                $area_cod_servicio = null;
                $area_sector = null;
                $area_subsector = null;

            }
        
        } catch (\Exception $e) {
            
            RI::$error_debug .= " Función modificarSala";
            
            throw $e;
            
        }
        
        
        // baja actual
        $baja_actual = $sala->getBaja();
        
        // baja_nueva
        $baja_nueva = RIUtiles::wrapBoolean($modif_sala["baja"]);
        
        $sala->setBaja($baja_nueva);
                
        // areaEfectorServicio
        $sala->setAreaEfectorServicio($area_efector_servicio);
        
        // area_cod_servicio
        $sala->setAreaCodServicio($area_cod_servicio);
        
        // area_sector
        $sala->setAreaSector($area_sector);
        
        // area_subsector
        $sala->setAreaSubsector($area_subsector);
        
        // timestamp fecha modificacion
        $sala->setFechaModificacion(null);
        
        // mover_camas
        $sala->setMoverCamas(RIUtiles::wrapBoolean($modif_sala["mover_camas"]));
        
        // validacion assert
        RIUtiles::validacionAssert($sala);
    
        
        
        try{
        
            // begintrans
            RI::$conn->beginTransaction();
        
            // update datos en la DB
            RI::$em->persist($sala);
            RI::$em->flush();
            
            
            // check actualiza cant camas de habitacion y sala
            if ($baja_nueva != $baja_actual){

                // baja o alta a las camas de la habitacion
                if ($baja_nueva){
                
                    // baja habitaciones
                    $this->setBajaHabitacionesSala(
                            $sala->getIdSala(), 
                            true);
                    
                    // baja camas
                    $this->setBajaCamasSala(
                            $sala->getIdSala(),
                            true);
                    
                }else{
                    
                    // alta habitaciones
                    $this->setBajaHabitacionesSala(
                            $sala->getIdSala(), 
                            false);
                    
                    // alta camas
                    $this->setBajaCamasSala(
                            $sala->getIdSala(),
                            false);
                    
                } 
             
                // cant_camas habitaciones de la sala
                $this->setCantCamasHabSala($sala->getIdSala());
                
                // cant_camas sala
                $this->setCantCamasSala($sala);

            }
            
            // commit
            RI::$conn->commit();
            
        } catch (\Exception $e) {

            RI::$error_debug .=
                    "Error al modificar la sala: "
                    .$modif_sala["nombre_sala"]
                    ." En el efector: "
                    .$modif_sala["id_efector"];
            
            // rollback
            RI::$conn->rollBack();
            
            throw $e;
            
        }
        
        
        $msg = "La sala: "
                .$modif_sala["nombre_sala"]
                ." fue modificada en el efector: "
                .$sala->getIdEfector()->getNomEfector();
        
        
        return $msg;
        
    }
    
    
    /** 
     * **Elimina una sala de la base centralizada**
     * 
     * *NOTA: Elimina la habitación usando DELETE, la baja se hace
     * a través de la modificación de sala*
     * 
     * @param array $elimina_sala
     * 
     * <table cellpadding="0" cellspacing="0" border="1" style="border-style: solid; border-color: #cccccc #cccccc;">
     * <tr>
     *  <td>["id_efector"]</td>
     *  <td>ID efector donde pertenece la sala</td>
     *  <td>integer</td>
     * </tr>
     * <tr>
     *  <td>["nombre_sala"]</td>
     *  <td>Nombre de la sala a eliminar</td>
     *  <td>string</td>
     * </tr>
     * </table>
     * 
     * @return string Mensaje de sala eliminada
     * 
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
    public function eliminarSala($elimina_sala){
        
        // sala
        try {
        
            // begintrans
            RI::$conn->beginTransaction();
            
            $sala =
                    RIUtiles::getSalaPorNombre(
                            $elimina_sala["nombre_sala"],
                            $elimina_sala["id_efector"]
                            );
            
            // count camas salas
            $count = 
                RI::$doctrine->getRepository
                    (RIUtiles::DB_BUNDLE.':Salas')
                    ->countCamasTodas(
                            $sala->getIdSala());
            
            if ($count==0){
            
                // elimina la sala
                RI::$em->remove($sala);
                                    
            }else{
                
                
                // set baja = true
                $sala->setBaja(true);
                
                // baja habitaciones de la sala
                $this->setBajaHabitacionesSala(
                        $sala->getIdSala(),
                        true);
                
                // baja camas de la sala
                $this->setBajaCamasSala(
                        $sala->getIdSala(),
                        true);
                
                // cant_camas de las habitaciones de la sala
                $this->setCantCamasHabSala($sala->getIdSala());
                
                // cant_camas sala
                $this->setCantCamasSala($sala);
                
            }

            // flush habitacion
            RI::$em->flush();            
            
            // commit
            RI::$conn->commit();
            
        }catch(\Exception $e){
            
            RI::$error_debug .=
                    "Error al eliminar/baja la sala: "
                    .$elimina_sala["nombre_sala"]
                    ." del efector: "
                    .$elimina_sala["id_efector"];
            
            // rollback
            RI::$conn->rollBack();
            
            throw $e;
            
        }
        
        $msg = "La sala: "
                .$elimina_sala["nombre_sala"]
                ." fue eliminada/baja del efector: "
                .$sala->getIdEfector()->getNomEfector();
                
        return $msg;
        
    }
}