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
 * **Repositorio del objeto Doctrine Camas**
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
class CamasRepository extends EntityRepository
{
    
    /** 
     * Obtiene la cama que coincida con el nombre y id_efector
     * NOTA: Debe implementarse índice único (nombre,id_efector)
     * en la tabla camas
     * 
     * @param string $nombre_cama Nombre de la cama a buscar
     * @param integer $id_efector ID efector donde pertenece la cama
     * 
     * @return Camas
     * @throws \Exception Las excepciones son capturadas y relanzadas
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
    
    /**
     * Obtiene todas las camas de la sala
     * 
     * @param integer $id_sala
     * @return Camas
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
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
    
    /**
     * Obtiene los resultados de la consulta de camas que se utiliza en la
     * página de la SET (Secretaría de Emergencias y Traslados). Los parámetros
     * que no se setean no se utilizan en el filtro de búsqueda
     * 
     * @param integer $tipo_cuidado_progresivo 0 = cuidado moderado; 1= cuidado intermedio ; 2=cuidado crítico
     * @param string $categoria_edad ADU= adulto (>14 a); PED= pediatrica (>28 d y <14 a); NEO= neonatologica (<28 d)
     * @param string $estado L=libre; O=ocupada; F=fuera de servicio; R=en reparacion; V=reservada
     * @param integer $id_efector ID de efector
     * @param integer $id_sala ID de sala
     * @param integer $id_habitacion ID de habitación
     * 
     * @return Camas
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
    public function findByConsultaSET(
            $tipo_cuidado_progresivo=-1,
            $categoria_edad=-1,
            $estado=-1,
            $id_efector=-1,
            $id_sala=-1,
            $id_habitacion=-1){
        
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
    
    /**
     * Se utiliza esta consulta para obtener los datos de las camas de un efector
     * e inicializar los objetos relacionados a cada cama para evitar 
     * el LAZY_LOADING de Doctrine
     * 
     * @link http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/tutorials/extra-lazy-associations.html
     * Doctrine 2 - Lazy Loading Associations
     * 
     * @param integer $id_efector ID de efector
     * 
     * @return Camas
     * @throws \Exception Las excepciones son capturadas y relanzadas
     */
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

