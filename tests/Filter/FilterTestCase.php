<?php

namespace test\carlosV2\Funnel\Filter;

use carlosV2\Funnel\FilterInterface;
use test\carlosV2\Funnel\TestObject;

abstract class FilterTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FilterInterface
     */
    protected $filter;

    /** @test */
    public function itIsAFilter()
    {
        $this->assertInstanceOf(FilterInterface::class, $this->filter);
    }

    /** @test */
    public function itReturnsTheFilterName()
    {
        $this->assertTrue(is_string($this->filter->getName()));
        $this->assertNotEmpty($this->filter->getName());
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
