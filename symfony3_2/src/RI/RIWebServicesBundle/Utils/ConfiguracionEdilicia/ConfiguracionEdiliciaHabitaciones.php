<?php

namespace RI\RIWebServicesBundle\Utils\ConfiguracionEdilicia;

use RI\DBHmi2GuaycuruCamasBundle\Entity\Habitaciones;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;


trait ConfiguracionEdiliciaHabitaciones{
    
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
    
        
        // begintrans
        RI::$conn->beginTransaction();
        
        try{
        
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
    
        
        // begintrans
        RI::$conn->beginTransaction();
        
        try{
        
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
    
    
    /** Elimina la habitacion de base de datos, la
     *  baja se implementa como modificacion
     * 
     * @param type $elimina_hab
     * @return string
     * @throws \Exception
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
        
        
        
        // begintrans
        RI::$conn->beginTransaction();
        
        try{
            
        
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