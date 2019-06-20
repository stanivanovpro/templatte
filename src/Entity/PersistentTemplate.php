<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PersistentTemplate
 *
 * @ORM\Entity()
 */
class PersistentTemplate
{
    /**
     * @var string
     *
     * @ORM\Id()
     * @ORM\Column(type="string")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * Template constructor.
     * @param string $id
     * @param string $content
     */
    public function __construct(string $id, string $content)
    {
        $this->id = $id;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}