<?php

namespace carlosV2\Funnel\Filter;

use carlosV2\Funnel\Filter;

final class PropertyFilter implements Filter
{
    /**
     * @var \Closure
     */
    private $propertiesFilter;

    public function __construct()
    {
        $this->propertiesFilter = (new PropertiesFilter())->getFilter();
    }

    /**
     * @inheritDoc
     */
    public function getFilter()
    {
        $callable = $this->propertiesFilter;

        return function ($property, $value) use ($callable) {
            return $callable([$property => $value]);
        };
    }
}
