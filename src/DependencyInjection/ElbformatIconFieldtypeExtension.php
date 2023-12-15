<?php
declare(strict_types=1);

namespace Elbformat\IbexaIconFieldtype\DependencyInjection;

use Elbformat\IbexaIconFieldtype\IconSet\IconSetManager;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Yaml\Yaml;

class ElbformatIconFieldtypeExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../config/'));
        $loader->load('services.yaml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition(IconSetManager::class);
        $definition->setArgument('$configs', $config);
    }

    public function prepend(ContainerBuilder $container)
    {
        // Add template for rendering
        $configFile = __DIR__.'/../../config/ezplatform.yaml';
        $config = Yaml::parse(file_get_contents($configFile));
        $container->prependExtensionConfig('ezpublish', $config['ezplatform']);

        // Register namespace (as this is not done automatically. Maybe the missing "bundle" in path?)
        $container->prependExtensionConfig('twig', ['paths' => [__DIR__.'/../../templates' => 'ElbformatIconFieldtype']]);

        // Register translations (as this is not done automatically. Maybe the missing "bundle" in path?)
        $container->prependExtensionConfig('framework', ['translator' => ['paths' => [__DIR__.'/../../translations']]]);

    }
}