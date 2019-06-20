<?php

namespace App\Template;

/**
 * Class DynamicTemplate
 */
class DynamicTemplate implements TemplateInterface
{
    /**
     * @var string
     */
    private $content;

    /**
     * @var TemplateInterface
     */
    private $source;

    /**
     * DynamicTemplate constructor.
     * @param string $content
     * @param TemplateInterface $source
     */
    public function __construct(string $content, TemplateInterface $source)
    {
        $this->content = $content;
        $this->source = $source;
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->source->getId();
    }

    /**
     * @inheritDoc
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @inheritDoc
     */
    public function getPlaceholders(): iterable
    {
        return $this->source->getPlaceholders();
    }

    /**
     * @return TemplateInterface
     */
    public function getSource(): TemplateInterface
    {
        return $this->source;
    }
}