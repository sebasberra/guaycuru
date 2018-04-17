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

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;

use RI\DBHmi2GuaycuruCamasBundle\Exception\NoResultExceptionCama;
use RI\DBHmi2GuaycuruCamasBundle\Exception\NoResultExceptionHabitacion;
use RI\DBHmi2GuaycuruCamasBundle\Exception\NoResultExceptionSala;


/**
 * **Realiza las operaciones de Inicialización y Sincronización de la Configuración Edilicia**
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
 * @see RI\DBHmi2GuaycuruCamasBundle\Entity\Salas
 * @see RI\DBHmi2GuaycuruCamasBundle\Entity\Habitaciones
 * @see RI\DBHmi2GuaycuruCamasBundle\Entity\Camas
 */
trait ConfiguracionEdiliciaSync{

    /**
     * **Actualiza en la base centralizada el registro de la sala pasada como parámetro**
     * 
     * - Si la sala **NO** existe entonces la agrega a la base
     * - Si la sala **existe** sólo actualiza el registro si hay cambio en los campos:
     * 
     * <blockquote>
     * <p>
     * </p>
     * <table style="border-style: dashed;">
     *  <tr><td style="border-style: none; text-align:left">mover_camas</td></tr>
     *  <tr><td style="border-style: none; text-align:left">baja</td></tr>
     * </table>
     * </blockquote>
     * 
     * @see ConfiguracionEdiliciaSalas 
     * 
     * @param array $sala Ver los métodos **agregarSala()** y **modificarSala()**
     * 
     * @return void Si la función terminó bien no devuelve valor
     * 
     * @throws \Exception Las excepciones son capturadas y relanzadas
     * 
     */
    public function refreshAgregarModificarSala($sala){
        
        try{
        
            $sala_db = RIUtiles::getSalaPorNombre(
                    $sala['nombre_sala'], 
                    $sala['id_efector']
                    );
            
            // check de cambio de datos
            if ($sala_db->getMoverCamas()<>$sala['mover_camas'] ||
                $sala_db->getBaja()<>$sala['baja']){
            
                $this->modificarSala($sala);
                
            }
            
        
        } catch (NoResultExceptionSala $nres) {

            $this->agregarSala($sala);

            return;
                
        } catch (\Exception $e){
            
            throw $e;
        }
        
    }
    
    
    /**
     * **Actualiza en la base centralizada el registro de la habitación pasada como parámetro**
     * 
     * - Si la habitación **NO** existe entonces la agrega a la base
     * - Si la habitación **existe** sólo actualiza el registro si hay cambio en los campos:
     * 
     * <blockquote>
     * <p>
     * </p>
     * <table style="border-style: dashed;">
     *  <tr><td style="border-style: none; text-align:left">sexo</td></tr>
     *  <tr><td style="border-style: none; text-align:left">edad_desde</td></tr>
     *  <tr><td style="border-style: none; text-align:left">edad_hasta</td></tr>
     *  <tr><td style="border-style: none; text-align:left">tipo_edad</td></tr>
     *  <tr><td style="border-style: none; text-align:left">baja</td></tr>
     * </table>
     * </blockquote>
     * 
     * @see ConfiguracionEdiliciaHabitaciones 
     * 
     * @param array $habitacion Ver los métodos **agregarHabitacion()** y **modificarHabitacion()**
     * 
     * @return void Si la función terminó bien no devuelve valor
     * 
     * @throws \Exception Las excepciones son capturadas y relanzadas
     * 
     */
    public function refreshAgregarModificarHabitacion($habitacion){
    
        try{
        
            $habitacion_db = RIUtiles::getHabitacion(
                    $habitacion['nombre_habitacion'], 
                    $habitacion['nombre_sala'], 
                    $habitacion['id_efector']
                    );
            
            // agrega check de cambio de datos
            if ($habitacion_db->getSexo()<>$habitacion['sexo'] ||
                $habitacion_db->getEdadDesde()<>$habitacion['edad_desde'] ||
                $habitacion_db->getEdadHasta()<>$habitacion['edad_hasta'] ||
                $habitacion_db->getTipoEdad()<>$habitacion['tipo_edad'] ||
                $habitacion_db->getBaja()<>$habitacion['baja']){
            
                $this->modificarHabitacion($habitacion);
                
            }        
                        
        
        } catch (NoResultExceptionHabitacion $nreh) {

            $this->agregarHabitacion($habitacion);

            return;
                
        } catch (\Exception $e){
            
            throw $e;
        }
                
    }
    
    
    /**
     * **Actualiza en la base centralizada el registro de la cama pasada como parámetro**
     * 
     * - Si la cama **NO** existe entonces la agrega a la base
     * - Si la cama **existe** sólo actualiza el registro si hay cambio en los campos:
     * 
     * <blockquote>
     * <p>
     * </p>
     * <table style="border-style: dashed;">
     *  <tr><td style="border-style: none; text-align:left">id_clasificacion_cama</td></tr>
     *  <tr><td style="border-style: none; text-align:left">id_habitacion</td></tr>
     *  <tr><td style="border-style: none; text-align:left">estado</td></tr>
     *  <tr><td style="border-style: none; text-align:left">rotativa</td></tr>
     *  <tr><td style="border-style: none; text-align:left">baja</td></tr>
     * </table>
     * </blockquote>
     * 
     * @see ConfiguracionEdiliciaCamas 
     * 
     * @param array $cama Ver los métodos **agregarCama()** y **modificarCama()**
     * 
     * @return void Si la función terminó bien no devuelve valor
     * 
     * @throws \Exception Las excepciones son capturadas y relanzadas
     * 
     */
    public function refreshAgregarModificarCama($cama){
        
    
        try{
        
            $cama_db = RIUtiles::getCama(
                    $cama['nombre_cama'], 
                    $cama['id_efector']
                    ); 
            
            // agrega check de cambio de datos
            if ($cama_db->getIdHabitacion()->getIdSala()->getNombre()<>$cama['nombre_sala'] ||
                $cama_db->getIdClasificacionCama()->getIdClasificacionCama()<>$cama['id_clasificacion_cama'] ||
                $cama_db->getEstado()<>$cama['estado'] ||
                $cama_db->isRotativa()<>$cama['rotativa'] ||
                $cama_db->isBaja()<>$cama['baja']){
            
                $this->modificarCama($cama);
                
            }
                        
        
        } catch (NoResultExceptionCama $nrec) {

            $this->agregarCama($cama);

            return;
                
        } catch (\Exception $e){
            
            throw $e;
        }
        
    }
    
