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

/**
 * View interface
 *
 * Defines methods to render a PHP script with variables.
 *
 * @author Pedro Ferreira <pedro@phower.com>
 */
interface ViewInterface
{

    /**
     * Set variables from an associative array.
     *
     * @param array $variables
     * @return $this
     */
    public function setVariables(array $variables);

    /**
     * Retrieve all variables in an associative array.
     *
     * @return array
     */
    public function getVariables();

    /**
     * Set renderer instance.
     *
     * @param RendererInterface $renderer
     * @return $this
     */
    public function setRenderer(RendererInterface $renderer);

    /**
     * Get renderer instance.
     *
     * @return RendererInterface
     */
    public function getRenderer();

    /**
     * Render view with current variables.
     *
     * @return string
     * @throws Exception\RuntimeException
     * @throws \Throwable
     * @throws \Exception
     */
    public function render();

    /**
     * Capture the result of another rendered view into a variable of
     * the current view.
     *
     * @param string $variable
     * @param ViewInterface $view
     * @return $this
     */
    public function capture($variable, ViewInterface $view);
}
