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
 * Abstract view test case.
 *
 * @author Pedro Ferreira <pedro@phower.com>
 */
class AbstractViewTest extends \PHPUnit_Framework_TestCase
{

    public function testMagicProperties()
    {
        $view = $this->getMockForAbstractClass(\Phower\View\AbstractView::class);
        $this->assertFalse(isset($view->foo));
        $view->foo = 'bar';
        $this->assertTrue(isset($view->foo));
        $this->assertEquals('bar', $view->foo);
        unset($view->foo);
        $this->assertFalse(isset($view->foo));
    }

    public function testGetRaisesExceptionOnMissingName()
    {
        $this->setExpectedException(\Phower\View\Exception\InvalidArgumentException::class);
        $view = $this->getMockForAbstractClass(\Phower\View\AbstractView::class);
        var_dump($view->foo);
    }

    public function testSetAndGetVariables()
    {
        $view = $this->getMockForAbstractClass(\Phower\View\AbstractView::class);
        $this->assertEquals([], $view->getVariables());

        $variables = ['foo' => 'bar', 'baz' => 'hoo'];
        $view->setVariables($variables);
        $this->assertEquals($variables, $view->getVariables());
    }

    public function testSetAndGetRenderer()
    {
        $view = $this->getMockForAbstractClass(\Phower\View\AbstractView::class);
        $renderer = $this->getMockBuilder(\Phower\View\Renderer\RendererInterface::class)
                        ->disableOriginalConstructor()->getMock();
        $view->setRenderer($renderer);
        $this->assertSame($renderer, $view->getRenderer());
    }
}
