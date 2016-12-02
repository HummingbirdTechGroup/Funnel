<?php

namespace carlosV2\Funnel\Filter;

use carlosV2\Funnel\FilterInterface;

final class MethodFilter implements FilterInterface
{
    /**
     * @var \Closure
     */
    private $methodsFilter;

    public function __construct()
    {
        $this->methodsFilter = (new MethodsFilter())->getFilter();
    }

    /**
     * @inheritDoc
     */
    public function getFilter()
    {
        $callable = $this->methodsFilter;

        return function ($method, $value) use ($callable) {
            return $callable([$method => $value]);
        };
    }
}
