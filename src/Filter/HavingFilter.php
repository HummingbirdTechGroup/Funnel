<?php

namespace carlosV2\Funnel\Filter;

use carlosV2\Funnel\Filter;

final class HavingFilter implements Filter
{
    /**
     * @inheritDoc
     */
    public function getFilter()
    {
        return function ($method, $param = null) {
            return function ($object) use ($method, $param) {
                $method = sprintf('has%s', $method);

                if (!method_exists($object, $method)) {
                    throw new \RuntimeException(sprintf('Method `%s` not found on class `%s`.', $method, get_class($object)));
                }

                return $object->$method($param);
            };
        };
    }
}
