<?php

namespace carlosV2\Funnel\Filter;

use carlosV2\Funnel\FilterInterface;

final class TypeFilter implements FilterInterface
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

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'type';
    }
}
