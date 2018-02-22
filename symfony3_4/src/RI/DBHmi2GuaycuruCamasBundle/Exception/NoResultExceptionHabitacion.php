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
namespace RI\DBHmi2GuaycuruCamasBundle\Exception;

use Doctrine\ORM\UnexpectedResultException;

/**
 * **Extiende UnexpectedResultException para habitación**
 * 
 * Se utiliza esta excepción para identificar los casos donde se realice 
 * una búsqueda de habitación y no se encuentre el registro
 * 
 * @api *Librería de acceso a la base de datos centralizada del sistema de camas críticas de internación*
 * 
 * @author Sebastián Berra <sebasberra@yahoo.com.ar>
 *  
 * @link http://www.doctrine-project.org
 * Doctrine Project
 * 
 */
class NoResultExceptionHabitacion extends UnexpectedResultException{
    
    /**
     * Constructor.
     */
    public function __construct($id_efector, $nombre_sala, $nombre_habitacion)
    {
        $msg = 
                'El nombre de habitación: ['
                .$nombre_habitacion.'] '
                .'no existe en la sala: ['
                .$nombre_sala.'] '
                .'del efector: ['
                .$id_efector.']';
        
        parent::__construct($msg);
    }
}