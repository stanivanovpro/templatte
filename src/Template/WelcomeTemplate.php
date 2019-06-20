<?php

namespace App\Template;

use App\Placeholder\Placeholder;
use Twig\Environment;

/**
 * Class WelcomeTemplate
 */
class WelcomeTemplate implements TemplateInterface
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
        return 'consumer_welcome_email';
    }

    /**
     * @inheritDoc
     */
    public function getContent(): string
    {
        return $this->twig->render('email/welcome_email_default.html.twig');
    }

    /**
     * @inheritDoc
     */
    public function getPlaceholders(): iterable
    {
        return [
            new Placeholder(
                'first_name',
                function ($context) {
                    return $context['first_name'];
                }
            )
        ];
    }
}