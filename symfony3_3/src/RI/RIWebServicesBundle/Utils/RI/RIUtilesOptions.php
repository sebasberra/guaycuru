<?php

namespace RI\RIWebServicesBundle\Utils\RI;


trait RIUtilesOptions{
    
    
    /** Un nivel Habitaciones
     * 
     * @param type $id_efector
     * @return type
     */
    public static function getHabitacionesChoices($id_efector){
        
        $habitaciones = 
                parent::$em
                ->getRepository(self::DB_BUNDLE.':Habitaciones')
                ->findByIdEfector($id_efector);
        
        $hab_choices=array();
        
        foreach($habitaciones as $habitacion){
        
            $hab_choices += array(
                
                $habitacion->getIdSala()->getNombre() 
                =>$habitacion->getIdHabitacion()
                    );
            
        }
        
        return $hab_choices;
        
    }
    
    /** Dos niveles Salas/Habitaciones
     * 
     * @param type $id_efector
     * @return type
     */
    public static function getSalasHabitacionesChoices($id_efector){
        
        $habitaciones = 
                parent::$em
                ->getRepository(self::DB_BUNDLE.':Habitaciones')
                ->findByIdEfector($id_efector);
        
        $salas_hab_choices=array();
        
        foreach($habitaciones as $habitacion){
        
            $sala = $habitacion->getIdSala()->getNombre();
            
            if (!array_key_exists($sala,$salas_hab_choices)){
                
                $salas_hab_choices[$sala] = array(
                    
                    $habitacion->getNombre()
                        =>$habitacion->getIdHabitacion()
                );
            }else{
                
                $salas_hab_choices[$sala] += array(
                    
                    $habitacion->getNombre()
                        =>$habitacion->getIdHabitacion()
                );
                
            }
        }
        
        return $salas_hab_choices;
        
    }
    
    /** Tres niveles Salas/Habitaciones/Camas
     * 
     * @param type $id_efector
     * @return type
     */
    public static function getSalasHabCamasChoices($id_efector){
        
        
        // obtiene las camas
        $camas = 
                parent::$em
                ->getRepository(self::DB_BUNDLE.':Camas')
                ->findByIdEfectorOptimizado($id_efector);
        
        
        $salas_hab_camas_choices=array();
        
        foreach($camas as $cama){
        
            $sala = $cama->getIdHabitacion()->getIdSala()->getNombre();
            
            if ( !array_key_exists($sala,$salas_hab_camas_choices) ){
                
                
                $salas_hab_camas_choices[$sala] = array(
                    $cama->getIdHabitacion()->getNombre()
                        => array(
                            $cama->getNombre()
                            =>$cama->getIdCama()
                            )
                        );
                
            }else{
                
                if (!array_key_exists(
                        $cama->getIdHabitacion()->getNombre(), 
                        $salas_hab_camas_choices[$sala])){
                    
                
                    $salas_hab_camas_choices[$sala][$cama->getIdHabitacion()->getNombre()] = 
                            array(
                                $cama->getNombre()
                                =>$cama->getIdCama()
                            );
                    
                }else{
                    
                    $salas_hab_camas_choices[$sala][$cama->getIdHabitacion()->getNombre()] += 
                            array(
                                $cama->getNombre()
                                =>$cama->getIdCama()
                            );
                    
                }
                
            }
        }
        
        
        // obtiene las salas
        $salas =
                parent::$em
                ->getRepository(self::DB_BUNDLE.':Salas')
                ->findByIdEfector($id_efector);
        
        // agrega salas que no tienen camas
        foreach($salas as $sala){
            
            $nombre_sala = $sala->getNombre();
            
            if ( !array_key_exists($nombre_sala,$salas_hab_camas_choices) ){
                
                $salas_hab_camas_choices[$nombre_sala] = array();
            }
        }
        
        // obtiene las habitaciones
        $habitaciones =
                parent::$em
                ->getRepository(self::DB_BUNDLE.':Habitaciones')
                ->findByIdEfectorConAsociaciones($id_efector);
 
        
        // agrega habitaciones que no tienen camas
        foreach($habitaciones as $habitacion){
            
            $nombre_sala = $habitacion->getIdSala()->getNombre();
            $nombre_hab = $habitacion->getNombre();
            
            if (!array_key_exists(
                    $nombre_hab, 
                    $salas_hab_camas_choices[$nombre_sala])){


                    $salas_hab_camas_choices[$nombre_sala][$nombre_hab] = array();
                    
            }
            
        }
        
        return $salas_hab_camas_choices;
        
    }
    
}

