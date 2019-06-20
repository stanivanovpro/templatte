<?php

namespace App;

use App\Template\TemplateInterface;

/**
 * Class Renderer
 */
class Renderer
{
    /**
     * @param TemplateInterface $template
     * @param array $context
     * @return string
     */
    public function render(TemplateInterface $template, array $context): string
    {
        $resolved = $template->getContent();

        foreach ($template->getPlaceholders() as $placeholder) {
            $resolver = $placeholder->getResolver();
            $resolved = str_replace(sprintf('#%s#',$placeholder->getName()), $resolver($context), $resolved);
        }

        return $resolved;
    }
}