<?php

namespace App\TemplateLoader;

use App\Template\TemplateInterface;

/**
 * Class AggregateTemplateLoader
 */
class AggregateTemplateLoader implements TemplateLoaderInterface
{
    /**
     * @var TemplateLoaderInterface[]
     */
    private $loaders;

    /**
     * AggregateTemplateLoader constructor.
     * @param TemplateLoaderInterface[] $loaders
     */
    public function __construct($loaders)
    {
        $this->loaders = $loaders;
    }

    /**
     * @param string $id
     * @return TemplateInterface|null
     */
    public function load(string $id): ?TemplateInterface
    {
        foreach (array_reverse($this->loaders) as $loader)
        {
            if ($template = $loader->load($id)) {
                return $template;
            }
        }

        return null;
    }

    /**
     * @return iterable
     */
    public function loadAll(): iterable
    {
        $loaded = [];

        foreach ($this->loaders as $loader) {
            $loaded = array_merge($loaded, $loader->loadAll());
        }

        return $loaded;
    }
}