    /**
     * **Recorre el arreglo de camas pasado como parámetro y va eliminando de la
     * base centralizada las camas que no estén en dicho arreglo**
     * 
     * @see ConfiguracionEdiliciaCamas 
     * 
     * @param array $infcamas Es un arreglo del tipo arreglo:
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
     * @return void Si la función terminó bien no devuelve valor
     * 
     * @throws \Exception Las excepciones son capturadas y relanzadas
     * 
     */
    public function refreshEliminarCamas($infcamas){
        
        try {
            
        
            $camas = RI::$doctrine->getRepository
                            (RIUtiles::DB_BUNDLE.':Camas')
                    ->findByIdEfector($infcamas[0]['id_efector']);

            // bucle camas db centralizada
            foreach ($camas as $cama){

                $flag_eliminar=true;

                // busca cama en el informe
                foreach ($infcamas as $infcama){

                    if ($cama->getNombre()==$infcama['nombre_cama']){
                        $flag_eliminar=false;
                    }
                }

                if ($flag_eliminar){

                    $this->eliminarCama(
                            array(
                                'nombre_cama'=>$cama->getNombre(),
                                'id_efector'=>$infcamas[0]['id_efector']
                            )
                        );
                }
                
            }
            
        } catch (\Exception $e){
            
            RI::$error_debug .= 
                    ' Función refreshEliminarCamas. Msg: '
                    .$e->getMessage();
            
            throw $e;
        }
        
        return;
    }
    
    
    /**
     * **Recorre el arreglo de habitaciones pasado como parámetro y va eliminando de la
     * base centralizada las habitaciones que no estén en dicho arreglo**
     * 
     * @see ConfiguracionEdiliciaHabitaciones 
     * 
     * @param array $infhabs Es un arreglo del tipo arreglo:
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
     * 
     * @return void Si la función terminó bien no devuelve valor
     * 
     * @throws \Exception Las excepciones son capturadas y relanzadas
     * 
     */
    public function refreshEliminarHab($infhabs){
        
        try {
            
        
            $habitaciones = RI::$doctrine->getRepository
                            (RIUtiles::DB_BUNDLE.':Habitaciones')
                    ->findByIdEfectorConAsociaciones($infhabs[0]['id_efector']);

            // bucle habitaciones db centralizada
            foreach ($habitaciones as $habitacion){

                $flag_eliminar=true;

                // busca hab en el informe
                foreach ($infhabs as $infhab){

                    if ($habitacion->getNombre() == $infhab['nombre_habitacion'] && 
                        $habitacion->getIdSala()->getNombre() == $infhab['nombre_sala']){
                        
                        $flag_eliminar=false;
                    }
                }

                if ($flag_eliminar){

                    $this->eliminarHabitacion(
                            array(
                                'nombre_habitacion'=>$habitacion->getNombre(),
                                'nombre_sala'=>$habitacion->getIdSala()->getNombre(),
                                'id_efector'=>$infhabs[0]['id_efector']
                            )
                        );
                }
                
            }
            
        } catch (\Exception $e){

            RI::$error_debug .= 
                    ' Función refreshEliminarHab. Msg: '
                    .$e->getMessage();
            
            throw $e;
        }
        
        return;
    }
    
    
    /**
     * **Recorre el arreglo de salas pasado como parámetro y va eliminando de la
     * base centralizada las salas que no estén en dicho arreglo**
     * 
     * @see ConfiguracionEdiliciaSalas 
     * 
     * @param array $infsalas Es un arreglo del tipo arreglo:
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
     * 
     * @return void Si la función terminó bien no devuelve valor
     * 
     * @throws \Exception Las excepciones son capturadas y relanzadas
     * 
     */
    public function refreshEliminarSalas($infsalas){
        
        try {
            
        
            $salas = RI::$doctrine->getRepository
                            (RIUtiles::DB_BUNDLE.':Salas')
                    ->findByIdEfector($infsalas[0]['id_efector']);

            // bucle salas db centralizada
            foreach ($salas as $sala){

                $flag_eliminar=true;

                // busca sala en el informe
                foreach ($infsalas as $infsala){

                    if ($sala->getNombre() == $infsala['nombre_sala']){
                        
                        $flag_eliminar=false;
                    }
                }

                if ($flag_eliminar){

                    $this->eliminarSala(
                            array(
                                'nombre_sala'=>$sala->getNombre(),
                                'id_efector'=>$infsalas[0]['id_efector']
                            )
                        );
                }
                
            }
            
        } catch (\Exception $e){
            
            RI::$error_debug .= 
                    ' Función refreshEliminarSala. Msg: '
                    .$e->getMessage();
            
            throw $e;
        }
        
        return;
    }
    
