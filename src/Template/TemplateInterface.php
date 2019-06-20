<?php

namespace App\Template;

use App\Placeholder\Placeholder;

/**
 * Interface TemplateInterface
 */
interface TemplateInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getContent(): string;

    /**
     * @return Placeholder[]|iterable
     */
    public function getPlaceholders(): iterable;

    /**
     * @return array
     */
    public function getExampleContext(): array;
}