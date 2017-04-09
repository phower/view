<?php

/**
 * Phower View
 *
 * @version 1.0.0
 * @link https://github.com/phower/view Public Git repository
 * @copyright (c) 2015-2017, Pedro Ferreira <https://phower.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Phower\View;

use Phower\View\Renderer\JsonRenderer;
use Phower\View\Renderer\JsonRendererInterface;
use Phower\View\Renderer\RendererInterface;

/**
 * TemplateView
 *
 * Implements methods to render variables as JSON.
 *
 * @author Pedro Ferreira <pedro@phower.com>
 */
class JsonView extends AbstractView implements ViewInterface
{

    /**
     * Create new view instance.
     *
     * @param array $variables
     * @param JsonRendererInterface $renderer
     */
    public function __construct(array $variables = [], JsonRendererInterface $renderer = null)
    {
        if ($renderer === null) {
            $renderer = new JsonRenderer();
        }

        parent::__construct($variables, $renderer);
    }

    /**
     * Set renderer.
     *
     * @param Renderer\RendererInterface $renderer
     * @return $this
     * @throws Exception\InvalidArgumentException
     */
    public function setRenderer(RendererInterface $renderer)
    {
        if (!$renderer instanceof JsonRendererInterface) {
            $message = sprintf('Instances of "%s" always require renderer to implement "%s".', __CLASS__, JsonTemplateRendererInterface::class);
            throw new Exception\InvalidArgumentException($message);
        }

        return parent::setRenderer($renderer);
    }
}
