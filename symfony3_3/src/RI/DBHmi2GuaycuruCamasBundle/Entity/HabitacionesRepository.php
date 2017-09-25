<?php
/**
 * Proyecto Final Ingeniería Informática 2017 - UNL - Santa Fe - Argentina
 * 
 * Web Services Plataforma Web para centralización de camas críticas de internación en hospitales de la Provincia de Santa Fe
 * 
 * @author Sebastián Berra <sebasberra@yahoo.com.ar>
 * 
 * @version 0.1.0
 */
namespace RI\DBHmi2GuaycuruCamasBundle\Entity;

use Doctrine\ORM\EntityRepository;

use RI\RIWebServicesBundle\Utils\RI\RIUtiles;

/**
 * **Repositorio del objeto Doctrine Habitaciones**
 * 
 * @api *Librería de acceso a la base de datos centralizada del sistema de camas críticas de internación*
 * 
 * @author Sebastián Berra <sebasberra@yahoo.com.ar>
 *  
 * @link http://www.doctrine-project.org
 * Doctrine Project
 * 
 * @link https://symfony.com/doc/current/doctrine.html
 * Symfony - Databases and the Doctrine ORM
 *
 */
class HabitacionesRepository extends EntityRepository
{
    
    /**
     * Obtiene todas las habitaciones del efector pasado como parámetro
     * 
     * @param integer $id_efector ID de efector
     * @return Habitaciones
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
    public function findByIdEfector(
            $id_efector)
    {
                        
        $dql =
            "SELECT "
                ."h "
            ."FROM "
                .RIUtiles::DB_BUNDLE.":Habitaciones h "
            ."INNER JOIN "
                .RIUtiles::DB_BUNDLE.":Salas s "
            ."WHERE "
                ."s.idEfector = :id_efector "
            ."AND s.idSala = h.idSala ";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_efector", $id_efector);
            
            $habitaciones = $query->getResult();
            
        } catch (\Exception $e) {

            throw $e;
        }
        
        return $habitaciones;
    }
    
    
    /**
     * Se utiliza esta consulta para obtener los datos de las habitaciones de un efector
     * e inicializar los objetos relacionados a cada habitación para evitar 
     * el LAZY_LOADING de Doctrine
     * 
     * @link http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/tutorials/extra-lazy-associations.html
     * Doctrine 2 - Lazy Loading Associations
     * 
     * @param integer $id_efector ID de efector
     * 
     * @return Habitaciones
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
    public function findByIdEfectorConAsociaciones(
            $id_efector)
    {
                        
        $dql =
            "SELECT "
                ."h, s "
            ."FROM "
                .RIUtiles::DB_BUNDLE.":Habitaciones h "
            ."INNER JOIN "
                ."h.idSala s "
            ."WHERE "
                ."s.idEfector = :id_efector "
            ."AND s.idSala = h.idSala ";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_efector", $id_efector);
            
            $habitaciones = $query->getResult();
            
        } catch (\Exception $e) {

            throw $e;
        }
        
        return $habitaciones;
    }
    
    
    /**
     * Obtiene la habitación según la cama pasada como parámetro
     * 
     * @param integer $id_cama ID de cama
     * @return Habitaciones
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
    public function findByIdCama(
            $id_cama)
    {
                        
        $dql =
            "SELECT "
                ."h "
            ."FROM "
                .RIUtiles::DB_BUNDLE.":Habitaciones h "
            ."INNER JOIN "
                .RIUtiles::DB_BUNDLE.":Camas c "
            ."WHERE "
                ."c.idCama = :id_cama "
            ."AND c.idHabitacion = h.idHabitacion ";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_cama", $id_cama);
            
            $habitacion = $query->getSingleResult();
            
        } catch (\Exception $e) {

            throw $e;
        }
        
        return $habitacion;
    }
    
    /** 
     * Obtiene la habitación que coincida con el
     * nombre sala y habitación y id_efector pasados por parámetro
     * NOTA: se recomienda utilizar nombres únicos de habitaciones
     * por efector, pero no se implementará restricción de índice único
     * 
     * @param integer $id_efector ID de efector
     * @param string $nombre_sala Sala donde se encuentra la habitación
     * @param string $nombre_habitacion Nombre de habitación
     * 
     * @return Habitaciones
     *
     * @throws \Exception Si la sala no existe, la habitación no existe o
     * si hay más de un registro que coincida con el filtro de búsqueda
     */
    public function findOneByNombreSalaIdEfector(
            $id_efector,
            $nombre_sala,
            $nombre_habitacion)
    {
        
        // check sala existe
        $dql =
            "SELECT "
                ."s "
            ."FROM "
                .RIUtiles::DB_BUNDLE.":Salas s "
            ."WHERE "
                ."s.idEfector = :id_efector "
            ."AND s.nombre = :nombre_sala ";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_efector",$id_efector);
            $query->setParameter("nombre_sala",$nombre_sala);
            
            // exec query para chequear que exista la sala
            $query->getSingleResult();
            
        } catch (\Exception $e) {

            throw $e;            
        }
        
        // trae habitacion o habitaciones con el nombre y id_efector
        // pasados por parametro 
        $dql =
            "SELECT "
                ."h "
            ."FROM "
                .RIUtiles::DB_BUNDLE.":Habitaciones h "
            ."INNER JOIN "
                .RIUtiles::DB_BUNDLE.":Salas s "
            ."WHERE "
                ."h.nombre = :nombre_habitacion "
            ."AND s.idEfector = :id_efector "
            ."AND s.nombre = :nombre_sala "
            ."AND h.idSala = s.idSala";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_efector",$id_efector);
            $query->setParameter("nombre_sala",$nombre_sala);
            $query->setParameter("nombre_habitacion",$nombre_habitacion);
            
            
            $habitaciones = $query->getSingleResult();
            
        } catch (\Exception $e) {

            throw $e;            
        }
        
        return $habitaciones;
    }
    
    /**
     * Obtiene la cantidad de camas de la habitación
     * 
     * @param integer $id_habitacion Id de habitación
     * @param boolean $baja Cuenta la camas habilitados o deshabilitadas según parámetro
     * 
     * @return integer Cantidad de camas
     * 
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
    public function countCamas(
            $id_habitacion,
            $baja){
        
        $dql = 
                "SELECT "
                    ."COUNT(c.idCama) "
                ."FROM "
                    .RIUtiles::DB_BUNDLE.":Camas c "
                ."WHERE "
                   ." c.idHabitacion = :id_habitacion "
                ."AND c.baja = :baja";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_habitacion", $id_habitacion);
            $query->setParameter("baja", $baja);

            $count = $query->getSingleScalarResult();
            
        } catch (\Exception $e) {

            throw $e;            
            
        }
        
        return $count;
        
    }
    
    /**
     * Obtiene la cantidad de camas de la habitación estén habilitadas o no
     * 
     * @param integer $id_habitacion ID de habitación
     * @return integer Cantidad de camas
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
    public function countCamasTodas(
            $id_habitacion){
        
        $dql = 
                "SELECT "
                    ."COUNT(c.idCama) "
                ."FROM "
                    .RIUtiles::DB_BUNDLE.":Camas c "
                ."WHERE "
                   ." c.idHabitacion = :id_habitacion ";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_habitacion", $id_habitacion);
            
            $count = $query->getSingleScalarResult();
            
        } catch (\Exception $e) {

            throw $e;            
            
        }
        
        return $count;
        
    }
}

