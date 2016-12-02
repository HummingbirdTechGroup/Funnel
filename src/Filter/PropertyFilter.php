<?php

namespace carlosV2\Funnel\Filter;

use carlosV2\Funnel\FilterInterface;

final class PropertyFilter implements FilterInterface
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

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'property';
    }
}
