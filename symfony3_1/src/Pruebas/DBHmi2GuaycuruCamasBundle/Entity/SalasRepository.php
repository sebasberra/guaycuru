<?php

namespace Pruebas\DBHmi2GuaycuruCamasBundle\Entity;

use Doctrine\ORM\EntityRepository;

class SalasRepository extends EntityRepository
{
    
    
    public function findOneByNombreIdEfector(
            $nombre_sala,
            $id_efector)
    {
        
        
        
        $dql =
            "SELECT "
                ."s "
            ."FROM "
                ."DBHmi2GuaycuruCamasBundle:Salas s "
            ."WHERE "
                ."s.nombre = :nombre_sala "
            ."AND s.idEfector = :id_efector ";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("nombre_sala",$nombre_sala);
            $query->setParameter("id_efector",$id_efector);
            
            $sala = $query->getSingleResult();
            
        } catch (\Exception $e) {

            throw $e;            
        }
        
        return $sala;
    }
    
    
    public function countCamas(
            $id_sala){
        
        $dql = 
                "SELECT "
                    ."COUNT(c.idCama) "
                ."FROM "
                    ."DBHmi2GuaycuruCamasBundle:Camas c "
                ."INNER JOIN "
                    ."DBHmi2GuaycuruCamasBundle:Habitaciones h "
                ."WHERE "
                    ."c.idSala = :id_sala "
                ."AND h.idHabitacion = c.idHabitacion";
                   
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            $query->setParameter("id_sala", $id_sala);

            $count = $query->getSingleScalarResult();
            
        } catch (\Exception $e) {

            throw $e;            
            
        }
        
        return $count;
        
    }
}

