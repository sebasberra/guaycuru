<?php

namespace Pruebas\WSBundle\Utils;

use Pruebas\DBHmi2GuaycuruCamasBundle\Entity\Camas;


class ConfiguracionEdilicia
{
    
    public $error_debug;
    private $doctrine;
    private $em;
    private $conn;
    
    public function __construct($doctrine) {
    
        $this->doctrine = $doctrine;
        $this->em = $doctrine->getManager('default');
        $this->conn = $doctrine->getManager('default')->getConnection();
        
    }
    
    public function __destruct() {
    
        
    }

    /** Agrega una cama a la base centralizada
     *  El parametro $nueva_cama es un arreglo con:
     *  ["nombre_cama"]
     *  ["nombre_habitacion"]
     *  ["id_efector"]
     *  ["id_clasificacion_cama"]
     * 
     * @param type $nueva_cama
     * @param type $msg
     * @return boolean
     */
    public function agregarCama(
            $nueva_cama,
            &$msg){
        
//        id_cama int(10) unsigned NOT NULL AUTO_INCREMENT,
//        id_clasificacion_cama tinyint(3) unsigned NOT NULL 
//          COMMENT 'clasificacion de cama',
//        id_efector int(10) unsigned NOT NULL 
//          COMMENT 'Se guarda el id del efector para cuando la cama no esta asignada a una habitacion',
//        id_habitacion int(10) unsigned DEFAULT NULL 
//          COMMENT 'para camas rotativas esta permitido que la cama no este asignada a una habitacion en un momento dado',
//        NOTA: se agrega nombre de la habitacion y se busca el id_habitacion en base central por nombre
//        nombre_habitacion VARCHAR(50)
//        id_internacion int(10) unsigned DEFAULT NULL 
//          COMMENT 'Id de internacion de quien esta ocupando la cama. Si es NULL la cama esta vacia',
//        nombre varchar(50) NOT NULL,
//        estado char(1) NOT NULL 
//          COMMENT 'L=libre; O=ocupada; F=fuera de servicio; R=en reparacion; V=reservada',
//        rotativa tinyint(1) NOT NULL DEFAULT '0' 
//          COMMENT '0=no es rotativa, 1=es rotativa; Las camas rotativas pueden cambiarse de habitacion o sala o no estar asignada a una habitacion en un momento dado',
//        baja tinyint(1) NOT NULL DEFAULT '0' 
//          COMMENT '0 = habilitada; 1 = baja',
//        fecha_modificacion TIMESTAMP de actualizacion del registro
        
        // ini
        $this->error_debug="";
        $msg="";
        
       
        
        // clasificacion cama
        $clasificacion_cama = 
            $this->doctrine->getRepository
                ('DBHmi2GuaycuruBundle:ClasificacionesCamas')
                ->findOneById($nueva_cama["id_clasificacion_cama"]);
        
        if (!$clasificacion_cama){
            
            $msg = "El id de clasificación de cama: "
                    .$nueva_cama["id_clasificacion_cama"]
                    ." no existe en la base de datos";
        
            $this->error_debug = $msg;
        
            return false;
            
        }
        
        
        // efector
        $efector = 
            $this->doctrine->getRepository
                ('DBHmi2GuaycuruBundle:Efectores')
                ->findOneById($nueva_cama["id_efector"]);
        
        if (!$efector){
            
            $msg = "El id de efector: "
                    .$nueva_cama["id_efector"]
                    ." no existe en la base de datos";
        
            $this->error_debug = $msg;
        }
        
        // busca id_habitacion, trae null si no encuentra
        if ($this->obtenerIdHabitacion(
                $nueva_cama["nombre_habitacion"],
                $nueva_cama["id_efector"],
                $id_habitacion,
                $msg)==false){
            
            return false;
            
        }
        
        $habitacion = 
            $this->doctrine->getRepository
                ('DBHmi2GuaycuruBundle:Habitaciones')
                ->findOneById($id_habitacion);
        
        
        // chequea que el nombre de cama este libre para usarse en el efector
        if ($this->validarNombreCama(
                $nueva_cama["nombre_cama"], 
                $nueva_cama["id_efector"], 
                $msg)==false){
            
            return false;
        }
             
        
        
        // objeto Camas doctrine
        $cama = new Camas();
        
        // baja = false
        $cama->setBaja(false);
        
        // estado libre
        $cama->setEstado("L");
        
        // timestamp fecha modificacion
        $cama->setFechaModificacion(null);
        
        // clasificacion cama
        $cama->setIdClasificacionCama($clasificacion_cama);
        
        // efector
        $cama->setIdEfector($efector);
        
        // habitacion
        $cama->setIdHabitacion($habitacion);
        
        // internacion null
        $cama->setIdInternacion(null);
        
        // nombre de cama
        $cama->setNombre($nueva_cama["nombre_cama"]);
        
        // rotativa falso
        $cama->setRotativa(false);
        
        // insert datos en la DB
        $this->em->persist($cama);
        $this->em->flush();

        $msg = "La cama: ".$nueva_cama["nombre_cama"]
                ." fue ingresada al efector: "
                .$efector->getNomEfector();
        if ($habitacion){        
            $msg+=" y en la habitación: ".$habitacion->getNombre();
        }
        
        return true;
        
    }
    
