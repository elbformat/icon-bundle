<?php

declare(strict_types=1);

namespace Elbformat\IconBundle\DependencyInjection;

use Elbformat\IconBundle\IconSet\IconSetManager;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Yaml\Yaml;

class ElbformatIconExtension extends Extension implements PrependExtensionInterface
{
    /** @param array<mixed> $configs */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../config/'));
        $loader->load('services.yaml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition(IconSetManager::class);
        $definition->setArgument('$configs', $config);
    }

    public function prepend(ContainerBuilder $container): void
    {
        // Add template for rendering
        $ibexaConfigFileName = __DIR__.'/../../config/ibexa.yaml';
        $ibexaConfigFile = file_get_contents($ibexaConfigFileName);
        if (false === $ibexaConfigFile) {
            throw new \RuntimeException(sprintf('%s not found or not readable', $ibexaConfigFileName));
        }
        /** @var array{'ibexa':array<string,mixed>} $ibexaConfig */
        $ibexaConfig = Yaml::parse($ibexaConfigFile);
        $container->prependExtensionConfig('ibexa', $ibexaConfig['ibexa']);
        $container->addResource(new FileResource($ibexaConfigFileName));

        // Register translations (as this is not done automatically. Maybe the missing "bundle" in path?)
        $container->prependExtensionConfig('framework', ['translator' => ['paths' => [__DIR__.'/../../translations']]]);
    }
}
