<?php
namespace STG\DEIM\Themes\Bundles\AplicativoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('theme_aplicativo');
        
        $datosAplicativoNode = $rootNode->children()->arrayNode('datos_aplicativo');
        $rootNode->append($datosAplicativoNode)->end();
        
        $this->addEncabezadoSection($datosAplicativoNode);
        $this->addPieDePaginaSection($datosAplicativoNode);
        
        return $treeBuilder;
    }

    private function addEncabezadoSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode->children()
                ->arrayNode('encabezado')
                    ->isRequired()
                    ->info('Configuración de datos del encabezado del aplicativo.')
                    ->children()
                        ->scalarNode('titulo')
                        ->end()
                        ->scalarNode('nombre_dependencia')
                        ->end()
                        ->scalarNode('nombre_organismo')
                        ->end()
                        ->scalarNode('webmaster_correo')
                        ->end()
                        ->scalarNode('path_ayuda')
                        ->end()
                        ->scalarNode('path_home')
                        ->end()
                        ->scalarNode('path_logout')
                        ->end()
                    ->end()
                ->end();
    }

    private function addPieDePaginaSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode->children()
                ->arrayNode('pie_pagina')
                    ->isRequired()
                    ->info('Configuración de datos del pie de página.')
                    ->children()
                        ->scalarNode('titulo')
                        ->end()
                        ->scalarNode('domicilio')
                        ->end()
                        ->scalarNode('telefono')
                        ->end()
                        ->scalarNode('copyright')
                        ->end()
                    ->end()
                ->end();
    }
}