<?php

declare(strict_types=1);

namespace Elbformat\IconBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('elbformat_icon');
        /** @phpstan-ignore-next-line */
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
