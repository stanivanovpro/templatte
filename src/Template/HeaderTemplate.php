<?php

namespace App\Template;

use App\Placeholder\Placeholder;
use Twig\Environment;

/**
 * Class HeaderTemplate
 */
class HeaderTemplate implements TemplateInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * WelcomeTemplate constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return 'header_block';
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): string
    {
        return 'Dashboard header block';
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return 'block';
    }

    /**
     * @inheritDoc
     */
    public function getContent(): string
    {
        return $this->twig->render('block/header_block_default.html.twig');
    }

    /**
     * @inheritDoc
     */
    public function getPlaceholders(): iterable
    {
        return [
            new Placeholder(
                'title',
                function ($context) {
                    return $context['title'];
                },
            )
        ];
    }

    /**
     * @inheritDoc
     */
    public function getExampleContext(): array
    {
        return [
            'title' => 'Templatte'
        ];
    }
}