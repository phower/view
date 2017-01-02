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
 * Renderer interface
 *
 * Defines methods to render a PHP template script with variables.
 *
 * @author Pedro Ferreira <pedro@phower.com>
 */
interface TemplateRendererInterface extends RendererInterface
{

    /**
     * Set template name.
     *
     * @param string $template
     * @return \Phower\View\Renderer\TemplateRendererInterface
     */
    public function setTemplate($template);

    /**
     * Retrieve template name.
     *
     * @return string
     */
    public function getTemplate();

    /**
     * Set array of paths where templates can be found.
     *
     * @param array $paths
     * @return \Phower\View\Renderer\TemplateRendererInterface
     */
    public function setPaths(array $paths);

    /**
     * Retrieve array of paths.
     *
     * @return array
     */
    public function getPaths();

    /**
     * Add new path.
     *
     * @param string $path
     * @return \Phower\View\Renderer\TemplateRendererInterface
     */
    public function addPath($path);

    /**
     * Resolve template to a valid file or return null
     * if not possible.
     *
     * @return string|null
     */
    public function resolve();
}
