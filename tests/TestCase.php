<?php declare(strict_types=1);

namespace Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase as BaseTestCase;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

class TestCase extends BaseTestCase
{
    /**
     * Call protected/private method of a class.
     *
     * @param  object|string       &$object    Instantiated object that we will run method on.
     * @param  string              $methodName Method name to call
     * @param  array               $parameters Array of parameters to pass into method.
     * @param  bool                $static     Should call a static method.
     * @throws ReflectionException If there is a problem invoking the method.
     * @return mixed               Method return.
     */
    protected function invokeMethod($object, $methodName, array $parameters = [], bool $static = false)
    {
        $reflection = new ReflectionClass($object);
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs((is_string($object) ? null : $object), $parameters);
    }

    /**
     * Call protected/private property of a class.
     *
     * @param  object|string       $object Instantiated object that we will access the property.
     * @param  string              $name   Name of the property to access.
     * @throws ReflectionException
     * @return ReflectionProperty
     */
    protected function makePropertyAccessible($object, $name)
    {
        if (!property_exists($object, $name)) {
            throw new InvalidArgumentException(
                "Property $name does not exists on " . get_class($object) . '.'
            );
        }

        $property = new ReflectionProperty($object, $name);
        $property->setAccessible(true);

        return $property;
    }
}
