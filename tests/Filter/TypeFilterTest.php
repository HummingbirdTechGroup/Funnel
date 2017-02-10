<?php

namespace test\carlosV2\Funnel\Filter;

use carlosV2\Funnel\Filter\TypeFilter;

class TypeFilterTest extends FilterTestCase 
{
    public function setUp()
    {
        $this->filter = new TypeFilter();
    }

    /** @test */
    public function itAcceptsObjectsIfTheyHaveTheExpectedType()
    {
        $this->assertTrue($this->executeFilter('test\carlosV2\Funnel\TestObject'));
    }

    /** @test */
    public function itRejectsObjectsIfThePropertyDoesNotReturnTheExpectedValue()
    {
        $this->assertFalse($this->executeFilter('DateTime'));
    }
}
