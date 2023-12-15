<?php
declare(strict_types=1);

namespace Elbformat\IbexaIconFieldtype\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('elbformat_icon_fieldtype');

        $treeBuilder->getRootNode()
            ->arrayPrototype() // Name of the set
                ->normalizeKeys(false)
                ->children()
                    ->arrayNode('items') // Fix list
                        ->requiresAtLeastOneElement()
                        ->normalizeKeys(false)
                        ->scalarPrototype()->end()
                    ->end()
                    ->scalarNode('folder')->end() // Path to look in
                    ->scalarNode('pattern')->end() // Glob expression
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}