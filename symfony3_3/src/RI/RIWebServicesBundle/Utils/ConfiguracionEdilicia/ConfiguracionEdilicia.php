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

/** 
 * **Realiza los accesos a la base de datos para actualización de la configuracion edilicia.**
 * 
 * *NOTA: la sincronización entre la DB de los efectores y DB central no puede
 * ser completa en toda la estructura. Se define la restricción de nombre único
 * de cama por efector y debe implementarse en las bases de los hospitales . 
 * Se sugiere, pero no es una restricción, nombres únicos de habitación 
 * por efector.*
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
 * @see RI\DBHmi2GuaycuruCamasBundle\Entity\Camas
 * 
 * @see RI\DBHmi2GuaycuruCamasBundle\Entity\Habitaciones
 * 
 * @see RI\DBHmi2GuaycuruCamasBundle\Entity\Salas
 * 
 */
class ConfiguracionEdilicia extends RI
{
    
    use 
        ConfiguracionEdiliciaCamas,
        ConfiguracionEdiliciaHabitaciones,
        ConfiguracionEdiliciaSalas,
        ConfiguracionEdiliciaSync;
            
    
    /**
     * 
     * @param RI\DBHmi2GuaycuruCamasBundle\Entity\Habitaciones $habitacion
     */
    private function setCantCamasHab($habitacion){
        
        
        // count camas habitacion
        $count = 
            RI::$doctrine->getRepository
                (RIUtiles::DB_BUNDLE.':Habitaciones')
                ->countCamas($habitacion->getIdHabitacion(),false);
        
        // cant camas
        $habitacion->setCantCamas($count);
        
        // validacion assert
        RIUtiles::validacionAssert($habitacion);
        
        RI::$em->persist($habitacion);
        RI::$em->flush();
        
    }
    
    /**
     * 
     * @param RI\DBHmi2GuaycuruCamasBundle\Entity\Salas $sala
     */
    private function setCantCamasSala($sala){
        
        // count camas salas
        $count = 
            RI::$doctrine->getRepository
                (RIUtiles::DB_BUNDLE.':Salas')
                ->countCamas($sala->getIdSala(),false);
        
        // cant camas
        $sala->setCantCamas($count);
        
        
        // validacion assert
        RIUtiles::validacionAssert($sala);
        
        RI::$em->persist($sala);
        RI::$em->flush();
        
    }
    
    /**
     * 
     * @param integer $id_sala
     */
    private function setCantCamasHabSala($id_sala){
        
        
        // habitaciones de la sala
        $habitaciones = 
            RI::$doctrine->getRepository
                (RIUtiles::DB_BUNDLE.':Habitaciones')
                ->findByIdSala($id_sala);

        foreach($habitaciones as $habitacion) {

            $this->setCantCamasHab($habitacion->getIdHabitacion());

        }
                
    }
    
    /**
     * 
     * @param integer $id_habitacion
     * @param boolean $baja
     */
    private function setBajaCamasHabitacion(
            $id_habitacion,
            $baja){
        
        // baja cama de la habitacion
        $camas = 
            RI::$doctrine->getRepository
                (RIUtiles::DB_BUNDLE.':Camas')
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
    
    /**
     * 
     * @param integer $id_sala
     * @param boolean $baja
     */
    private function setBajaCamasSala(
            $id_sala,
            $baja){
        
        // baja cama de la sala
        $camas = 
            RI::$doctrine->getRepository
                (RIUtiles::DB_BUNDLE.':Camas')
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
        
    /**
     * 
     * @param integer $id_sala
     * @param boolean $baja
     */
    private function setBajaHabitacionesSala(
            $id_sala,
            $baja){
        
        // habitaciones de la sala
        $habitaciones = 
            RI::$doctrine->getRepository
                (RIUtiles::DB_BUNDLE.':Habitaciones')
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

