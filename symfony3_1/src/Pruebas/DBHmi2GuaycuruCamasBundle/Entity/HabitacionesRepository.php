<?php

namespace Pruebas\DBHmi2GuaycuruCamasBundle\Entity;

use Doctrine\ORM\EntityRepository;

class HabitacionesRepository extends EntityRepository
{
    
    /** Obtiene la habitacion o habitaciones que coincidan con el
     *  nombre y id_efector pasados por parametro
     *  NOTA: se recomienda utilizar nombres unicos de habitaciones
     *  por efector, pero no se implementara restriccion de indice unico
     * 
     * @param type $nombre_habitacion
     * @param type $id_efector
     * @param string $msg
     * @return type
     */
    public function findOneByNombreIdEfector(
            $nombre_habitacion,
            $id_efector,
            &$msg)
    {
        
        
        // trae habitacion o habitaciones con el nombre y id_efector
        // pasados por parametro 
        $q =
            "SELECT "
                ."h "
            ."FROM "
                ."DBHmi2GuaycuruCamasBundle:Habitaciones h "
            ."INNER JOIN "
                ."DBHmi2GuaycuruCamasBundle:Salas s "
            ."WHERE "
                ."h.nombre = '".$nombre_habitacion."' "
            ."AND s.idEfector = ".$id_efector." "
            ."AND h.idSala = s.idSala";
        
        try{
            
            $habitaciones = 
                    $this->getEntityManager()->createQuery($q)->getResult();
            
        } catch (\Exception $e) {

            $msg =
                "Error al buscar el nombre de habitación en el efector"
                ."<p>".$e->getMessage()."</p>";
            
            // error
            return -1;
        }
        
        return $habitaciones;
    }
}

