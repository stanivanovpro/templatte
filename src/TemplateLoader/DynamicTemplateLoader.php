<?php

namespace App\TemplateLoader;

use App\Entity\PersistentTemplate;
use App\Repository\PersistentTemplateRepository;
use App\Template\DynamicTemplate;
use App\Template\TemplateInterface;

/**
 * Class DynamicTemplateLoader
 */
class DynamicTemplateLoader implements TemplateLoaderInterface
{
    /**
     * @var PersistentTemplateRepository
     */
    private $repository;

    /**
     * @var SourceTemplateLoader
     */
    private $sourceTemplateLoader;

    /**
     * DynamicTemplateLoader constructor.
     * @param PersistentTemplateRepository $repository
     * @param SourceTemplateLoader $sourceTemplateLoader
     */
    public function __construct(PersistentTemplateRepository $repository, SourceTemplateLoader $sourceTemplateLoader)
    {
        $this->repository = $repository;
        $this->sourceTemplateLoader = $sourceTemplateLoader;
    }

    /**
     * @inheritDoc
     */
    public function load(string $id): ?TemplateInterface
    {
        if (!$persistent = $this->repository->find($id)) {
            return null;
        }

        return $this->combine($persistent);
    }

    /**
     * @inheritDoc
     */
    public function loadAll(): iterable
    {
        $loaded = [];

        /**
         * @var PersistentTemplate $template
         */
        foreach ($this->repository->findAll() as $template) {
            $loaded[$template->getId()] = $this->combine($template);
        }

        return $loaded;
    }

    /**
     * @param PersistentTemplate $template
     * @return DynamicTemplate
     */
    protected function combine(PersistentTemplate $template): DynamicTemplate
    {
        return new DynamicTemplate($template->getContent(), $this->sourceTemplateLoader->load($template->getId()));
    }
}