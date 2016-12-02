<?php

namespace test\carlosV2\Funnel;

use carlosV2\Funnel\FilterInterface;

class TestingFilter implements FilterInterface
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
