<?php

/**
 * Phower View
 *
 * @version 1.0.0
 * @link https://github.com/phower/view Public Git repository
 * @copyright (c) 2015-2017, Pedro Ferreira <https://phower.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Phower\View\Renderer;

/**
 * Renderer interface
 *
 * Defines methods to render output of variables.
 *
 * @author Pedro Ferreira <pedro@phower.com>
 */
interface RendererInterface
{

    /**
     * Output view with interpolated variables.
     *
     * @param array $variables
     * @return string
     * @throws \Phower\View\Exception\RuntimeException
     * @throws \Throwable
     * @throws \Exception
     */
    public function render(array $variables = []);
}
