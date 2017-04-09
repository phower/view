<?php

/**
 * Phower View
 *
 * @version 1.0.0
 * @link https://github.com/phower/view Public Git repository
 * @copyright (c) 2015-2017, Pedro Ferreira <https://phower.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace PhowerTest\View;

/**
 * JSON view test case.
 *
 * @author Pedro Ferreira <pedro@phower.com>
 */
class JsonViewTest extends \PHPUnit_Framework_TestCase
{

    public function testRequiresJsonRenderer()
    {
        $view = new \Phower\View\JsonView();
        $this->assertInstanceOf(\Phower\View\Renderer\JsonRendererInterface::class, $view->getRenderer());

        $renderer = new \Phower\View\Renderer\JsonRenderer();
        $view->setRenderer($renderer);
        $this->assertSame($renderer, $view->getRenderer());
    }

    public function testSetRendererRaiseExceptionOnBadRendererType()
    {
        $this->setExpectedException(\Phower\View\Exception\InvalidArgumentException::class);
        $view = new \Phower\View\JsonView();
        $renderer = $this->getMockBuilder(\Phower\View\Renderer\RendererInterface::class)->getMock();
        $view->setRenderer($renderer);
    }
}
