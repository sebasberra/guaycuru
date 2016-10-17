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
            $id_efector,
            &$msg)
    {
        
        
        // check si nombre de cama existe en el efector
        $q =
            "SELECT "
                ."c "
            ."FROM "
                ."DBHmi2GuaycuruCamasBundle:Camas c "
            ."WHERE "
                ."c.nombre = '".$nombre_cama."' "
            ."AND c.idEfector = ".$id_efector." ";
        
        try{
            
            $cama = $this->getEntityManager()->createQuery($q)->getResult();
            
        } catch (\Exception $e) {

            $msg =
                "Error al buscar el nombre de cama en el efector"
                ."<p>".$e->getMessage()."</p>";
            
            // error
            return -1;
        }
        
        return $cama;
    }
}

