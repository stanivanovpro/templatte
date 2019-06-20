<?php

namespace App\Template;

use App\Placeholder\Placeholder;
use Twig\Environment;

/**
 * Class FooterTemplate
 */
class FooterTemplate implements TemplateInterface
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
        return 'footer_block';
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): string
    {
        return 'Dashboard footer block';
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
        return $this->twig->render('block/footer_block_default.html.twig');
    }

    /**
     * @inheritDoc
     */
    public function getPlaceholders(): iterable
    {
        return [
            new Placeholder(
                'time',
                function ($context) {
                    return $context['time'];
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
            'time' => date('m/d/Y H:i:s')
        ];
    }
}