<?php

declare(strict_types=1);

namespace Elbformat\IconBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ElbformatIconBundle extends Bundle
{
    public function getPath(): string
    {
        return dirname(__DIR__.'/..');
    }

}
