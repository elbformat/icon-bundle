<?php
declare(strict_types=1);

namespace Elbformat\IconBundle\IconSet;

use Symfony\Component\Finder\Finder;

class IconSetManager
{
    /** @var array<string,IconSet> */
    protected array $sets;

    /** array<string,array{?items:string[],?folder:string,?pattern:string} */
    public function __construct(array $configs)
    {
        foreach ($configs as $setName => $setConfig) {
            $items = [];
            if (null !== ($setConfig['items']??null)) {
                $items = $setConfig['items'];
            }
            if (null !== ($setConfig['folder']??null)) {
                $finder = (new Finder())->files()->in($setConfig['folder']);
                if (null !== ($setConfig['pattern']??null)) {
                    $finder = $finder->name($setConfig['pattern']);
                }
                foreach ($finder as $file) {
                    $items[] = $file->getFilename();
                }
            }
            $this->sets[$setName] = new IconSet($items);
        }
    }

    public function getSet(string $name): IconSet
    {
        if (!isset($this->sets[$name])) {
            throw new \InvalidArgumentException('IconSet not found');
        }
        return $this->sets[$name];
    }

    /** @return array<string,string> */
    public function getSetList():array
    {
        // Convert to string => string array
        $sets = array_flip(array_keys($this->sets));
        array_walk($sets, fn(&$val, $key) => $val = $key);
        return $sets;
    }
}