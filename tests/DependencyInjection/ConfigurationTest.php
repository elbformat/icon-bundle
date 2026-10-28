<?php

declare(strict_types=1);

namespace Elbformat\IconBundle\Tests\DependencyInjection;

use Elbformat\IconBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;

class ConfigurationTest extends TestCase
{
    /**
     * @dataProvider validConfigsProvider
     *
     * @param array<string,mixed> $config
     * @param array<string,mixed> $expected
     */
    public function testValidConfigs(array $config, array $expected): void
    {
        $processed = (new Processor())->processConfiguration(new Configuration(), [$config]);
        $this->assertSame($expected, $processed);
    }

    public function validConfigsProvider(): \Generator
    {
        // Short syntax
        yield [
            ['Set_A' => ['clock', 'house']],
            ['Set_A' => ['items' => ['clock', 'house']]],
        ];
        // Explicit items
        yield [
            ['set1' => ['items' => ['clock', 'house']]],
            ['set1' => ['items' => ['clock', 'house']]],
        ];
        // From filesystem
        yield [
            ['set1' => ['folder' => 'icons', 'pattern' => '*.svg']],
            ['set1' => ['folder' => 'icons', 'pattern' => '*.svg', 'items' => []]],
        ];
    }

    public function testEmptyItems(): void
    {
        $this->expectException(InvalidConfigurationException::class);
        (new Processor())->processConfiguration(new Configuration(), [['set1' => ['items' => []]]]);
    }
}