    /**
     * **Recorre todas las salas y habitaciones refrescando la cantidad de 
     * camas**
     * 
     * @param integer $id_efector Efector al cual se actualizarán 
     * las cantidades de camas
     * 
     * @return void Si la función terminó bien no devuelve valor
     * 
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
    public function refreshCantCamasEfector($id_efector){
        
        try{
            
            // actualiza cant camas efector
            $this->setCantCamasEfector($id_efector);
        
        } catch (\Exception $e){
            
            RI::$error_debug .= 
                    ' Función refreshCantCamasEfector. Msg: '
                    .$e->getMessage();
            
            throw $e;
        }
        
        return;
    }
    
    /**
     * **Actualiza la fecha/hora de sincronización de los datos del efector
     * con la fecha/hora actual**
     * 
     * @param integer $id_efector Efector al cual se actualizará la fecha/hora
     * 
     * @return void Si la función terminó bien no devuelve valor
     * 
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
    public function actualizarFechaHoraSincro($id_efector){
        
        try{
            
            // actualiza fecha/hora sync
            $configuracion_sistema =
                    RI::$doctrine
                        ->getRepository
                            (RIUtiles::DB_BUNDLE.':ConfiguracionesSistemas')
                        ->findOneByIdEfector($id_efector);
            $configuracion_sistema->setFechaHoraSincro(new \DateTime);

            // validacion assert
            RIUtiles::validacionAssert($configuracion_sistema);

            // insert datos en la DB
            RI::$em->persist($configuracion_sistema);
            RI::$em->flush();
        
        } catch (\Exception $e){
            
            RI::$error_debug .= 
                    ' Función actualizarFechaHoraSincro. Msg: '
                    .$e->getMessage();
            
            throw $e;
        }
        
        return;
    }
}