<?php

namespace RI\DBHmi2GuaycuruCamasBundle\Entity;

use Doctrine\ORM\EntityRepository;

use RI\RIWebServicesBundle\Utils\RI\RIUtiles;


class CamasRepository extends EntityRepository
{
    
    /** Obtiene la cama que coincida con el nombre y id_efector
     *  NOTA: Debe implementarse indice unico (nombre,id_efector)
     *  en la tabla camas
     * 
     * @param type $nombre_cama
     * @param type $id_efector
     * @param string $msg
     * @return type
     */
    public function findOneByNombreIdEfector(
            $nombre_cama,
            $id_efector)
    {
        
        
        // check si nombre de cama existe en el efector
        $dql =
            "SELECT "
                ."c "
            ."FROM "
                .RIUtiles::DB_BUNDLE.":Camas c "
            ."WHERE "
                ."c.nombre = :nombre "
            ."AND c.idEfector = :id_efector ";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("nombre", $nombre_cama);
            $query->setParameter("id_efector", $id_efector);
            
            $cama = $query->getSingleResult();
            
        } catch (\Exception $e) {

            throw $e;
        }
        
        return $cama;
    }
    
    public function findByIdSala(
            $id_sala)
    {
        
        
        // camas por sala
        $dql =
            "SELECT "
                ."c "
            ."FROM "
                .RIUtiles::DB_BUNDLE.":Camas c "
            ."INNER JOIN "
                .RIUtiles::DB_BUNDLE.":Habitaciones h "
            ."WHERE "
                ."h.idSala = :id_sala "
            ."AND c.idHabitacion = h.idHabitacion ";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_sala", $id_sala);
            
            $camas = $query->getResult();
            
        } catch (\Exception $e) {

            throw $e;
        }
        
        return $camas;
    }
    
    public function findByConsultaSET(
            $tipo_cuidado_progresivo,
            $categoria_edad,
            $estado,
            $id_efector,
            $id_sala,
            $id_habitacion){
        
        // camas por sala
        $dql =
            "SELECT "
                ."c, e, cc, h, s "
            ."FROM "
                .RIUtiles::DB_BUNDLE.":Camas c "
            ."INNER JOIN "
                ."c.idEfector e "
            ."INNER JOIN "
                ."c.idClasificacionCama cc "
            ."INNER JOIN "
                ."c.idHabitacion h "
            ."LEFT JOIN "
                ."h.idSala s "
            ."WHERE "
                ."c.idEfector = e.idEfector "
            ."AND c.idClasificacionCama = cc.idClasificacionCama "
            ."AND c.idHabitacion = h.idHabitacion "
            ."AND h.idSala = s.idSala ";
            
        
        try{
            
            
            
            if ($tipo_cuidado_progresivo!='-1'){
            
                $dql.='AND cc.tipoCuidadoProgresivo = :tipo_cuidado_progresivo ';
            }
            
            if ($categoria_edad!='-1'){
            
                $dql.='AND cc.categoriaEdad = :categoria_edad ';
            }
            
            if ($estado!='-1'){
                
                $dql.='AND c.estado = :estado ';
            }
            
            if ($id_efector!='-1'){
                
                $dql.='AND c.idEfector = :id_efector ';
            }
            
            if ($id_sala!='-1'){
                
                $dql.='AND h.idSala = :id_sala ';
            }
            
            if ($id_habitacion!='-1'){
                
                $dql.='AND h.idHabitacion = :id_habitacion ';
            }
            
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            
            if ($tipo_cuidado_progresivo!='-1'){
            
                $query->setParameter("tipo_cuidado_progresivo", $tipo_cuidado_progresivo);
            }
            
            if ($categoria_edad!='-1'){
            
                $query->setParameter("categoria_edad", $categoria_edad);
            }
            
            if ($estado!='-1'){
                
                $query->setParameter("estado", $estado);
            }
            
            if ($id_efector!='-1'){
                
                $query->setParameter("id_efector", $id_efector);
            }
            
            if ($id_sala!='-1'){
                
                $query->setParameter("id_sala", $id_sala);
            }
            
            if ($id_habitacion!='-1'){
                
                $query->setParameter("id_habitacion", $id_habitacion);
            }
            
            $camas = $query->getResult();
            
        } catch (\Exception $e) {

            throw $e;
        }
        
        return $camas;
        
    }
    
    public function findByIdEfectorOptimizado(
            $id_efector){
        
        // camas por sala
        $dql =
            "SELECT "
                ."c, cc, h, s "
            ."FROM "
                .RIUtiles::DB_BUNDLE.":Camas c "
            ."INNER JOIN "
                ."c.idClasificacionCama cc "
            ."INNER JOIN "
                ."c.idHabitacion h "
            ."LEFT JOIN "
                ."h.idSala s "
            ."WHERE "
                ."c.idEfector = :id_efector "
            ."AND c.idClasificacionCama = cc.idClasificacionCama "
            ."AND c.idHabitacion = h.idHabitacion "
            ."AND h.idSala = s.idSala "
            ."AND c.baja = 0 ";
            
        
        try{
            
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_efector", $id_efector);
            
            $camas = $query->getResult();
            
        } catch (\Exception $e) {

            throw $e;
        }
        
        return $camas;
        
    }
}

