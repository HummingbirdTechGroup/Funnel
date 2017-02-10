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

                    if ($this->getPropertyValue($object, $property) !== $value) {
                        return false;
                    }
                }

                return true;
            };
        };
    }

    /**
     * @param object $object
     * @param string $property
     *
     * @return mixed
     */
    private function getPropertyValue($object, $property)
    {
        try {
            return From($object)->extract($property);
        } catch (ReflectionException $e) {
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
