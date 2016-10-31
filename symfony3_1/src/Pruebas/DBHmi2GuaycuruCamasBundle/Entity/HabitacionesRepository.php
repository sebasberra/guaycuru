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
            $id_efector)
    {
        
        
        // trae habitacion o habitaciones con el nombre y id_efector
        // pasados por parametro 
        $dql =
            "SELECT "
                ."h "
            ."FROM "
                ."DBHmi2GuaycuruCamasBundle:Habitaciones h "
            ."INNER JOIN "
                ."DBHmi2GuaycuruCamasBundle:Salas s "
            ."WHERE "
                ."h.nombre = :nombre_habitacion "
            ."AND s.idEfector = :id_efector "
            ."AND h.idSala = s.idSala";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("nombre_habitacion",$nombre_habitacion);
            $query->setParameter("id_efector",$id_efector);
            
            $habitaciones = $query->getSingleResult();
            
        } catch (\Exception $e) {

            throw $e;            
        }
        
        return $habitaciones;
    }
}

