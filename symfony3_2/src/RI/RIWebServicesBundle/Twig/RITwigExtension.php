<?php

namespace RI\RIWebServicesBundle\Twig;
 
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
            'pie_pagina_titulo' => $this->container->getParameter('pie_pagina_titulo'),
            'pie_pagina_domicilio' => $this->container->getParameter('pie_pagina_domicilio'),
            'pie_pagina_telefono' => $this->container->getParameter('pie_pagina_telefono'),
            'pie_pagina_copyright' => $this->container->getParameter('pie_pagina_copyright'),
            'encabezado_titulo' => $this->container->getParameter('encabezado_titulo'),
            'encabezado_nombre_dependencia' => $this->container->getParameter('encabezado_nombre_dependencia'),
            'encabezado_nombre_organismo' => $this->container->getParameter('encabezado_nombre_organismo'),
            'webmaster_correo' => $this->container->getParameter('webmaster_correo'),
            
            'major' => $this->container->getParameter('ri_major'),
            'minor' => $this->container->getParameter('ri_minor'),
            'revision' => $this->container->getParameter('ri_revision'),
            
            'path_sicap_alta_internacion' => $this->container->getParameter('path_sicap_alta_internacion'),
            'path_sicap_ver_internacion' => $this->container->getParameter('path_sicap_ver_internacion'),
            'path_sicap_editar_internacion' => $this->container->getParameter('path_sicap_editar_internacion'),
            'path_sicap_login' => $this->container->getParameter('path_sicap_login'),
            'path_sicap_home' => $this->container->getParameter('path_sicap_home'),
            
            'path_ayuda' => $this->container->getParameter('path_ayuda'),
            'path_acercade' => $this->container->getParameter('path_acercade'),
            'path_contacto' => $this->container->getParameter('path_contacto'),
            'path_login' => $this->container->getParameter('path_logout'),
            'path_logout' => $this->container->getParameter('path_logout'),
            'path_home' => $this->container->getParameter('path_home'),
            
            'path_root_menu' => $this->container->getParameter('path_root_menu'),
        );
    }
 
    public function getName()
    {
        return 'global_data_extension';
    }
}
