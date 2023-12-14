<?php
declare(strict_types=1);

namespace Elbformat\IbexaIconFieldtype\DependencyInjection;

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
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../Resources/config/'));
        $loader->load('services.yaml');
    }

    public function prepend(ContainerBuilder $container)
    {
        // Add template for rendering
        $configFile = __DIR__ . '/../../Resources/config/ezplatform.yaml';
        $config = Yaml::parse(file_get_contents($configFile));
        $container->prependExtensionConfig('ezpublish', $config['ezplatform']);
        // register namespace (as this is not done automatically. Maybe the missing "bundle" in path?)
        $container->prependExtensionConfig('twig', ['paths'=> [__DIR__.'/../../templates' => 'ElbformatIconFieldtype']]);

    }
}