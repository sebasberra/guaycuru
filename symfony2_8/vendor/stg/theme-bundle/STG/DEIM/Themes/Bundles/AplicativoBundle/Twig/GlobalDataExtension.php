<?php

namespace STG\DEIM\Themes\Bundles\AplicativoBundle\Twig;
 
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of GlobalDataExtension
 *
 * @author fbaroni
 */
class GlobalDataExtension extends \Twig_Extension
{
    protected $container;
 
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }   
 
    public function getGlobals()
    {
        return array(
            'pie_pagina_titulo' => $this->container->getParameter('theme_aplicativo.datos_aplicativo.pie_pagina.titulo'),
            'pie_pagina_domicilio' => $this->container->getParameter('theme_aplicativo.datos_aplicativo.pie_pagina.domicilio'),
            'pie_pagina_telefono' => $this->container->getParameter('theme_aplicativo.datos_aplicativo.pie_pagina.telefono'),
            'pie_pagina_copyright' => $this->container->getParameter('theme_aplicativo.datos_aplicativo.pie_pagina.copyright'),
            'encabezado_titulo' => $this->container->getParameter('theme_aplicativo.datos_aplicativo.encabezado.titulo'),
            'encabezado_nombre_dependencia' => $this->container->getParameter('theme_aplicativo.datos_aplicativo.encabezado.nombre_dependencia'),
            'encabezado_nombre_organismo' => $this->container->getParameter('theme_aplicativo.datos_aplicativo.encabezado.nombre_organismo'),
            'webmaster_correo' => $this->container->getParameter('theme_aplicativo.datos_aplicativo.encabezado.webmaster_correo'),
            'path_ayuda' => $this->container->getParameter('theme_aplicativo.datos_aplicativo.encabezado.path_ayuda'),
            'path_logout' => $this->container->getParameter('theme_aplicativo.datos_aplicativo.encabezado.path_logout'),
            'path_home' => $this->container->getParameter('theme_aplicativo.datos_aplicativo.encabezado.path_home'),
        );
    }
 
    public function getName()
    {
        return 'global_data_extension';
    }
}
