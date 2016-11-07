<?php

namespace carlosV2\Funnel\Filter;

use carlosV2\Funnel\Filter;

final class TypeFilter implements Filter
{
    /**
     * @inheritDoc
     */
    public function getFilter()
    {
        return function ($type) {
            return function ($object) use ($type) {
                return $object instanceof $type;
            };
        };
    }
}
