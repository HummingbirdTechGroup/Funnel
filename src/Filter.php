<?php

namespace carlosV2\Funnel;

interface Filter
{
    /**
     * @return \Closure
     */
    public function getFilter();
}
