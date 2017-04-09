<?php

/**
 * Phower View
 *
 * @version 1.0.0
 * @link https://github.com/phower/view Public Git repository
 * @copyright (c) 2015-2017, Pedro Ferreira <https://phower.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace PhowerTest\View\Renderer;

/**
 * JSON renderer test case.
 *
 * @author Pedro Ferreira <pedro@phower.com>
 */
class JsonRendererTest extends \PHPUnit_Framework_TestCase
{

    public function testSetAndGetOptions()
    {
        $renderer = new \Phower\View\Renderer\JsonRenderer();
        $this->assertEquals(0, $renderer->getOptions());

        $options = JSON_PRETTY_PRINT;
        $renderer->setOptions($options);
        $this->assertEquals($options, $renderer->getOptions());
    }

    public function testSetAndGetDepth()
    {
        $renderer = new \Phower\View\Renderer\JsonRenderer();
        $this->assertEquals(512, $renderer->getDepth());

        $depth = 1024;
        $renderer->setDepth($depth);
        $this->assertEquals($depth, $renderer->getDepth());
    }

    public function testRender()
    {
        $renderer = new \Phower\View\Renderer\JsonRenderer();
        $variables = ['foo' => 'bar', 'baz' => 123, 'flag' => true];
        $expected = json_encode($variables);
        $this->assertEquals($expected, $renderer->render($variables));
    }
}
