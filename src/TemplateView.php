<?php

/**
 * Phower View
 *
 * @version 0.1.0
 * @link https://github.com/phower/view Public Git repository
 * @copyright (c) 2015-2017, Pedro Ferreira <https://phower.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Phower\View;

use Phower\View\Renderer\RendererInterface;
use Phower\View\Renderer\TemplateRendererInterface;

/**
 * TemplateView
 *
 * Implements methods to render variables with a template.
 *
 * @author Pedro Ferreira <pedro@phower.com>
 */
class TemplateView extends AbstractView implements ViewInterface
{

    /**
     * Create new view instance.
     *
     * @param array $variables
     * @param TemplateRendererInterface $renderer
     */
    public function __construct(array $variables = [], TemplateRendererInterface $renderer = null)
    {
        parent::__construct($variables, $renderer);
    }

    /**
     * Set renderer.
     *
     * @param RendererInterface $renderer
     * @return $this
     * @throws Exception\InvalidArgumentException
     */
    public function setRenderer(RendererInterface $renderer)
    {
        if (!$renderer instanceof TemplateRendererInterface) {
            $message = sprintf('Instances of "%s" always require renderer to implement "%s".', __CLASS__, TemplateRendererInterface::class);
            throw new Exception\InvalidArgumentException($message);
        }

        return parent::setRenderer($renderer);
    }
}
