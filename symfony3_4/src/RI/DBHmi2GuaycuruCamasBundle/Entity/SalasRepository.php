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
use Doctrine\ORM\NoResultException;

use RI\DBHmi2GuaycuruCamasBundle\Exception\NoResultExceptionSala;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;

/**
 * **Repositorio del objeto Doctrine Salas**
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
class SalasRepository extends EntityRepository
{
    
    /**
     * Obtiene las salas del efector que estén habilitadas o no según parámetros
     * 
     * @param integer $id_efector ID de efector 
     * @param boolean $baja Habilitada o no habilitada
     * @return Salas
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
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
        
        } catch (NoResultException $nre){
            
            RI::$error_debug .= $e->getMessage();
            
            throw new NoResultExceptionSala($id_efector);
            
        } catch (\Exception $e) {

            RI::$error_debug .= $e->getMessage();
            
            throw $e;
        }
        
        return $salas;
    }
    
    
    /**
     * Obtiene los datos de la sala de un efector con los objetos relacionados
     * inicializados para evitar el LAZY_LOADING de Doctrine
     * 
     * @link http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/tutorials/extra-lazy-associations.html
     * Doctrine 2 - Lazy Loading Associations
     * 
     * @param integer $id_sala
     * @return Salas
     * @throws NoResultExceptionSala
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
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
        
        } catch (NoResultException $nre) {
            
            RI::$error_debug .= $nre->getMessage();
            
            throw new NoResultExceptionSala(0,'',$id_sala);
            
        } catch (\Exception $e) {

            RI::$error_debug .= $e->getMessage();
            
            throw $e;
        }
        
        return $sala;
    }
    
    /**
     * Obtiene los datos de la sala de un efector
     * 
     * @param integer $id_sala
     * @return Salas
     * @throws NoResultExceptionSala
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
    public function findOneByIdSala(
            $id_sala)
    {
                        
        $dql =
            "SELECT "
                ."s "
            ."FROM "
                .RIUtiles::DB_BUNDLE.":Salas s "
            ."WHERE "
                ."s.idSala = :id_sala ";
        
        try{
            
            $query = $this->getEntityManager()->createQuery($dql);
            
            $query->setParameter("id_sala", $id_sala);
            
            $sala = $query->getSingleResult();
        
        } catch (NoResultException $nre) {
            
            RI::$error_debug .= $nre->getMessage();
            
            throw new NoResultExceptionSala(0,'',$id_sala);
            
        } catch (\Exception $e) {

            RI::$error_debug .= $e->getMessage();
            
            throw $e;
        }
        
        return $sala;
    }
    
    /**
     * Obtiene la sala según el ID de servicio_sala pasado como parámetro
     * 
     * @param integer $id_servicio_sala ID de servicio_sala
     * @return Sala
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
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
    
    /**
     * Obtiene la sala buscando por nombre de sala y id de efector
     * NOTA: Si no encuentra el registro lanza una excepción
     * 
     * @param string $nombre_sala Nombre de la sala dentro del efector
     * @param integer $id_efector ID de efector
     * @return Salas
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
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
        
        } catch (NoResultException $nre) {
            
            RI::$error_debug .= $nre->getMessage();
            
            throw new NoResultExceptionSala($id_efector,$nombre_sala);
        
        } catch (\Exception $e) {

            RI::$error_debug .= $e->getMessage();
            
            throw $e;            
        }
        
        return $sala;
    }
    
    /**
     * Obtiene el total de camas (activas y no activas) de la sala
     * 
     * @param integer $id_sala ID de sala
     * 
     * @return integer
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
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
    
    /**
     * Obtiene el total de camas de la sala que estén activas o no activas
     * según los parámetros
     * 
     * @param integer $id_sala ID de sala
     * @param boolean $baja Bandera de cama activa o no activa
     * @return integer
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
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
    
    /**
     * Obtiene el próximo id de sala para el efector pasado como parámetro
     * NOTA: el ID de sala no es un número autoincremental puro, es un 
     * identificativo único a partir de la combinación de ID efector y un 
     * valor autoincremental por efector
     * 
     * @param integer $id_efector ID efector
     * @return integer Próximo ID de sala para el efector
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
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
    
    
    /**
     * Obtiene el próximo nro de sala para el efector pasado como parámetro
     * NOTA: el nro de sala es un valor autoincremental por efector
     * 
     * @param integer $id_efector ID efector
     * @return integer Próximo nro de sala para el efector
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
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

