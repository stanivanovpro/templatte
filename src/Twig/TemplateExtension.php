<?php

namespace App\Twig;

use App\Renderer;
use App\TemplateLoader\TemplateLoaderInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class TemplateExtension
 */
class TemplateExtension extends AbstractExtension
{
    /**
     * @var TemplateLoaderInterface
     */
    private $loader;

    /**
     * @var Renderer
     */
    private $renderer;

    /**
     * TemplateExtension constructor.
     * @param TemplateLoaderInterface $loader
     * @param Renderer $renderer
     */
    public function __construct(TemplateLoaderInterface $loader, Renderer $renderer)
    {
        $this->loader = $loader;
        $this->renderer = $renderer;
    }

    /**
     * @return array|\Twig\TwigFunction[]
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('templatte_render', function ($id, $context) {
                return $this->renderer->render($this->loader->load($id), $context);
            }, ['is_safe' => ['html']]),
        ];
    }
}