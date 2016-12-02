<?php

namespace test\carlosV2\Funnel\Filter;

use carlosV2\Funnel\FilterInterface;
use test\carlosV2\Funnel\TestObject;

abstract class FilterTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Filter
     */
    protected $filter;

    /** @test */
    public function itIsAFilter()
    {
        $this->assertInstanceOf(FilterInterface::class, $this->filter);
    }

    /**
     * @return bool
     */
    protected function executeFilter()
    {
        $callable = call_user_func_array($this->filter->getFilter(), func_get_args());
        return $callable(new TestObject('public', 'protected', 'private'));
    }
}
