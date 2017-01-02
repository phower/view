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
     * @throws Exception\RuntimeException
     * @throws \Throwable
     * @throws \Exception
     */
    public function render(array $variables);
}
