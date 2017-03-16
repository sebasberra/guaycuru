<?php

namespace RI\RIWebServicesBundle\Utils\ConfiguracionEdilicia;


use RI\RIWebServicesBundle\Utils\RI\RI;


trait ConfiguracionEdiliciaSalas{
    
    public function agregarSala($nueva_sala){
        
        
                        
        // objeto Habitaciones doctrine
        $sala = new Salas();
        
        
        // area_cod_servicio
        $sala->setAreaCodServicio($nueva_sala["area_cod_servicio"]);
        
        // areaEfectorServicio
        $sala->setAreaEfectorServicio($nueva_sala["area_id_efector_servicio"]);
        
        // area_sector
        $sala->setSector($nueva_sala["area_sector"]);
        
        // area_subsector
        $sala->setSubsector($nueva_sala["area_subsector"]);
        
        // cant_camas
        $sala->setCantCamas(0);
        
        // fecha modificacion [timestamp]
        $sala->setFechaModificacion(null);
        
        // id_efector
        $sala->setIdEfector($nueva_sala["id_efector"]);
         
        // mover_camas
        $sala->setMoverCamas($nueva_sala["mover_camas"]);
        
        // nombre sala
        $sala->setNombre($nueva_sala["nombre_sala"]);
        
        
        // begintrans
        RI::$conn->beginTransaction();
        
        
        try{
            
            
            // nro_sala
            $nro_sala = 
                RI::$doctrine->getRepository
                    ('DBHmi2GuaycuruCamasBundle:Salas')
                    ->getProximoNroSala($nueva_sala["id_efector"]);
            
            if ($nro_sala<=0){
            
                RI::$error_debug .=
                    "No se pudo recuperar el próximo nro de sala en el "
                    ." efector. La función servicios_get_proximo_nro_sala "
                    ." ("
                    .$nueva_sala["id_efector"]
                    .") devolvió: "
                    .$nro_sala;
            
                $msg = "Error al recupar el próximo nro de sala del efector: "
                        .$nueva_sala["id_efector"];
                
                // rollback
                RI::$conn->rollBack();

                throw new \Exception($msg);
            
            }
            
            $sala->setNroSala($nro_sala);
            
            
            // id_sala
            $id_sala = 
                RI::$doctrine->getRepository
                    ('DBHmi2GuaycuruCamasBundle:Salas')
                    ->getProximoIdSala($nueva_sala["id_efector"]);
            
            if ($nro_sala<=0){
            
                RI::$error_debug .=
                    "No se pudo recuperar el próximo id de sala en el "
                    ." efector. La función servicios_get_proximo_id_sala "
                    ." ("
                    .$nueva_sala["id_efector"]
                    .") devolvió: "
                    .$id_sala;
            
                $msg = "Error al recupar el próximo id de sala del efector: "
                        .$nueva_sala["id_efector"];
                
                // rollback
                RI::$conn->rollBack();

                throw new \Exception($msg);
            
            }
            
            $sala->setIdSala($id_sala);
        
        
            // validacion assert
            $this->validacionAssert($sala);
    
        
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
                .$nueva_sala["id_efector"];
        
        
        return $msg;
        
    }
    
    
    public function modificarSala($modif_sala){
    
        // sala
        try {
        
            $sala =
                    RIUtiles::geSala(
                            $modif_sala["nombre_sala"],
                            $modif_sala["id_efector"]
                            );
            
        } catch (\Exception $e) {

            throw $e;
            
        }
        
        
        // baja actual
        $baja_actual = $sala->getBaja();
        
        // baja_nueva
        $baja_nueva = RIUtiles::wrapBoolean($modif_sala["baja"]);
        
        $sala->setBaja($baja_nueva);
                
        // area_cod_servicio
        $sala->setAreaCodServicio($modif_sala["area_cod_servicio"]);
        
        // areaEfectorServicio
        $sala->setAreaEfectorServicio($modif_sala["area_id_efector_servicio"]);
        
        // area_sector
        $sala->setSector($modif_sala["area_sector"]);
        
        // area_subsector
        $sala->setSubsector($modif_sala["area_subsector"]);
        
        // timestamp fecha modificacion
        $sala->setFechaModificacion(null);
        
        // mover_camas
        $sala->setMoverCamas($modif_sala["mover_camas"]);
        
        // validacion assert
        $this->validacionAssert($sala);
    
        
        // begintrans
        RI::$conn->beginTransaction();
        
        try{
        
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
                $this->setCantCamasSala($sala->getIdSala());

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
    
    public function eliminarSala($elimina_sala){
        
        // sala
        try {
        
            $sala =
                    RIUtiles::geSala(
                            $elimina_sala["nombre_sala"],
                            $elimina_sala["id_efector"]
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
                    ('DBHmi2GuaycuruCamasBundle:Salas')
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
                $this->setCantCamasSala($sala->getIdSala());
                
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
                .$sala->getIdEfector()->getNombre();
                
        return $msg;
        
    }
}