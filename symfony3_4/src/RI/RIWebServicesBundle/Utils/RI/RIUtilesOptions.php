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
    
    
    /** Tres niveles Salas/Habitaciones/Camas incluye info extra
     * 
     * @todo Cargar camas con id_habitacion = NULL (camas rotativas)
     * @param integer $id_efector
     * @return array
     */
    public static function getSalasHabCamasOrgChartInfo($id_efector){
        
        // efector
        $efector = parent::$em
                ->getRepository(self::DB_BUNDLE.':Efectores')
                ->findOneByIdEfectorConAsociaciones($id_efector);
        
        $efector_info['claveestd'] = $efector->getClaveestd();
        $efector_info['nom_efector'] = $efector->getNomEfector();
        
        switch ($efector->getIdNivelComplejidad()){
            
            case 1:
                
                $efector_info['nivel_complejidad'] ="S/D";
                
            case 2:
                
                $efector_info['nivel_complejidad'] ="Especializados";
                
            case 3:
                
                $efector_info['nivel_complejidad'] ="I";
                
            case 4:
                
                $efector_info['nivel_complejidad'] ="II";
                
            case 5:
                
                $efector_info['nivel_complejidad'] ="III";
                
            case 6:
                
                $efector_info['nivel_complejidad'] ="IV";
                
            case 7:
                
                $efector_info['nivel_complejidad'] ="IX";
                
            case 8:
                
                $efector_info['nivel_complejidad'] ="V";
                
            case 9:
                
                $efector_info['nivel_complejidad'] ="VI";
                
            case 10:
                
                $efector_info['nivel_complejidad'] ="VIII";
                                
        }
        
        // cantidad camas activas del efector 
        $efector_info['cant_camas'] = parent::$em
                ->getRepository(self::DB_BUNDLE.':Efectores')
                ->countCamas($id_efector,false);
        
        // camas
        $camas = 
                parent::$em
                ->getRepository(self::DB_BUNDLE.':Camas')
                ->findByIdEfectorOptimizado($id_efector,2);
        
        
        // arbol de herencia del efector
        $salas_hab_camas_choices=array();
        
        foreach($camas as $cama){
        
            // id sala habitacion cama
            $sala = $cama->getIdHabitacion()->getIdSala();
            $id_sala = $sala->getIdSala();
            $habitacion = $cama->getIdHabitacion();
            $id_habitacion = $habitacion->getIdHabitacion();
            $id_cama = $cama->getIdCama();
            
            
            //
            // info sala
            
            // mover camas
            if ($sala->getMoverCamas()){
                $mover_camas='Si';
            }else{
                $mover_camas='No';
            }
            
            // area servicio
            $area_cod_servicio = $sala->getAreaCodServicio() == null ? '' : $sala->getAreaCodServicio();
            $area_sector = $sala->getAreaSector() == null ? '' : $sala->getAreaSector();
            $area_subsector = $sala->getAreaSubsector() == null ? '' : $sala->getAreaSubsector();
            $area_nom_servicio_estadistica = $sala->getAreaEfectorServicio() == null ? '' : $sala->getAreaEfectorServicio()->getNomServicioEstadistica();
            if ($area_nom_servicio_estadistica==''){
                $area_desc = 'No Definida';
            }else{
                $area_desc = $area_cod_servicio.'-'.$area_sector.'-'.$area_subsector.' '.$area_nom_servicio_estadistica;
            }
            
            // baja sala
            if ($sala->getBaja()){
                $baja_sala ='Si';
            }else{
                $baja_sala ='No';
            }
            
            
            //
            // info habitacion

            // sexo
            switch ($habitacion->getSexo()){

                case 1:
                    $sexo = 'Masculino';
                    break;

                case 2:
                    $sexo = 'Femenino';
                    break;

                case 3:
                    $sexo = 'Mixto';
                    break;

                default:
                    $sexo = 'Indeterminado';
            }

            // tipo edad
            switch ($habitacion->getTipoEdad()){

                case 1:
                    $tipo_edad = 'Años';
                    break;

                case 2:
                    $tipo_edad = 'Meses';
                    break;

                case 3:
                    $tipo_edad = 'Días';
                    break;

                case 4:
                    $tipo_edad = 'Horas';
                    break;

                case 5:
                    $tipo_edad = 'Minutos';
                    break;

                default:
                    $tipo_edad = 'No definido';
            }

            // edad desde
            if ($habitacion->getEdadDesde()=='0'){
                $edad_desde='Sin Límite';
            }else{
                $edad_desde=''.$habitacion->getEdadDesde();
            }

            // edad hasta
            if ($habitacion->getEdadHasta()=='255'){
                $edad_hasta='Sin Límite';
            }else{
                $edad_hasta=''.$habitacion->getEdadHasta();
            }

            // baja hab
            if ($habitacion->getBaja()){
                $baja_hab='Si';
            }else{
                $baja_hab='No';
            }
            
            
            //
            // info cama
            
            // tipo cuidado progresivo
            switch ($cama->getIdClasificacionCama()->getTipoCuidadoProgresivo()){
                
                case 0:
                    $tipo_cuidado_progresivo = 'Moderado';
                    break;
                
                case 1:
                    $tipo_cuidado_progresivo = 'Intermedio';
                    break;
                
                case 2:
                    $tipo_cuidado_progresivo = 'Crítico';
                    break;
                
                defualt:
                    $tipo_cuidado_progresivo = 'No definido';
                    break;
            }
            
            // estado
            switch ($cama->getEstado()){
                
                case 'L':
                    $estado = 'Libre';
                    break;
                
                case 'O':
                    $estado = 'Ocupada';
                    break;
                
                case 'F':
                    $estado = 'Fuera de Servicio';
                    break;
                
                case 'R':
                    $estado = 'En Reparación';
                    break;
                
                case 'V':
                    $estado = 'Reservada';
                    break;
                
                default:
                    $estado = 'No definido';
            }
            
            // rotativa
            if ($cama->isRotativa()){
                $rotativa = 'Si';
            }else{
                $rotativa = 'No';
            }
            
            // baja cama
            if ($cama->isBaja()){
                $baja_cama = 'Si';
            }else{
                $baja_cama = 'No';
            }
            
            
            if ( !array_key_exists($id_sala,$salas_hab_camas_choices) ){
                
                
                $salas_hab_camas_choices[$id_sala] = 
                        array(
                            'nombre' => $sala->getNombre(),
                            
                            'mover_camas' => (int)$sala->getMoverCamas(),
                            'mover_camas_desc' => $mover_camas,
                            
                            'area_cod_servicio' => $area_cod_servicio,
                            'area_sector' => $area_sector,
                            'area_subsector' => $area_subsector,
                            'area_nom_servicio_estadistica' => $area_nom_servicio_estadistica,
                            'area_desc' => $area_desc,
                            
                            'cant_camas' => $sala->getCantCamas(),
                            
                            'baja' => (int)$sala->getBaja(),
                            'baja_desc' => $baja_sala,
                            
                            'habitaciones' =>
                                        array(
                                            $id_habitacion =>
                                                array(
                                                    'id_habitacion' => $id_habitacion,
                                                    'nombre' => $habitacion->getNombre(),

                                                    'sexo' => $habitacion->getSexo(),
                                                    'sexo_desc' => $sexo,

                                                    'edad_desde' => $habitacion->getEdadDesde(),
                                                    'edad_desde_desc' => $edad_desde,

                                                    'edad_hasta' => $habitacion->getEdadHasta(),
                                                    'edad_hasta_desc' => $edad_hasta,

                                                    'tipo_edad' => $habitacion->getTipoEdad(),
                                                    'tipo_edad_desc' => $tipo_edad,

                                                    'cant_camas' => $habitacion->getCantCamas(),

                                                    'baja' => (int)$habitacion->getBaja(),
                                                    'baja_desc' => $baja_hab,
                                                    
                                                    'camas' => 
                                                        array(
                                                            $id_cama=>
                                                                array(
                                                                    'id_cama' => $id_cama,
                                                                    'nombre' => $cama->getNombre(),

                                                                    'id_clasificacion_cama' => $cama->getIdClasificacionCama(),
                                                                    'clasificacion_cama' => $cama->getIdClasificacionCama()->getClasificacionCama(),
                                                                    
                                                                    'tipo_cuidado_progresivo' => $cama->getIdClasificacionCama()->getTipoCuidadoProgresivo(),
                                                                    'tipo_cuidado_progresivo_desc' => $tipo_cuidado_progresivo,

                                                                    'id_internacion' => $cama->getIdInternacion() == null ? '' : $cama->getIdInternacion(),
                                                                    'internacion_apellido' => $cama->getIdInternacion() == null ? '' : 'Desconocido',
                                                                    'internacion_nombre' => $cama->getIdInternacion() == null ? '' : 'Desconocido',

                                                                    'estado' => $cama->getEstado(),
                                                                    'estado_desc' => $estado,
                                                                    
                                                                    'rotativa' => (int)$cama->isRotativa(),
                                                                    'rotativa_desc' => $rotativa,
                                                                    
                                                                    'baja' => (int)$cama->isBaja(),
                                                                    'baja_desc' => $baja_cama
                                                                    )
                                                            )
                                                    )
                                            )
                        );
                
            }else{
                
                if (!array_key_exists(
                        $id_habitacion, 
                        $salas_hab_camas_choices[$id_sala]['habitaciones'])){
                    
                    
                    $salas_hab_camas_choices[$id_sala]['habitaciones'][$id_habitacion] = 
                            
                                        array(
                                            'id_habitacion' => $id_habitacion,
                                            'nombre' => $habitacion->getNombre(),
                                            
                                            'sexo' => $habitacion->getSexo(),
                                            'sexo_desc' => $sexo,
                                            
                                            'edad_desde' => $habitacion->getEdadDesde(),
                                            'edad_desde_desc' => $edad_desde,
                                            
                                            'edad_hasta' => $habitacion->getEdadHasta(),
                                            'edad_hasta_desc' => $edad_hasta,
                                            
                                            'tipo_edad' => $habitacion->getTipoEdad(),
                                            'tipo_edad_desc' => $tipo_edad,
                                            
                                            'cant_camas' => $habitacion->getCantCamas(),
                                            
                                            'baja' => (int)$habitacion->getBaja(),
                                            'baja_desc' => $baja_hab,
                                            
                                            'camas' =>
                                                array(
                                                    $id_cama => 
                                                        array(
                                                            'id_cama' => $id_cama,
                                                            'nombre' => $cama->getNombre(),

                                                            'id_clasificacion_cama' => $cama->getIdClasificacionCama(),
                                                            'clasificacion_cama' => $cama->getIdClasificacionCama()->getClasificacionCama(),

                                                            'tipo_cuidado_progresivo' => $cama->getIdClasificacionCama()->getTipoCuidadoProgresivo(),
                                                            'tipo_cuidado_progresivo_desc' => $tipo_cuidado_progresivo,

                                                            'id_internacion' => $cama->getIdInternacion() == null ? '' : $cama->getIdInternacion(),
                                                            'internacion_apellido' => $cama->getIdInternacion() == null ? '' : 'Desconocido',
                                                            'internacion_nombre' => $cama->getIdInternacion() == null ? '' : 'Desconocido',

                                                            'estado' => $cama->getEstado(),
                                                            'estado_desc' => $estado,

                                                            'rotativa' => (int)$cama->isRotativa(),
                                                            'rotativa_desc' => $rotativa,

                                                            'baja' => (int)$cama->isBaja(),
                                                            'baja_desc' => $baja_cama
                                                            )
                                                    )
                                            );
                    
                }else{
                    
                    $salas_hab_camas_choices[$id_sala]['habitaciones'][$id_habitacion]['camas'][$id_cama] = 
                                            array(
                                                'id_cama' => $id_cama,
                                                'nombre' => $cama->getNombre(),

                                                'id_clasificacion_cama' => $cama->getIdClasificacionCama(),
                                                'clasificacion_cama' => $cama->getIdClasificacionCama()->getClasificacionCama(),

                                                'tipo_cuidado_progresivo' => $cama->getIdClasificacionCama()->getTipoCuidadoProgresivo(),
                                                'tipo_cuidado_progresivo_desc' => $tipo_cuidado_progresivo,

                                                'id_internacion' => $cama->getIdInternacion() == null ? '' : $cama->getIdInternacion(),
                                                'internacion_apellido' => $cama->getIdInternacion() == null ? '' : 'Desconocido',
                                                'internacion_nombre' => $cama->getIdInternacion() == null ? '' : 'Desconocido',

                                                'estado' => $cama->getEstado(),
                                                'estado_desc' => $estado,

                                                'rotativa' => (int)$cama->isRotativa(),
                                                'rotativa_desc' => $rotativa,

                                                'baja' => (int)$cama->isBaja(),
                                                'baja_desc' => $baja_cama
                                            );
                    
                }
                
            }
        }
        
        
        
        
        
        // obtiene las salas
        $salas =
                parent::$em
                ->getRepository(self::DB_BUNDLE.':Salas')
                ->findByIdEfectorBaja($id_efector,false);
        
        // agrega salas que no tienen camas
        foreach($salas as $sala){
            
            //
            // info sala
            
            // id_sala
            $id_sala = $sala->getIdSala();
            
            // mover camas
            if ($sala->getMoverCamas()){
                $mover_camas='Si';
            }else{
                $mover_camas='No';
            }
            
            // area servicio
            $area_cod_servicio = $sala->getAreaCodServicio() == null ? '' : $sala->getAreaCodServicio();
            $area_sector = $sala->getAreaSector() == null ? '' : $sala->getAreaSector();
            $area_subsector = $sala->getAreaSubsector() == null ? '' : $sala->getAreaSubsector();
            $area_nom_servicio_estadistica = $sala->getAreaEfectorServicio() == null ? '' : $sala->getAreaEfectorServicio()->getNomServicioEstadistica();
            if ($area_nom_servicio_estadistica==''){
                $area_desc = 'No Definida';
            }else{
                $area_desc = $area_cod_servicio.'-'.$area_sector.'-'.$area_subsector.' '.$area_nom_servicio_estadistica;
            }
            
            // baja sala
            if ($sala->getBaja()){
                $baja_sala ='Si';
            }else{
                $baja_sala ='No';
            }
            
            
            if ( !array_key_exists($id_sala,$salas_hab_camas_choices) ){
                
                
                $salas_hab_camas_choices[$id_sala] = 
                        array(
                            'nombre' => $sala->getNombre(),
                            
                            'mover_camas' => (int)$sala->getMoverCamas(),
                            'mover_camas_desc' => $mover_camas,
                            
                            'area_cod_servicio' => $area_cod_servicio,
                            'area_sector' => $area_sector,
                            'area_subsector' => $area_subsector,
                            'area_nom_servicio_estadistica' => $area_nom_servicio_estadistica,
                            'area_desc' => $area_desc,
                            
                            'cant_camas' => $sala->getCantCamas(),
                            
                            'baja' => (int)$sala->getBaja(),
                            'baja_desc' => $baja_sala,
                            
                            'habitaciones' =>
                                        array()
                            );
            }
            
        }
        
        // obtiene las habitaciones
        $habitaciones =
                parent::$em
                ->getRepository(self::DB_BUNDLE.':Habitaciones')
                ->findByIdEfectorConAsociaciones($id_efector, false);
 
        
        // agrega habitaciones que no tienen camas
        foreach($habitaciones as $habitacion){
            
            //
            // info habitacion

            // sexo
            switch ($habitacion->getSexo()){

                case 1:
                    $sexo = 'Masculino';
                    break;

                case 2:
                    $sexo = 'Femenino';
                    break;

                case 3:
                    $sexo = 'Mixto';
                    break;

                default:
                    $sexo = 'Indeterminado';
            }

            // tipo edad
            switch ($habitacion->getTipoEdad()){

                case 1:
                    $tipo_edad = 'Años';
                    break;

                case 2:
                    $tipo_edad = 'Meses';
                    break;

                case 3:
                    $tipo_edad = 'Días';
                    break;

                case 4:
                    $tipo_edad = 'Horas';
                    break;

                case 5:
                    $tipo_edad = 'Minutos';
                    break;

                default:
                    $tipo_edad = 'No definido';
            }

            // edad desde
            if ($habitacion->getEdadDesde()=='0'){
                $edad_desde='Sin Límite';
            }else{
                $edad_desde=''.$habitacion->getEdadDesde();
            }

            // edad hasta
            if ($habitacion->getEdadHasta()=='255'){
                $edad_hasta='Sin Límite';
            }else{
                $edad_hasta=''.$habitacion->getEdadHasta();
            }

            // baja hab
            if ($habitacion->getBaja()){
                $baja_hab='Si';
            }else{
                $baja_hab='No';
            }
            
            // id_sala
            $id_sala = $habitacion->getIdSala()->getIdSala();
            $id_habitacion = $habitacion->getIdHabitacion();
            
            if (!array_key_exists(
                        $id_habitacion, 
                        $salas_hab_camas_choices[$id_sala]['habitaciones'])){
                    
                    
                $salas_hab_camas_choices[$id_sala]['habitaciones'][$id_habitacion] = 

                                    array(
                                        'id_habitacion' => $id_habitacion,
                                        'nombre' => $habitacion->getNombre(),

                                        'sexo' => $habitacion->getSexo(),
                                        'sexo_desc' => $sexo,

                                        'edad_desde' => $habitacion->getEdadDesde(),
                                        'edad_desde_desc' => $edad_desde,

                                        'edad_hasta' => $habitacion->getEdadHasta(),
                                        'edad_hasta_desc' => $edad_hasta,

                                        'tipo_edad' => $habitacion->getTipoEdad(),
                                        'tipo_edad_desc' => $tipo_edad,

                                        'cant_camas' => $habitacion->getCantCamas(),

                                        'baja' => (int)$habitacion->getBaja(),
                                        'baja_desc' => $baja_hab,

                                        'camas' =>
                                            array()
                                    );
                }
                                                    
            
        }
        
        
        $config_edilicia['efector'] = $efector_info;
        $config_edilicia['efector']['salas'] = $salas_hab_camas_choices;
        
        //dump ($config_edilicia);die();
        return $config_edilicia;
        
    }
    
}

