<?php

declare(strict_types=1);

namespace Elbformat\IconBundle\Tests\IconSet;

use Elbformat\IconBundle\IconSet\IconSetManager;
use http\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class IconSetManagerTest extends TestCase
{
    /** @dataProvider validConfigsProvider */
    public function testValidConfigs(array $config, array $setList, ?string $setName = null, ?array $iconList = null): void
    {
        $ism = new IconSetManager($config);
        $this->assertSame($setList, $ism->getSetList());
        if (null !== $setName) {
            $this->assertSame($iconList, $ism->getSet($setName)->getList());
        }
    }

    public function validConfigsProvider(): \Generator
    {
        // Simple list
        yield [
            ['set1' => ['items' => ['entry1', 'entry2']]],
            ['set1' => 'set1'],
            'set1',
            ['entry1' => 'entry1', 'entry2' => 'entry2'],
        ];
        // Multiple lists
        yield [
            ['set1' => ['items' => ['entry1', 'entry2']],'set2' => []],
            ['set1' => 'set1', 'set2' => 'set2'],
            'set2',
            [],
        ];
        // List from files
        yield [
            ['set1' => ['folder' => __DIR__.'/../_fixtures/iconlist']],
            ['set1' => 'set1'],
            'set1',
            ['icon1.svg' => 'icon1.svg', 'icon2.png' => 'icon2.png'],
        ];
        // List from files with filter
        yield [
            ['set1' => ['folder' => __DIR__.'/../_fixtures/iconlist', 'pattern' => '*.svg']],
            ['set1' => 'set1'],
            'set1',
            ['icon1.svg' => 'icon1.svg'],
        ];
        // No lists
        yield [[], []];
    }

    public function testInvalidSet(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('IconSet not found');
        $ism = new IconSetManager([]);
        $ism->getSet('nope');
    }
}
