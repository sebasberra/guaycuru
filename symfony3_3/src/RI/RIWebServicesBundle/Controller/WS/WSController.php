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
namespace RI\RIWebServicesBundle\Controller\WS;

use FOS\RestBundle\Controller\FOSRestController;


/**
 * **Controlador principal de los Web Services de ABM y sincronización de la Configuración Edilicia**
 * 
 * 
 * @api *Librería de Web Services para ABM de la Configuración Edilicia Hospitalaria Prov. de Santa Fe*
 * 
 * @author Sebastián Berra <sebasberra@yahoo.com.ar>
 * 
 * @link http://symfony.com/doc/current/bundles/FOSRestBundle/1-setting_up_the_bundle.html 
 * Documentación de FOSRest Bundle de Symfony
 *  
 */
class WSController extends FOSRestController
{
  
    use WSCamasController,
        WSHabitacionesController,
        WSSalasController,
        WSSyncController;
    
}
