<?php

namespace RI\DBHmi2GuaycuruCamasBundle\Entity;

use Doctrine\ORM\EntityRepository;

use RI\RIWebServicesBundle\Utils\RI\RIUtiles;


class ServiciosSalasRepository extends EntityRepository
{
    
    public function findByIdEfector(
            $id_efector)
    {
                
        $dql =
            "SELECT "
                ."ss "
            ."FROM "
                .RIUtiles::DB_BUNDLE.":ServiciosSalas ss "
            ."INNER JOIN "
                .RIUtiles::DB_BUNDLE.":Salas s "
            ."WHERE "
                ."ss.idSala = s.idSala "
            ."AND ss.baja = false "
            ."AND s.idEfector = :id_efector ";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_efector",$id_efector);
            
            $servicios_salas = $query->getResult();
            
        } catch (\Exception $e) {

            throw $e;            
        }
        
        return $servicios_salas;
    }
    
}