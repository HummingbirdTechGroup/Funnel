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
        $filter = new MethodsFilter();

        $this->methodsFilter = $filter->getFilter();
    }

    /**
     * @inheritDoc
     */
    public function getFilter()
    {
        $callable = $this->methodsFilter;

        return function ($method, $value) use ($callable) {
            return $callable(array($method => $value));
        };
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'method';
    }
}
