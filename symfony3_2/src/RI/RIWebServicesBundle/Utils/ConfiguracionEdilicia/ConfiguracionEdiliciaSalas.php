<?php

namespace RI\RIWebServicesBundle\Utils\ConfiguracionEdilicia;

use RI\DBHmi2GuaycuruCamasBundle\Entity\Salas;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;


trait ConfiguracionEdiliciaSalas{
    
    public function agregarSala($nueva_sala){
        
        
        
        try{
            
            // get efector
            $efector = RIUtiles::getEfector($nueva_sala['id_efector']);
        
            // check area
            if ($nueva_sala['area_cod_servicio']!=-1){

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
        
//        dump($sala);die();
        
        // begintrans
        RI::$conn->beginTransaction();
        
        
        try{
            
            
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
    
    
    public function modificarSala($modif_sala){
    
        // sala
        try {
        
            $sala =
                    RIUtiles::getSalaPorNombre(
                            $modif_sala["nombre_sala"],
                            $modif_sala["id_efector"]
                            );
            
        
            // check area
            if ($modif_sala['area_cod_servicio']!=-1){

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
            
            RI::$error_debug .= " Función agregarSala";
            
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
    
    public function eliminarSala($elimina_sala){
        
        // sala
        try {
        
            $sala =
                    RIUtiles::getSalaPorNombre(
                            $elimina_sala["nombre_sala"],
                            $elimina_sala["id_efector"]
                            );
            
            // begintrans
            RI::$conn->beginTransaction();
        
        
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