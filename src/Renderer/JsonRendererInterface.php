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
 * JSON Renderer interface
 *
 * Defines methods to render variables as JSON.
 *
 * @author Pedro Ferreira <pedro@phower.com>
 */
interface JsonRendererInterface extends RendererInterface
{

    /**
     * Set options.
     *
     * @param int $options
     * @return $this
     */
    public function setOptions($options);

    /**
     * Get options.
     *
     * @return int
     */
    public function getOptions();

    /**
     * Set depth.
     *
     * @param int $depth
     * @return $this
     */
    public function setDepth($depth);

    /**
     * Get depth.
     *
     * @return int
     */
    public function getDepth();
}
