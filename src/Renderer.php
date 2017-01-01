<?php

namespace Phower\View;

/**
 * Description of Renderer
 *
 * @author pedro
 */
class Renderer
{

    /**
     * @var array
     */
    private $_;

    public function __construct($template, array $variables = [], array $path = [])
    {
        $this->setTemplate($template)
                ->setVariables($variables)
                ->setPath($path);
    }

    /**
     * Set value for a given name.
     *
     * @param string $name
     * @param mixed $value
     * @return $this
     * @throws Exception\InvalidArgumentException
     */
    public function __set($name, $value)
    {
        if ($name === '_') {
            throw new Exception\InvalidArgumentException('Property with name "_" is reserved and can\'t be set.');
        }

        $this->_['variables'][$name] = $value;
        return $this;
    }

    /**
     * Retrieve value for a given name.
     *
     * @param string $name
     * @return mixed
     * @throws Exception\InvalidArgumentException
     */
    public function __get($name)
    {
        if ($name === '_') {
            throw new Exception\InvalidArgumentException('Property with name "_" is reserved and can\'t be accessed.');
        }

        if (!array_key_exists($name, $this->_['variables'])) {
            throw new Exception\InvalidArgumentException('Property with name "_" is not set.');
        }

        return $this->_['variables'][$name];
    }

    /**
     * Check if a variable is set.
     *
     * @param string $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->_['variables'][$name]);
    }

    /**
     * Unset existing variable.
     *
     * @param string $name
     * @return void
     */
    public function __unset($name)
    {
        unset($this->_['variables'][$name]);
    }

    /**
     * Set variables from an associative array.
     *
     * @param array $variables
     * @return $this
     */
    public function setVariables(array $variables)
    {
        $this->_['variables'] = [];

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
        return $this->_['variables'];
    }
    
    /**
     * Set template name.
     *
     * @param string $template
     * @return $this
     */
    public function setTemplate($template)
    {
        $this->_['template'] = (string) $template;
        return $this;
    }

    /**
     * Retrieve template name.
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->_['template'];
    }

    /**
     * Set array of paths where templates can be found.
     *
     * @param array $path
     * @return $this
     */
    public function setPath(array $path)
    {
        $this->_['path'] = $path;
        return $this;
    }

    /**
     * Retrieve array of paths.
     *
     * @return array
     */
    public function getPath()
    {
        return $this->_['path'];
    }

    /**
     * Add new path.
     * 
     * @param string $path
     * @return $this
     */
    public function addPath($path)
    {
        if (!in_array($path, $this->_['path'])) {
            $this->_['path'][] = (string) $path;
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
        $template = $this->getTemplate();

        if (file_exists($template)) {
            return $template;
        }

        foreach ($this->getPath() as $path) {
            $file = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $template;
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
     * @throws Exception\RuntimeException
     * @throws \Throwable
     * @throws \Exception
     */
    public function render()
    {
        if (!$template = $this->resolve()) {
            $message = sprintf('Unable to resolve file "%s" in any of given paths.', $this->getTemplate());
            throw new Exception\RuntimeException($message);
        }

        try {
            ob_start();
            $this->output($template, $this->_['variables']);
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
