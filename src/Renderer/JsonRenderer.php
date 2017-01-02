<?php

/**
 * Phower View
 *
 * @version 0.1.0
 * @link https://github.com/phower/view Public Git repository
 * @copyright (c) 2015-2017, Pedro Ferreira <https://phower.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Phower\View\Renderer;

/**
 * JSON Renderer
 *
 * Implements methods to render variables as JSON.
 *
 * @author Pedro Ferreira <pedro@phower.com>
 */
class JsonRenderer implements JsonRendererInterface
{

    /**
     * @var int
     */
    private $options;

    /**
     * @var int
     */
    private $depth;

    /**
     * Create new renderer instance.
     *
     * @link http://php.net/manual/en/function.json-encode.php
     *
     * @param int $options
     * @param int $depth
     */
    public function __construct($options = 0, $depth = 512)
    {
        $this->options = (int) $options;
        $this->depth = (int) $depth;
    }

    /**
     * Set options.
     *
     * @param int $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = (int) $options;
        return $this;
    }

    /**
     * Get options.
     *
     * @return int
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set depth.
     *
     * @param int $depth
     * @return $this
     */
    public function setDepth($depth)
    {
        $this->depth = (int) $depth;
        return $this;
    }

    /**
     * Get depth.
     *
     * @return int
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * Output view with interpolated variables.
     *
     * @param array $variables
     * @return string
     */
    public function render(array $variables = [])
    {
        return json_encode($variables, $this->options, $this->depth);
    }
}
