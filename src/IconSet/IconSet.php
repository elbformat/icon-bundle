<?php
declare(strict_types=1);

namespace Elbformat\IconBundle\IconSet;

class IconSet
{
    /** @var array<string,string> */
    protected array $items;

    /** @param string[] */
    public function __construct(array $items)
    {
        // Convert to string => string array
        $this->items = array_flip($items);
        array_walk($this->items, fn(&$val, $key) => $val = $key);
    }

    /** @return string[] */
    public function getList(): array
    {
        return $this->items;
    }
}