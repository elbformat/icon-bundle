<?php

declare(strict_types=1);

namespace Elbformat\IconBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ElbformatIconBundle extends Bundle
{
    public function getPath(): string
    {
        $path = realpath(__DIR__.'/..');
        return false !== $path ? $path : __DIR__.'/..';
    }

}
