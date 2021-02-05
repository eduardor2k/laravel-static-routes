<?php

namespace Tests;

abstract class TestBase extends \PHPUnit\Framework\TestCase
{
    public static function callMethod($obj, $name, ...$args) {
        $class = new \ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($obj, $args);
    }
}