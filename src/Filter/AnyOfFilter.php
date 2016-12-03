<?php

namespace carlosV2\Funnel\Filter;

use carlosV2\Funnel\FilterInterface;

final class AnyOfFilter implements FilterInterface
{
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'anyOf';
    }

    /**
     * @inheritDoc
     */
    public function getFilter()
    {
        return function () {
            $callables = func_get_args();

            return function ($object) use ($callables) {
                foreach ($callables as $callable) {
                    if ($callable($object)) {
                        return true;
                    }
                }

                return false;
            };
        };
    }
}
