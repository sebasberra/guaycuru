<?php

namespace Pruebas\DBHmi2GuaycuruCamasBundle\Entity;

use Doctrine\ORM\EntityRepository;

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
                ."DBHmi2GuaycuruCamasBundle:Camas c "
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
}

