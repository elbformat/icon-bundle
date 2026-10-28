<?php

declare(strict_types=1);

namespace Elbformat\IconBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('elbformat_icon');
        /** @var ArrayNodeDefinition $rootNode */
        $rootNode = $treeBuilder->getRootNode();
        $set = $rootNode->arrayPrototype()->normalizeKeys(false); // Name of the set
        // Allow short syntax: a plain list of icon names
        $set->beforeNormalization()
            ->ifTrue(static fn (mixed $v): bool => \is_array($v) && [] !== $v && array_is_list($v))
            ->then(static fn (array $v): array => ['items' => $v]);
        $sets = $set->children();
        $sets->arrayNode('items') // Fix list
            ->requiresAtLeastOneElement()
            ->normalizeKeys(false)
            ->scalarPrototype();
        $sets->scalarNode('folder'); // Path to look in
        $sets->scalarNode('pattern'); // Glob expression

        return $treeBuilder;
    }
}
