<?php

namespace PhowerTest\View;

class RendererTest extends \PHPUnit_Framework_TestCase
{

    public function testMagicProperties()
    {
        $renderer = new \Phower\View\Renderer('template.php');
        $this->assertFalse(isset($renderer->foo));
        $renderer->foo = 'bar';
        $this->assertTrue(isset($renderer->foo));
        $this->assertEquals('bar', $renderer->foo);
        unset($renderer->foo);
        $this->assertFalse(isset($renderer->foo));
    }

    public function testSetRaisesExceptionOnAttemptToSetReservedName()
    {
        $this->setExpectedException(\Phower\View\Exception\InvalidArgumentException::class);
        $renderer = new \Phower\View\Renderer('template.php');
        $renderer->_ = true;
    }

    public function testGetRaisesExceptionOnAttemptToAccessReservedName()
    {
        $this->setExpectedException(\Phower\View\Exception\InvalidArgumentException::class);
        $renderer = new \Phower\View\Renderer('template.php');
        var_dump($renderer->_);
    }

    public function testGetRaisesExceptionOnMissingName()
    {
        $this->setExpectedException(\Phower\View\Exception\InvalidArgumentException::class);
        $renderer = new \Phower\View\Renderer('template.php');
        var_dump($renderer->foo);
    }

    public function testSetAndGetVariables()
    {
        $variables = ['foo' => 'bar', 'baz' => 'hoo'];
        $renderer = new \Phower\View\Renderer('template.php');
        $renderer->setVariables($variables);
        $this->assertEquals($variables, $renderer->getVariables());
    }

    public function testSetAndGetTemplate()
    {
        $renderer = new \Phower\View\Renderer('template.php');
        $template = 'path/to/another/template.php';
        $renderer->setTemplate($template);
        $this->assertEquals($template, $renderer->getTemplate());
    }

    public function testSetAndGetPath()
    {
        $renderer = new \Phower\View\Renderer('template.php');
        $path = [__DIR__];
        $renderer->setPath($path);
        $this->assertEquals($path, $renderer->getPath());
        $renderer->addPath(__DIR__);
        $path[] = __DIR__ . '/..';
        $renderer->addPath($path[1]);
        $this->assertEquals($path, $renderer->getPath());
    }

    public function testResolve()
    {
        $renderer = new \Phower\View\Renderer('template.php');
        $this->assertNull($renderer->resolve());
        $renderer->addPath(__DIR__);
        $this->assertEquals(__DIR__ . '/template.php', $renderer->resolve());
    }

    public function testRender()
    {
        $renderer = new \Phower\View\Renderer('template.php', ['name' => 'Pedro'], [__DIR__]);
        $expected = str_replace('<?= $this->name ?>', 'Pedro', file_get_contents(__DIR__ . '/template.php'));
        $this->assertEquals($expected, $renderer->render());
    }

}
