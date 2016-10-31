<?php

namespace Pruebas\AssetsBundle\Twig;
 
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Extension Twig para Red Internacion
 *
 * @author sberra
 */
class RITwigExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface

{
    protected $container;
 
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }   
 
    public function getGlobals()
    {
        return array(
            'pie_pagina_titulo' => $this->container->getParameter('datos_aplicativo_pie_pagina_titulo'),
            'pie_pagina_domicilio' => $this->container->getParameter('datos_aplicativo_pie_pagina_domicilio'),
            'pie_pagina_telefono' => $this->container->getParameter('datos_aplicativo_pie_pagina_telefono'),
            'pie_pagina_copyright' => $this->container->getParameter('datos_aplicativo_pie_pagina_copyright'),
            'encabezado_titulo' => $this->container->getParameter('encabezado_titulo'),
            'encabezado_nombre_dependencia' => $this->container->getParameter('datos_aplicativo_encabezado_nombre_dependencia'),
            'encabezado_nombre_organismo' => $this->container->getParameter('datos_aplicativo_encabezado_nombre_organismo'),
            'webmaster_correo' => $this->container->getParameter('datos_aplicativo_webmaster_correo'),
            'path_ayuda' => $this->container->getParameter('datos_aplicativo_path_ayuda'),
            'path_logout' => $this->container->getParameter('datos_aplicativo_path_logout'),
            'path_home' => $this->container->getParameter('datos_aplicativo_path_home'),
        );
    }
 
    public function getName()
    {
        return 'global_data_extension';
    }
}
