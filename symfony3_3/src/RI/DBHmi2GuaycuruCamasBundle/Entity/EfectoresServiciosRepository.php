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

use RI\DBHmi2GuaycuruCamasBundle\Exception\NoResultExceptionCodigoServicio;

use RI\RIWebServicesBundle\Utils\RI\RIUtiles;

/**
 * **Repositorio del objeto Doctrine EfectoresServicios**
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
class EfectoresServiciosRepository extends EntityRepository
{
    
    /**
     * Obtiene los servicios de internación activos del efector pasado como
     * parámetro
     * 
     * @param integer $id_efector ID efector
     * @return EfectoresServicios
     * @throws \Exception Las excepciones son capturadas y relanzadas
     * 
     */
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
    
    /**
     * Obtiene el servicio activo según la consulta pasada como parámetro o
     * lanza una excepción si el registro no existe
     * 
     * @param integer $id_efector ID efector
     * @param type $cod_servicio Código nuclear de servicios de nación vigente desde 2008
     * @param type $sector 1=varones; 2=mujeres; 3=mixto; >3 especificación
     * @param type $subsector 4=internación; 5=CE; 6=atención domiciliaria
     * @return EfectoresServicios
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
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
        
        } catch (NoResultException $nre) {

            throw new NoResultExceptionCodigoServicio(
                    $id_efector,
                    $cod_servicio,
                    $sector,
                    $subsector);
            
        
        } catch (\Exception $e) {

            throw $e;
        }
        
        return $efectores_servicios;
        
    }
}

