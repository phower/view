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

use Phower\View\Exception\RuntimeException;

/**
 * Renderer
 *
 * Implements methods to render a PHP script with variables.
 *
 * @author Pedro Ferreira <pedro@phower.com>
 */
class TemplateRenderer implements TemplateRendererInterface
{

    /**
     * @var string
     */
    private $template;

    /**
     * @var array
     */
    private $paths;

    /**
     * Create new renderer instance.
     *
     * @param string $template
     * @param array $paths
     */
    public function __construct($template, array $paths = [])
    {
        $this->template = (string) $template;
        $this->paths = $paths;
    }

    /**
     * Set template name.
     *
     * @param string $template
     * @return $this
     */
    public function setTemplate($template)
    {
        $this->template = (string) $template;
        return $this;
    }

    /**
     * Retrieve template name.
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set array of paths where templates can be found.
     *
     * @param array $paths
     * @return $this
     */
    public function setPaths(array $paths)
    {
        $this->paths = $paths;
        return $this;
    }

    /**
     * Retrieve array of paths.
     *
     * @return array
     */
    public function getPaths()
    {
        return $this->paths;
    }

    /**
     * Add new path.
     *
     * @param string $path
     * @return $this
     */
    public function addPath($path)
    {
        if (!in_array($path, $this->paths)) {
            $this->paths[] = (string) $path;
        }

        return $this;
    }

    /**
     * Resolve template to a valid file or return null
     * if not possible.
     *
     * @return string|null
     */
    public function resolve()
    {
        if (file_exists($this->template)) {
            return $this->template;
        }

        foreach ($this->paths as $path) {
            $file = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $this->template;
            if (file_exists($file)) {
                return $file;
            }
        }

        return null;
    }

    /**
     * Render template with current variables.
     *
     * @return string
     * @throws RuntimeException
     * @throws \Throwable
     * @throws \Exception
     */
    public function render(array $variables = [])
    {
        if (!$template = $this->resolve()) {
            $message = sprintf('Unable to resolve file "%s" in any of given paths.', $this->getTemplate());
            throw new RuntimeException($message);
        }

        try {
            ob_start();
            $this->output($template, $variables);
            $output = ob_get_clean();
        } catch (\Throwable $e) { // PHP 7+
            ob_end_clean();
            throw $e;
        } catch (\Exception $e) { // PHP < 7
            ob_end_clean();
            throw $e;
        }

        return $output;
    }

    /**
     * Output the template in a protected scope with the current variables.
     *
     * @param string $template
     * @param array $variables
     */
    protected function output($template, array $variables)
    {
        extract($variables);
        include $template;
    }
}
