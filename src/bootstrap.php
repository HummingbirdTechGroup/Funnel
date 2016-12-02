<?php

use \carlosV2\Funnel\Funnel;
use \carlosV2\Funnel\Filter\MethodFilter;
use \carlosV2\Funnel\Filter\MethodsFilter;
use \carlosV2\Funnel\Filter\PropertyFilter;
use \carlosV2\Funnel\Filter\PropertiesFilter;
use \carlosV2\Funnel\Filter\TypeFilter;
use carlosV2\Funnel\Repository\FrozenRepository;

// Register filters
Funnel::addFilter(new MethodFilter());
Funnel::addFilter(new MethodsFilter());
Funnel::addFilter(new PropertyFilter());
Funnel::addFilter(new PropertiesFilter());
Funnel::addFilter(new TypeFilter());

// Register function
if (!function_exists('Funnel')) {
    /**
     * @param array $collection
     *
     * @return Funnel
     */
    function Funnel(array $collection)
    {
        return new Funnel(new FrozenRepository($collection));
    }
}
