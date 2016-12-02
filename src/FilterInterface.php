<?php

namespace carlosV2\Funnel;

interface FilterInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return \Closure
     */
    public function getFilter();
}
