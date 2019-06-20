<?php

namespace App\TemplateLoader;

use App\Template\TemplateInterface;

/**
 * Interface TemplateLoaderInterface
 */
interface TemplateLoaderInterface
{
    /**
     * @param string $id
     * @return TemplateInterface|null
     */
    public function load(string $id): ?TemplateInterface;

    /**
     * @return TemplateInterface[]
     */
    public function loadAll(): iterable;
}