<?php

declare(strict_types=1);

namespace Elbformat\IconBundle\Test\FieldType\Icon;

use Elbformat\IconBundle\FieldType\Icon\Value;
use PHPUnit\Framework\TestCase;

class ValueTest extends TestCase
{
    public function testAccess(): void
    {
        $value = new Value('icon1');
        $this->assertSame('icon1', $value->getIcon());
        $this->assertSame('icon1', (string) $value);
        $value->setIcon(null);
        $this->assertNull($value->getIcon());
        $this->assertSame('', (string) $value);
        $value->setIcon('value2');
        $this->assertSame('value2', $value->getIcon());
        $this->assertSame('value2', (string) $value);
    }
}
