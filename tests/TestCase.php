<?php

declare(strict_types=1);

namespace Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase as BaseTestCase;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;
use TypeError;

abstract class TestCase extends BaseTestCase
{
    /**
     * Sets value for protected/private property of a class.
     *
     * @param object|string $object       Class name, or instantiated object that we will set attribute on
     * @param string        $propertyName Property name to set
     * @param mixed         $value        Property value to set
     *
     * @throws ReflectionException when the class property does not exist
     */
    public function setProperty($object, string $propertyName, $value): void
    {
        $property = $this->makePropertyAccessible($object, $propertyName);
        $property->setValue($object, $value);
        $property->setAccessible(false);
    }

    /**
     * Gets the value for protected/private property of a class.
     *
     * @param object      $object        instantiated object that we will get property from
     * @param string      $propertyName  Property name to set
     * @param string|null $propertyClass Optional class that the property is defined on. Required when the property
     *                                   is defined as private on a parent of $object. If this is not provided,
     *                                   the property is assumed to be visible to $object's class.
     *
     * @throws ReflectionException when the class property does not exist
     * @throws TypeError           when the property is non-static, and you provide a class name instead an object
     *
     * @return mixed
     */
    public function getProperty(object $object, string $propertyName, ?string $propertyClass = null)
    {
        return $this->makePropertyAccessible($propertyClass ?? $object, $propertyName)->getValue($object);
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object|string &$object    Instantiated object that we will run method on
     * @param string        $methodName Method name to call
     * @param array         $parameters array of parameters to pass into method
     * @param bool          $static     should call a static method
     *
     * @throws ReflectionException if there is a problem invoking the method
     *
     * @return mixed method return
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
     * @param object|string $object instantiated object that we will access the property
     * @param string        $name   name of the property to access
     *
     * @throws ReflectionException
     *
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
