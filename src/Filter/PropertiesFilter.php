<?php

namespace carlosV2\Funnel\Filter;

use carlosV2\Funnel\FilterInterface;
use ReflectionException;

final class PropertiesFilter implements FilterInterface
{
    /**
     * @inheritDoc
     */
    public function getFilter()
    {
        return function (array $properties) {
            return function ($object) use ($properties) {
                foreach ($properties as $property => $value) {
                    if (!property_exists($object, $property)) {
                        throw new \RuntimeException(sprintf('Property `%s` not found on class `%s`.', $property, get_class($object)));
                    }

                    if ($this->getPropertyValue(get_class($object), $object, $property) !== $value) {
                        return false;
                    }
                }

                return true;
            };
        };
    }

    /**
     * @param string $className
     * @param object $object
     * @param string $property
     *
     * @return mixed
     */
    private function getPropertyValue($className, $object, $property)
    {
        try {
            $rflProperty = new \ReflectionProperty($className, $property);
            $rflProperty->setAccessible(true);
            return $rflProperty->getValue($object);
        } catch (ReflectionException $e) {
            if (($parentClassName = get_parent_class($className)) !== false) {
                return $this->getPropertyValue($parentClassName, $object, $property);
            }

            // If no defined property is found, try to find a dynamic one
            // If no dynamic one is found, let it fail
            return $object->{$property};
        }
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'properties';
    }
}
