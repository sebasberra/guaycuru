<?php

namespace RI\RIWebServicesBundle\Controller\WS;

use FOS\RestBundle\Controller\FOSRestController;



class WSController extends FOSRestController
{
  
    use WSCamasController,
        WSHabitacionesController,
        WSSalasController,
        WSSyncController;
    
}
