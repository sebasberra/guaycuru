<?php

namespace STG\DEIM\Themes\Bundles\AplicativoBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ThemeAplicativoExtension extends Extension
{

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        if (!isset($config['datos_aplicativo'])) {
            throw new \InvalidArgumentException('Debe configurar los datos del aplicativo en los archivos de configuración.');
        }

        $this->registerDatosAplicativoConfiguration($config['datos_aplicativo'], $container);
    }

    private function registerDatosAplicativoConfiguration(array $config, ContainerBuilder $container)
    {
        if (!isset($config['encabezado'])) {
            throw new \InvalidArgumentException('Debe configurar los datos del encabezado.');
        }

        if (!isset($config['pie_pagina'])) {
            throw new \InvalidArgumentException('Debe configurar los datos del pie de página.');
        }

        $this->registerEncabezadoConfiguration($config['encabezado'], $container);
        $this->registerPieDePaginaConfiguration($config['pie_pagina'], $container);
    }

    private function registerPieDePaginaConfiguration(array $config, ContainerBuilder $container)
    {
        if (!isset($config['titulo'])) {
            $config['titulo'] = 'Titulo del pie de página';
        }

        if (!isset($config['domicilio'])) {
            $config['domicilio'] = 'Domicilio';
        }

        if (!isset($config['telefono'])) {
            $config['telefono'] = 'Teléfono';
        }

        if (!isset($config['copyright'])) {
            $config['copyright'] = 'Copyright';
        }

        $container->setParameter('theme_aplicativo.datos_aplicativo.pie_pagina.titulo', $config['titulo']);
        $container->setParameter('theme_aplicativo.datos_aplicativo.pie_pagina.domicilio', $config['domicilio']);
        $container->setParameter('theme_aplicativo.datos_aplicativo.pie_pagina.telefono', $config['telefono']);
        $container->setParameter('theme_aplicativo.datos_aplicativo.pie_pagina.copyright', $config['copyright']);
    }

    private function registerEncabezadoConfiguration(array $config, ContainerBuilder $container)
    {
        if (!isset($config['titulo'])) {
            $config['titulo'] = 'Título de encabezado';
        }

        if (!isset($config['nombre_dependencia'])) {
            $config['nombre_dependencia'] = 'Nombre dependencia';
        }

        if (!isset($config['nombre_organismo'])) {
            $config['nombre_organismo'] = 'Nombre organismo';
        }

        if (!isset($config['webmaster_correo'])) {
            $config['webmaster_correo'] = '';
        }

        if (!isset($config['path_ayuda'])) {
            $config['path_ayuda'] = '';
        }

        if (!isset($config['path_logout'])) {
            $config['path_logout'] = '';
        }

        if (!isset($config['path_home'])) {
            $config['path_home'] = '';
        }

        $container->setParameter('theme_aplicativo.datos_aplicativo.encabezado.titulo', $config['titulo']);
        $container->setParameter('theme_aplicativo.datos_aplicativo.encabezado.nombre_dependencia', $config['nombre_dependencia']);
        $container->setParameter('theme_aplicativo.datos_aplicativo.encabezado.nombre_organismo', $config['nombre_organismo']);

        $container->setParameter('theme_aplicativo.datos_aplicativo.encabezado.webmaster_correo', $config['webmaster_correo']);
        $container->setParameter('theme_aplicativo.datos_aplicativo.encabezado.path_ayuda', $config['path_ayuda']);
        $container->setParameter('theme_aplicativo.datos_aplicativo.encabezado.path_logout', $config['path_logout']);
        $container->setParameter('theme_aplicativo.datos_aplicativo.encabezado.path_home', $config['path_home']);
    }

}
