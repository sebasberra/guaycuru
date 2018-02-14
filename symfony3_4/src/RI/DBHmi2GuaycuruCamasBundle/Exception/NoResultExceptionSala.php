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
 * **Extiende UnexpectedResultException para Salas**
 * 
 * Se utiliza esta excepción para identificar los casos donde se realice 
 * una búsqueda de sala y no se encuentre el registro
 * 
 * @api *Librería de acceso a la base de datos centralizada del sistema de camas críticas de internación*
 * 
 * @author Sebastián Berra <sebasberra@yahoo.com.ar>
 *  
 * @link http://www.doctrine-project.org
 * Doctrine Project
 * 
 */
class NoResultExceptionSala extends UnexpectedResultException{
    
    /**
     * Constructor.
     */
    public function __construct($id_efector=0, $nombre_sala='',$id_sala=0)
    {
        if ($id_efector==0){
            
            $msg = 
                    'No existe la sala con id: ['
                    .$id_sala.']';
            
        }else{
         
            $msg = 
                    'El nombre de sala: ['
                    .$nombre_sala.'] '
                    .'no existe en el efector: ['
                    .$id_efector.']';
        }
        
        parent::__construct($msg);
    }
}