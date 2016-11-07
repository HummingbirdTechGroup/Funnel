<?php

namespace carlosV2\Funnel\Filter;

use carlosV2\Funnel\Filter;

final class MethodsFilter implements Filter
{
    /**
     * @inheritDoc
     */
    public function getFilter()
    {
        return function (array $methods) {
            return function ($object) use ($methods) {
                foreach ($methods as $method => $value) {
                    if (!method_exists($object, $method)) {
                        throw new \RuntimeException(sprintf('Method `%s` not found on class `%s`.', $method, get_class($object)));
                    }

                    if ($object->$method() !== $value) {
                        return false;
                    }
                }

                return true;
            };
        };
    }
}
