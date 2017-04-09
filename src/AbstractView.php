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
 * AbstractView
 *
 * Implements common methods to a view instance.
 *
 * @author Pedro Ferreira <pedro@phower.com>
 */
abstract class AbstractView implements ViewInterface
{

    /**
     * @var array
     */
    private $variables;

    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     * Create a new view instance.
     *
     * @param array $variables
     * @param RendererInterface $renderer
     */
    public function __construct(array $variables = [], RendererInterface $renderer = null)
    {
        $this->variables = $variables;
        $this->renderer = $renderer;
    }

    /**
     * Set value for variable with a given name.
     *
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set($name, $value)
    {
        $this->variables[$name] = $value;
    }

    /**
     * Retrieve value of variable with a given name.
     *
     * @param string $name
     * @return mixed
     * @throws Exception\InvalidArgumentException
     */
    public function __get($name)
    {
        if (!array_key_exists($name, $this->variables)) {
            throw new Exception\InvalidArgumentException('Property with name "_" is not set.');
        }

        return $this->variables[$name];
    }

    /**
     * Check if a variable is set.
     *
     * @param string $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->variables[$name]);
    }

    /**
     * Unset existing variable.
     *
     * @param string $name
     * @return void
     */
    public function __unset($name)
    {
        unset($this->variables[$name]);
    }

    /**
     * Set variables from an associative array.
     *
     * @param array $variables
     * @return $this
     */
    public function setVariables(array $variables)
    {
        $this->variables = [];

        foreach ($variables as $name => $value) {
            $this->$name = $value;
        }

        return $this;
    }

    /**
     * Retrieve all variables in an associative array.
     *
     * @return array
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * Set the renderer.
     *
     * @param RendererInterface $renderer
     * @return $this
     */
    public function setRenderer(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        return $this;
    }

    /**
     * Get the renderer.
     *
     * @return RendererInterface
     */
    public function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * Output the rendered variables.
     *
     * @return string
     */
    public function render()
    {
        return $this->renderer->render($this->variables);
    }

    /**
     * Capture the result of another rendered view into a variable of
     * the current view.
     *
     * @param string $variable
     * @param ViewInterface $view
     * @return $this
     */
    public function capture($variable, ViewInterface $view)
    {
        $this->$variable = $view->render();
        return $this;
    }
}
