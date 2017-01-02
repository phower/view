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
     * @param Renderer\JsonRendererInterface $renderer
     */
    public function __construct(array $variables = [], Renderer\JsonRendererInterface $renderer = null)
    {
        if ($renderer === null) {
            $renderer = new Renderer\JsonRenderer();
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
    public function setRenderer(Renderer\RendererInterface $renderer)
    {
        if (!$renderer instanceof Renderer\JsonRendererInterface) {
            $message = sprintf('Instances of "%s" always require renderer to implement "%s".', __CLASS__, Renderer\JsonTemplateRendererInterface::class);
            throw new Exception\InvalidArgumentException($message);
        }

        return parent::setRenderer($renderer);
    }
}