<?php

namespace RI\RIWebServicesBundle\Utils\ConfiguracionEdilicia;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;

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
class ConfiguracionEdilicia extends RI
{
    
    use 
        ConfiguracionEdiliciaCamas,
        ConfiguracionEdiliciaHabitaciones,
        ConfiguracionEdiliciaSalas;
            
    
    
    
    
    private function setCantCamasHab($habitacion){
        
        
        // count camas habitacion
        $count = 
            RI::$doctrine->getRepository
                ('DBHmi2GuaycuruCamasBundle:Habitaciones')
                ->countCamas($habitacion->getIdHabitacion());
        
        // cant camas
        $habitacion->setCantCamas($count);
        
        // validacion assert
        RIUtiles::validacionAssert($habitacion);
        
        RI::$em->persist($habitacion);
        RI::$em->flush();
        
    }
    
    private function setCantCamasSala($sala){
        
        // count camas salas
        $count = 
            RI::$doctrine->getRepository
                ('DBHmi2GuaycuruCamasBundle:Salas')
                ->countCamas($sala->getIdSala());
        
        // cant camas
        $sala->setCantCamas($count);
        
        
        // validacion assert
        RIUtiles::validacionAssert($sala);
        
        RI::$em->persist($sala);
        RI::$em->flush();
        
    }
    
    
    private function setCantCamasHabSala($id_sala){
        
        
        // habitaciones de la sala
        $habitaciones = 
            RI::$doctrine->getRepository
                ('DBHmi2GuaycuruCamasBundle:Habitaciones')
                ->findByIdSala($id_sala);

        foreach($habitaciones as $habitacion) {

            $this->setCantCamasHab($habitacion->getIdHabitacion());

        }
                
    }
    
    
    private function setBajaCamasHabitacion(
            $id_habitacion,
            $baja){
        
        // baja cama de la habitacion
        $camas = 
            RI::$doctrine->getRepository
                ('DBHmi2GuaycuruCamasBundle:Camas')
                ->findByIdHabitacion($id_habitacion);

        foreach($camas as $cama) {

            // cama baja
            $cama->setBaja($baja);

            if ($baja){
                
                // estado = 'F' (fuera de servicio)
                $cama->setEstado('F');

            }else{
                
                // estado = 'L' (libre)
                $cama->setEstado('L');
                
            }
            
            // validacion assert
            RIUtiles::validacionAssert($cama);
            
            RI::$em->persist($cama);

        }
        
        RI::$em->flush();
        
    }
    
    
    private function setBajaCamasSala(
            $id_sala,
            $baja){
        
        // baja cama de la sala
        $camas = 
            RI::$doctrine->getRepository
                ('DBHmi2GuaycuruCamasBundle:Camas')
                ->findByIdSala($id_sala);

        foreach($camas as $cama) {

            // cama baja 
            $cama->setBaja($baja);

            if ($baja){
                
                // estado = 'F' (fuera de servicio)
                $cama->setEstado('F');

            }else{
                
                // estado = 'L' (libre)
                $cama->setEstado('L');
                
            }
            
            // validacion assert
            RIUtiles::validacionAssert($cama);
            
            RI::$em->persist($cama);

        }
        
        RI::$em->flush();
        
    }
        
    
    private function setBajaHabitacionesSala(
            $id_sala,
            $baja){
        
        // habitaciones de la sala
        $habitaciones = 
            RI::$doctrine->getRepository
                ('DBHmi2GuaycuruCamasBundle:Habitaciones')
                ->findByIdSala($id_sala);

        foreach($habitaciones as $habitacion) {

            // habitacion baja 
            $habitacion->setBaja($baja);

            // validacion assert
            RIUtiles::validacionAssert($habitacion);
            
            RI::$em->persist($habitacion);

        }
        
        RI::$em->flush();
        
    }
    
            
}

