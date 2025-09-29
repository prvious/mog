<?php

namespace Tests;

use Illuminate\Container\Container;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\Compilers\BladeCompiler;
use Mockery as m;
use Mog\SelfClosingSlotsCompiler;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function mockViewFactory($existsSucceeds = true)
    {
        $container = new Container;
        $container->instance(Factory::class, $factory = m::mock(Factory::class));
        $container->alias(Factory::class, 'view');
        $factory->shouldReceive('exists')->andReturn($existsSucceeds);
        Container::setInstance($container);
    }

    public function compiler(array $aliases = [], array $namespaces = [], ?BladeCompiler $blade = null)
    {
        return new SelfClosingSlotsCompiler(
            $aliases, $namespaces, $blade
        );
    }
}
