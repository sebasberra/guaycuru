<?php

namespace RI\DBHmi2GuaycuruCamasBundle\Entity;

use Doctrine\ORM\EntityRepository;

use RI\RIWebServicesBundle\Utils\RI\RIUtiles;


class EfectoresRepository extends EntityRepository
{
    
    public function findByConfiguracionesSistemas()
    {
                        
        $dql =
            "SELECT "
                ."e "
            ."FROM "
                .RIUtiles::DB_BUNDLE.":Efectores e "
            ."INNER JOIN "
                .RIUtiles::DB_BUNDLE.":ConfiguracionesSistemas cs "
            ."WHERE "
                ."cs.activa   = 1 "
            ."AND e.idEfector = cs.idEfector ";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $efectores = $query->getResult();
            
        } catch (\Exception $e) {

            throw $e;
        }
        
        return $efectores;
    }
    
}

