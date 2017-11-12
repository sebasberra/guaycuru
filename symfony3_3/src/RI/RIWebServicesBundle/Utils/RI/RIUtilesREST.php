<?php

namespace RI\RIWebServicesBundle\Utils\RI;

use Doctrine\ORM\NoResultException;

use RI\DBHmi2GuaycuruCamasBundle\Exception\NoResultExceptionCama;
use RI\DBHmi2GuaycuruCamasBundle\Exception\NoResultExceptionHabitacion;
use RI\DBHmi2GuaycuruCamasBundle\Exception\NoResultExceptionSala;

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
        
        }catch (NoResultException $nre){
            
            throw new NoResultExceptionCama($id_efector,$nombre);
            
        } catch (\Exception $e) {

            throw $e;
        }

        return $cama;
    }
    
    
    /** 
     * Obtiene la habitación que coincida con id_efector, nombre de sala y
     * nombre de habitación
     * Esta función se utiliza para la llamada REST de obtener habitación
     * 
     * @param string $nombre_habitacion Nombre único de habitación en la sala
     * @param string $nombre_sala Nombre único de sala en el efector
     * @param integer $id_efector ID efector
     * @return Habitaciones
     */
    public static function getHabitacionREST(
            $nombre_habitacion, 
            $nombre_sala, 
            $id_efector) {


        $msg = "Error al buscar la habitación: "
                . $nombre_habitacion
                . ", en la sala: "
                . $nombre_sala
                . ", del efector con id: "
                . $id_efector
                . ". ";
        
        // busca la habitacion
        try {

            $dql =
                "SELECT "
                    ."e.idEfector, "
                    ."e.nomEfector, "
                    ."s.nombre AS nombre_sala, "
                    ."h.nombre AS nombre_habitacion, "
                    ."h.sexo,"
                    ."h.edadDesde, "
                    ."h.edadHasta, "
                    ."h.tipoEdad, "
                    ."h.cantCamas, "
                    ."h.baja "
                ."FROM "
                    .RIUtiles::DB_BUNDLE.":Habitaciones h "
                ."INNER JOIN "
                    ."h.idSala s "
                ."INNER JOIN "
                    ."s.idEfector e "
                ."WHERE "
                    ."s.idEfector = :id_efector "
                ."AND s.nombre = :nombre_sala "
                ."AND h.nombre = :nombre_habitacion ";
            
            $query = RI::$em->createQuery($dql);
            
            $query->setParameter("id_efector", $id_efector);
            $query->setParameter("nombre_sala", $nombre_sala);
            $query->setParameter("nombre_habitacion", $nombre_habitacion);
            
            $habitacion = $query->getSingleResult();
        
        }catch (NoResultException $nre){
            
            throw new NoResultExceptionHabitacion(
                    $id_efector,
                    $nombre_sala,
                    $nombre_habitacion);
            
        } catch (\Exception $e) {

            throw $e;
        }


        // unica habitacion con el nombre pasado por parametro en el efector    

        return $habitacion;
    }
    
    /**
     * Obtiene la sala que coincida con id_efector, nombre de sala 
     * Esta función se utiliza para la llamada REST de obtener sala
     * 
     * @param string $nombre_sala Nombre único de sala en el efector
     * @param integer $id_efector ID efector
     * @return Array
     * @throws NoResultException
     * @throws \Exception
     */
    public static function getSalaPorNombreREST(
            $nombre_sala,
            $id_efector){
        
        
        // sala
        try {
        
            $dql =
                "SELECT "
                    ."e.idEfector, "
                    ."e.nomEfector, "
                    ."s.idSala, "
                    ."s.nroSala, "
                    ."s.nombre, "
                    ."s.areaCodServicio, "
                    ."s.areaSector, "
                    ."s.areaSubsector, "
                    ."es.nomServicioEstadistica, "
                    ."s.moverCamas, "
                    ."s.cantCamas,"
                    ."s.baja "
                ."FROM "
                    .RIUtiles::DB_BUNDLE.":Salas s "
                ."INNER JOIN "
                    ."s.idEfector e "
                ."LEFT JOIN "
                    ."s.areaEfectorServicio es "
                ."WHERE "
                    ."s.idEfector = :id_efector "
                ."AND s.nombre = :nombre_sala ";
            
            $query = RI::$em->createQuery($dql);
            
            $query->setParameter("id_efector", $id_efector);
            $query->setParameter("nombre_sala", $nombre_sala);
            
            $sala = $query->getSingleResult();
            
        }catch (NoResultException $nre){
            
            throw new NoResultExceptionSala(
                    $id_efector,
                    $nombre_sala);
            
        } catch (\Exception $e) {

            throw $e;
            
        }
                
        return $sala;
        
    }
}