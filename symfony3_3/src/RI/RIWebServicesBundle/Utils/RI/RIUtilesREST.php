<?php

namespace RI\RIWebServicesBundle\Utils\RI;


trait RIUtilesREST{
    
    /** 
     * Obtiene la cama que coincida con el nombre y id_efector
     * Esta función se utiliza para la llamada REST de obtener cama
     * 
     * @param string $nombre Nombre de la cama a buscar
     * @param integer $id_efector ID efector donde pertenece la cama
     * 
     * @return Camas
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
    public static function getCamaREST(
            $nombre, 
            $id_efector) {

        // cama
        try {
            
            $dql =
                "SELECT "
                    ."e.idEfector,"
                    ."e.nomEfector,"
                    ."c.nombre, "
                    ."cc.abreviatura, "
                    ."cc.categoriaEdad, "
                    ."cc.clasificacionCama, "
                    ."c.estado, "
                    ."c.rotativa, "
                    ."c.baja "
                ."FROM "
                    .RIUtiles::DB_BUNDLE.":Camas c "
                ."INNER JOIN "
                    ."c.idEfector e "
                ."INNER JOIN "
                    ."c.idClasificacionCama cc "
                ."WHERE "
                    ."c.nombre = :nombre "
                ."AND c.idEfector = :id_efector ";
            
            $query = RI::$em->createQuery($dql);
            
            $query->setParameter("nombre", $nombre);
            $query->setParameter("id_efector", $id_efector);
            
            $cama = $query->getSingleResult();
            //dump($cama);die();
        } catch (NoResultException $nre) {

            $msg = "La cama: "
                    . $nombre
                    . " no existe en el efector: "
                    . $id_efector;

            RI::$error_debug .= " Función getCamaREST: "
                    . $nre->getMessage();

            throw new NoResultException($msg);
            
        } catch (\Exception $e) {

            $msg = "Error al buscar la cama: "
                    . $nombre
                    . " en el efector con id: "
                    . $id_efector;

            RI::$error_debug .= " Función getCamaREST: "
                    . $e->getMessage();

            throw new \Exception($msg);
        }

        return $cama;
    }
    
}