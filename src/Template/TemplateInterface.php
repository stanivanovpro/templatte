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
    public function getDescription(): string;

    /**
     * @return string
     */
    public function getContent(): string;

    /**
     * @return Placeholder[]|iterable
     */
    public function getPlaceholders(): iterable;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return array
     */
    public function getExampleContext(): array;
}