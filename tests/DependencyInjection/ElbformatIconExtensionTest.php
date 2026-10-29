<?php

declare(strict_types=1);

namespace Elbformat\IconBundle\Tests\DependencyInjection;

use Elbformat\IconBundle\DependencyInjection\ElbformatIconExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ElbformatIconExtensionTest extends TestCase
{
    /**
     * Referenced services named by a class/interface must exist without any compatibility layer (e.g. legacy eZ classes).
     */
    public function testReferencedServicesExist(): void
    {
        $container = new ContainerBuilder();
        (new ElbformatIconExtension())->load([], $container);

        $references = [];
        foreach ($container->getDefinitions() as $definition) {
            if ($definition->isSynthetic()) {
                continue; // e.g. service_container
            }
            $this->assertTrue(null === $definition->getClass() || class_exists($definition->getClass()), (string) $definition->getClass());
            foreach ($definition->getArguments() as $argument) {
                if ($argument instanceof Reference) {
                    $references[] = (string) $argument;
                }
            }
        }

        $this->assertNotEmpty($references);
        foreach ($references as $id) {
            if (!str_contains($id, '\\')) {
                continue; // Not a FQCN service id (e.g. "twig")
            }
            $this->assertTrue(class_exists($id) || interface_exists($id), \sprintf('Service "%s" does not exist', $id));
            // Legacy names (eZ\...) are only class aliases. Their service ids are not registered without the compatibility layer.
            $this->assertSame((new \ReflectionClass($id))->getName(), $id, 'Service id must not be a class alias');
        }
    }
}
