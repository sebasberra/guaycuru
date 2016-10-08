<?php

namespace Pruebas\WSBundle\Utils;

use Pruebas\DBHmi2GuaycuruCamasBundle\Entity\Camas;

class ConfiguracionEdilicia
{
    
    private $em;
    private $conn;
    
    public function __construct($doctrine) {
    
        $this->em = $doctrine->getManager('default');
        $this->conn = $doctrine->getManager('default')->getConnection();
        
    }
    
    public function __destruct() {
    
        
    }

    public function agregarCama($nueva_cama){
        
//        id_cama int(10) unsigned NOT NULL AUTO_INCREMENT,
//        id_clasificacion_cama tinyint(3) unsigned NOT NULL COMMENT 'clasificacion de cama',
//        id_efector int(10) unsigned NOT NULL COMMENT 'Se guarda el id del efector para cuando la cama no esta asignada a una habitacion',
//        id_habitacion int(10) unsigned DEFAULT NULL COMMENT 'para camas rotativas esta permitido que la cama no este asignada a una habitacion en un momento dado',
//        id_internacion int(10) unsigned DEFAULT NULL COMMENT 'Id de internacion de quien esta ocupando la cama. Si es NULL la cama esta vacia',
//        nombre varchar(50) NOT NULL,
//        estado char(1) NOT NULL COMMENT 'L=libre; O=ocupada; F=fuera de servicio; R=en reparacion; V=reservada',
//        rotativa tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=no es rotativa, 1=es rotativa; Las camas rotativas pueden cambiarse de habitacion o sala o no estar asignada a una habitacion en un momento dado',
//        baja tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = habilitada; 1 = baja',
//        fecha_modificacion
        
        // generar id_cama
        
        // validar id_clasificacion
        
        // validar id_efector
        
        // validar id_habitacion
        
        // vacio id_internacion
        
        // nombre [NOTA: nombres de camas unicos por efector !!! ] 
        // !! editar definicion en base de datos !!
        
        // estado libre
        
        // rotativa 
        
        // baja
        
        // fecha modificacion
        
        $cama = new Camas();
        $cama->setName('Keyboard');
        $cama->setPrice(19.99);
        $cama->setDescription('Ergonomic and stylish!');

        $em = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new Response('Saved new product with id '.$product->getId());
        
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
    
}

