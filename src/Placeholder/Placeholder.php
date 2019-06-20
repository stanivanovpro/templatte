<?php

namespace App\Placeholder;

/**
 * Class Placeholder
 */
class Placeholder
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var callable
     */
    private $resolver;

    /**
     * @var bool
     */
    private $required;

    /**
     * Placeholder constructor.
     * @param string $name
     * @param callable $resolver
     * @param bool $required
     */
    public function __construct(string $name, callable $resolver, bool $required = true)
    {
        $this->name = $name;
        $this->resolver = $resolver;
        $this->required = $required;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return callable
     */
    public function getResolver(): callable
    {
        return $this->resolver;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }
}