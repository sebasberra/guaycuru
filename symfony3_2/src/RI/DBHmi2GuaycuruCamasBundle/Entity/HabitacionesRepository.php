<?php

namespace RI\DBHmi2GuaycuruCamasBundle\Entity;

use Doctrine\ORM\EntityRepository;

use RI\RIWebServicesBundle\Utils\RI\RIUtiles;


class HabitacionesRepository extends EntityRepository
{
    
    public function findByIdEfector(
            $id_efector)
    {
                        
        $dql =
            "SELECT "
                ."h "
            ."FROM "
                .RIUtiles::DB_BUNDLE.":Habitaciones h "
            ."INNER JOIN "
                .RIUtiles::DB_BUNDLE.":Salas s "
            ."WHERE "
                ."s.idEfector = :id_efector "
            ."AND s.idSala = h.idSala ";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_efector", $id_efector);
            
            $habitaciones = $query->getResult();
            
        } catch (\Exception $e) {

            throw $e;
        }
        
        return $habitaciones;
    }
    
    
    /** Obtiene la habitacion o habitaciones que coincidan con el
     *  nombre y id_efector pasados por parametro
     *  NOTA: se recomienda utilizar nombres unicos de habitaciones
     *  por efector, pero no se implementara restriccion de indice unico
     * 
     * @param type $id_efector
     * @param type $nombre_sala
     * @param type $nombre_habitacion
     * 
     * @return type
     */
    public function findOneByNombreSalaIdEfector(
            $id_efector,
            $nombre_sala,
            $nombre_habitacion)
    {
        
        // check sala existe
        $dql =
            "SELECT "
                ."s "
            ."FROM "
                ."DBHmi2GuaycuruCamasBundle:Salas s "
            ."WHERE "
                ."s.idEfector = :id_efector "
            ."AND s.nombre = :nombre_sala ";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_efector",$id_efector);
            $query->setParameter("nombre_sala",$nombre_sala);
            
            // exec query para chequear que exista la sala
            $query->getSingleResult();
            
        } catch (\Exception $e) {

            throw $e;            
        }
        
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
            ."AND s.nombre = :nombre_sala "
            ."AND h.idSala = s.idSala";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_efector",$id_efector);
            $query->setParameter("nombre_sala",$nombre_sala);
            $query->setParameter("nombre_habitacion",$nombre_habitacion);
            
            
            $habitaciones = $query->getSingleResult();
            
        } catch (\Exception $e) {

            throw $e;            
        }
        
        return $habitaciones;
    }
    
    
    public function countCamas(
            $id_habitacion,
            $baja){
        
        $dql = 
                "SELECT "
                    ."COUNT(c.idCama) "
                ."FROM "
                    ."DBHmi2GuaycuruCamasBundle:Camas c "
                ."WHERE "
                   ." c.idHabitacion = :id_habitacion "
                ."AND c.baja = :baja";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_habitacion", $id_habitacion);
            $query->setParameter("baja", $baja);

            $count = $query->getSingleScalarResult();
            
        } catch (\Exception $e) {

            throw $e;            
            
        }
        
        return $count;
        
    }
    
    public function countCamasTodas(
            $id_habitacion){
        
        $dql = 
                "SELECT "
                    ."COUNT(c.idCama) "
                ."FROM "
                    ."DBHmi2GuaycuruCamasBundle:Camas c "
                ."WHERE "
                   ." c.idHabitacion = :id_habitacion ";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_habitacion", $id_habitacion);
            
            $count = $query->getSingleScalarResult();
            
        } catch (\Exception $e) {

            throw $e;            
            
        }
        
        return $count;
        
    }
}

