<?php

declare(strict_types=1);

namespace Elbformat\IconBundle\FieldType\Icon;

use eZ\Publish\SPI\FieldType\Value as ValueInterface;

final class Value implements ValueInterface
{
    private ?string $icon;

    public function __construct(?string $icon = null)
    {
        $this->icon = $icon;
    }

    public function __toString(): string
    {
        return $this->icon ?? '';
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): void
    {
        $this->icon = $icon;
    }
}
