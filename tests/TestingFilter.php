<?php

namespace test\carlosV2\Funnel;

use carlosV2\Funnel\Filter;

class TestingFilter implements Filter
{
    /**
     * @inheritDoc
     */
    public function getFilter()
    {
        return function ($publicPropertyValue) {
            return function ($object) use ($publicPropertyValue) {
                return $object->publicProperty === $publicPropertyValue;
            };
        };
    }
}
