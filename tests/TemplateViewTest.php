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
 * Template view test case.
 *
 * @author Pedro Ferreira <pedro@phower.com>
 */
class TemplateViewTest extends \PHPUnit_Framework_TestCase
{

    public function testRequiresTemplateRenderer()
    {
        $renderer = new \Phower\View\Renderer\TemplateRenderer('template.php', [__DIR__]);
        $view = new \Phower\View\TemplateView(['name' => 'Pedro']);
        $this->assertNull($view->getRenderer());

        $view->setRenderer($renderer);
        $this->assertSame($renderer, $view->getRenderer());

        $variables = $view->getVariables();
        $this->assertEquals($renderer->render($variables), $view->render());
    }

    public function testSetRendererRaiseExceptionOnBadRendererType()
    {
        $this->setExpectedException(\Phower\View\Exception\InvalidArgumentException::class);
        $view = new \Phower\View\TemplateView();
        $renderer = $this->getMockBuilder(\Phower\View\Renderer\RendererInterface::class)->getMock();
        $view->setRenderer($renderer);
    }
}
