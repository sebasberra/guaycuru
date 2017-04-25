<?php

namespace RI\DBHmi2GuaycuruCamasBundle\Entity;

use Doctrine\ORM\EntityRepository;

use RI\RIWebServicesBundle\Utils\RI\RIUtiles;


class EfectoresServiciosRepository extends EntityRepository
{
    
    public function findByIdEfectorInternacion(
            $id_efector){
        
        // efectores servicios
        $dql =
            "SELECT "
                ."es, se "
            ."FROM "
                .RIUtiles::DB_BUNDLE.":EfectoresServicios es "
            ."INNER JOIN "
                ."es.idServicioEstadistica se "
            ."WHERE "
                ."es.idEfector = :id_efector "
            ."AND es.idServicioEstadistica = se.idServicioEstadistica "
            ."AND es.subsector = '4' "
            ."AND es.baja = 0 ";
            
        
        try{
            
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_efector", $id_efector);
            
            $efectores_servicios = $query->getResult();
            
        } catch (\Exception $e) {

            throw $e;
        }
        
        return $efectores_servicios;
        
    }
    
    public function findOneByCodigoEstadistica(
            $id_efector,
            $cod_servicio,
            $sector,
            $subsector){
        
        // efectores servicios
        $dql =
            "SELECT "
                ."es "
            ."FROM "
                .RIUtiles::DB_BUNDLE.":EfectoresServicios es "
            ."WHERE "
                ."es.idEfector = :id_efector "
            ."AND es.codServicio = :cod_servicio "
            ."AND es.sector = :sector "
            ."AND es.subsector = :subsector "
            ."AND es.baja = 0 ";
            
        
        try{
            
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_efector", $id_efector);
            
            $query->setParameter("cod_servicio", $cod_servicio);
            $query->setParameter("sector", $sector);
            $query->setParameter("subsector", $subsector);
            
            $efectores_servicios = $query->getSingleResult();
            
        } catch (\Exception $e) {

            throw $e;
        }
        
        return $efectores_servicios;
        
    }
}