    public function modificarCama($modif_cama){
        
    }
    
    public function eliminarCama($elimina_cama){
        
    }
    
    public function ocuparCama($ocupa_cama){
        
    }
    
    public function liberarCama($libera_cama){
        
    }
    
    public function agregarHabitacion($nueva_hab){
        
    }
    
    public function modificarHabitacion($modif_hab){
        
    }
    
    public function eliminarHabitacion($elimina_hab){
        
    }
    
    public function agregarSala($nueva_sala){
        
    }
    
    public function modificarSala($modif_sala){
        
    }
    
    public function eliminarSala($elimina_sala){
        
    }
    
    
    /** busca el id_habitacion segun el nombre de habitacion y id_efector
     *  pasado por parametro. si no encuentra registro de habitacion 
     *  devuelve NULL en $id_habitacion. No se puede definir si existe mas 
     *  de una habitacion con el mismo nombre en el efector y tambien
     *  devuelve NULL en tal caso
     * 
     * @param type $nombre_habitacion
     * @param type $id_efector
     * @param type $id_habitacion
     * @param type $msg
     * @return boolean
     */
    private function obtenerIdHabitacion(
            $nombre_habitacion,
            $id_efector,
            &$id_habitacion,
            &$msg){
        
        
        // id_habitacion
        //
        // busca el id_habitacion segun el nombre pasado por parametro
        // si no encuentra registro de habitacion coloca NULL
        // No se puede definir si existe mas de una habitacion con el mismo nombre
        // en el efector
        $sql_id_habitacion=
            "SELECT "
                ."h.id_habitacion"
            ."FROM "
                ."habitaciones h "
            ."INNER JOIN "
                ."salas s "
            ."ON h.id_sala = s.id_sala "
            ."WHERE "
                ."h.nombre = '".$nombre_habitacion."' "
            ."AND s.id_efector = ".$id_efector." ";
        
        try{
            
            $result = $this->conn->fetchAll($sql_id_habitacion);
            
        } catch (Exception $e) {

            $msg = "Error al buscar el id de habitación";
            
            $this->error_debug = $e->getMessage();
            
            return false;
        }
        
            
        if ($result[0]["id_habitacion"]!=0 || count($result)>1){
            
            $msg = "No se puede establecer la habitación. La cantidad "
                    ."de habitaciones encontradas con el nombre "
                    .$nombre_habitacion." es: "
                    .count($result);
        
            // id_habitacion = null
            $id_habitacion = null;
            
        }else{
            
            // id_habitacion encontrado
            $id_habitacion = $result[0]["id_habitacion"];
            
        }
        
        return true;
        
    }
    
    
    /** Valida si el nombre de cama esta libre para usarse en el efector
     *  NOTA: nombres de camas unicos por efector
     * 
     * @param type $nombre_cama
     * @param type $id_efector
     * @param type $msg
     * @return boolean
     */
    private function validarNombreCama(
            $nombre_cama,
            $id_efector,
            &$msg){
        
        
        
        // check si nombre de cama existe en el efector
        $sql_nombre_cama=
            "SELECT "
                ."COUNT(*) AS cant"
            ."FROM "
                ."camas c "
            ."WHERE "
                ."c.nombre = '".$nombre_cama."' "
            ."AND c.id_efector = ".$id_efector." ";
        
        try{
            
            $result = $this->conn->fetchAll($sql_nombre_cama);
            
        } catch (Exception $e) {

            $msg = "Error al chequear si el nombre de cama existe en el efector";
            
            $this->error_debug = $e->getMessage();
            
            return false;
        }
        
            
        if ($result[0]["cant"]!=0){
            
            $msg = "El nombre de cama: ".$nombre_cama
                ." ya existe para el efector: ".$id_efector." ";
            
            return false;
            
        }
        
        return true;
        
    }
}

