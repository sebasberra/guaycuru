<?php

namespace RI\RIWebServicesBundle\Utils\ConfiguracionEdilicia;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;

use Doctrine\ORM\NoResultException;


trait ConfiguracionEdiliciaSync{

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
            
        
        } catch (NoResultException $nre) {

            $this->agregarSala($sala);

            return;
                
        } catch (\Exception $e){
            
            throw $e;
        }
        
    }
    
    
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
                        
        
        } catch (NoResultException $nre) {

            $this->agregarHabitacion($habitacion);

            return;
                
        } catch (\Exception $e){
            
            throw $e;
        }
                
    }
    
    
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
                        
        
        } catch (NoResultException $nre) {

            $this->agregarCama($cama);

            return;
                
        } catch (\Exception $e){
            
            throw $e;
        }
        
    }
    
    
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
}