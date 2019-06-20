<?php

namespace App\TemplateLoader;

use App\Template\TemplateInterface;

/**
 * Class SourceTemplateLoader
 */
class SourceTemplateLoader implements TemplateLoaderInterface
{
    /**
     * @var TemplateInterface[]
     */
    private $templates;

    /**
     * DefaultTemplateLoader constructor.
     * @param TemplateInterface[] $templates
     */
    public function __construct($templates)
    {
        $this->templates = $templates;
    }

    /**
     * @inheritDoc
     */
    public function load(string $id): ?TemplateInterface
    {
        return $this->templates[$id] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function loadAll(): iterable
    {
        return $this->templates;
    }
}