<?php

namespace RI\DBHmi2GuaycuruCamasBundle\Entity;

use Doctrine\ORM\EntityRepository;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;


class SalasRepository extends EntityRepository
{
    
    public function findByIdEfectorBaja(
            $id_efector,
            $baja)
    {
                        
        $dql =
            "SELECT "
                ."s "
            ."FROM "
                .RIUtiles::DB_BUNDLE.":Salas s "
            ."WHERE "
                ."s.idEfector = :id_efector "
            ."AND s.baja = :baja";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_efector", $id_efector);
            $query->setParameter("baja", $baja);
            
            $salas = $query->getResult();
            
        } catch (\Exception $e) {

            RI::$error_debug .= $e->getMessage();
            
            throw $e;
        }
        
        return $salas;
    }
    
    
    public function findOneByIdSalaConAsociaciones(
            $id_sala)
    {
                        
        $dql =
            "SELECT "
                ."s, e , aes "
            ."FROM "
                .RIUtiles::DB_BUNDLE.":Salas s "
            ."JOIN "
                ."s.idEfector e "
            ."LEFT JOIN "
                ."s.areaEfectorServicio aes "
            ."WHERE "
                ."s.idSala = :id_sala ";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_sala", $id_sala);
            
            $sala = $query->getSingleResult();
            
        } catch (\Exception $e) {

            RI::$error_debug .= $e->getMessage();
            
            throw $e;
        }
        
        return $sala;
    }
    
    public function findByIdServicioSala(
            $id_servicio_sala)
    {
                        
        $dql =
            "SELECT "
                ."s "
            ."FROM "
                .RIUtiles::DB_BUNDLE.":Salas s "
            ."INNER JOIN "
                .RIUtiles::DB_BUNDLE.":ServiciosSalas ss "
            ."WHERE "
                ."ss.idSala = s.idSala "
            ."AND ss.idServicioSala = :id_servicio_sala";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_servicio_sala", $id_servicio_sala);
            
            $sala = $query->getSingleResult();
            
        } catch (\Exception $e) {

            RI::$error_debug .= $e->getMessage();
            
            throw $e;
        }
        
        return $sala;
    }
    
    
    public function findOneByNombreIdEfector(
            $nombre_sala,
            $id_efector)
    {
        
        
        
        $dql =
            "SELECT "
                ."s "
            ."FROM "
                .RIUtiles::DB_BUNDLE.":Salas s "
            ."WHERE "
                ."s.nombre = :nombre_sala "
            ."AND s.idEfector = :id_efector ";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("nombre_sala",$nombre_sala);
            $query->setParameter("id_efector",$id_efector);
            
            $sala = $query->getSingleResult();
            
        } catch (\Exception $e) {

            RI::$error_debug .= $e->getMessage();
            
            throw $e;            
        }
        
        return $sala;
    }
    
    
    public function countCamasTodas(
            $id_sala){
        
        $dql = 
                "SELECT "
                    ."COUNT(c.idCama) "
                ."FROM "
                    .RIUtiles::DB_BUNDLE.":Camas c "
                ."INNER JOIN "
                    .RIUtiles::DB_BUNDLE.":Habitaciones h "
                ."WHERE "
                    ."h.idSala = :id_sala "
                ."AND h.idHabitacion = c.idHabitacion";
                   
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            $query->setParameter("id_sala", $id_sala);

            $count = $query->getSingleScalarResult();
            
        } catch (\Exception $e) {

            RI::$error_debug .= $e->getMessage();
            
            throw $e;            
            
        }
        
        return $count;
        
    }
    
    public function countCamas(
            $id_sala,
            $baja){
        
        $dql = 
                "SELECT "
                    ."COUNT(c.idCama) "
                ."FROM "
                    .RIUtiles::DB_BUNDLE.":Camas c "
                ."INNER JOIN "
                    .RIUtiles::DB_BUNDLE.":Habitaciones h "
                ."WHERE "
                    ."h.idSala = :id_sala "
                ."AND c.baja = :baja "
                ."AND h.idHabitacion = c.idHabitacion";
                   
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            $query->setParameter("id_sala", $id_sala);
            $query->setParameter("baja", $baja);

            $count = $query->getSingleScalarResult();
            
        } catch (\Exception $e) {

            RI::$error_debug .= $e->getMessage();
            
            throw $e;            
            
        }
        
        return $count;
        
    }
    
    public function getProximoIdSala(
            $id_efector){
        
        $sql = 
                "SELECT "
                    ."servicios_get_proximo_id_sala(:id_efector) AS 'proximo_id_sala' ";
                
        // prepare sql
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->bindValue("id_efector", $id_efector);
        
        try {
        
            // ejecuta consulta
            $stmt->execute();
            $id_sala = $stmt->fetchAll();
                        
        } catch (\Exception $e) {

            $msg = "Error al calcular el proximo id_sala libre del efector: "
                    .$id_efector;
            
            RI::$error_debug .= $e->getMessage();
            
            throw new \Exception($msg);
            
        }
        
                
        return $id_sala[0];
        
    }
    
    public function getProximoNroSala(
            $id_efector){
        
        $sql = 
                "SELECT "
                    ."servicios_get_proximo_nro_sala(:id_efector) AS proximo_nro_sala ";
                
        // prepare sql
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->bindValue("id_efector", $id_efector);
        
        try {
        
            // ejecuta consulta
            $stmt->execute();
            $nro_sala = $stmt->fetchAll();
                        
        } catch (\Exception $e) {

            $msg = "Error al calcular el proximo nro de sala libre del efector: "
                    .$id_efector;
            
            RI::$error_debug .= $e->getMessage();
            
            throw new \Exception($msg);
            
        }
        
                
        return $nro_sala[0];
        
    }
    
}

