<?php

namespace carlosV2\Funnel;

interface FilterInterface
{
    /**
     * @return \Closure
     */
    public function getFilter();
}
