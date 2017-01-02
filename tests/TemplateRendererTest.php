<?php

/**
 * Phower View
 *
 * @version 0.1.0
 * @link https://github.com/phower/view Public Git repository
 * @copyright (c) 2015-2017, Pedro Ferreira <https://phower.com>
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace PhowerTest\View;

/**
 * Template renderer test case.
 *
 * @author Pedro Ferreira <pedro@phower.com>
 */
class TemplateRendererTest extends \PHPUnit_Framework_TestCase
{

    public function testSetAndGetTemplate()
    {
        $renderer = new \Phower\View\TemplateRenderer('template.php');
        $this->assertEquals('template.php', $renderer->getTemplate());

        $template = 'path/to/another/template.php';
        $renderer->setTemplate($template);
        $this->assertEquals($template, $renderer->getTemplate());
    }

    public function testSetAndGetPaths()
    {
        $renderer = new \Phower\View\TemplateRenderer('template.php');
        $this->assertEquals([], $renderer->getPaths());
        
        $paths = [__DIR__];
        $renderer->setPaths($paths);
        $this->assertEquals($paths, $renderer->getPaths());
        $renderer->addPath(__DIR__);
        $paths[] = __DIR__ . '/..';
        $renderer->addPath($paths[1]);
        $this->assertEquals($paths, $renderer->getPaths());
    }

    public function testResolve()
    {
        $renderer = new \Phower\View\TemplateRenderer('template.php');
        $this->assertNull($renderer->resolve());

        $renderer->addPath(__DIR__);
        $this->assertEquals(__DIR__ . '/template.php', $renderer->resolve());
    }

    public function testRender()
    {
        $renderer = new \Phower\View\TemplateRenderer('template.php', [__DIR__]);
        $expected = str_replace('<?= $name ?>', 'Pedro', file_get_contents(__DIR__ . '/template.php'));
        $this->assertEquals($expected, $renderer->render(['name' => 'Pedro']));
    }

}
