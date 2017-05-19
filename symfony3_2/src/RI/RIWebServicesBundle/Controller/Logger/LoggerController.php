<?php

namespace RI\RIWebServicesBundle\Controller\Logger;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use RI\RIWebServicesBundle\Utils\Render\Render;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class LoggerController extends Controller
{
    
    use Render,
        LoggerTriggersController,
        LoggerConfigController,
        LoggerConsultaController;
    

}