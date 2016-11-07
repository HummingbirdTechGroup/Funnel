<?php

namespace test\carlosV2\Funnel\Filter;

use carlosV2\Funnel\Filter\TypeFilter;
use test\carlosV2\Funnel\TestObject;

class TypeFilterTest extends FilterTestCase 
{
    public function setUp()
    {
        $this->filter = new TypeFilter();
    }

    /** @test */
    public function itAcceptsObjectsIfTheyHaveTheExpectedType()
    {
        $this->assertTrue($this->executeFilter(TestObject::class));
    }

    /** @test */
    public function itRejectsObjectsIfThePropertyDoesNotReturnTheExpectedValue()
    {
        $this->assertFalse($this->executeFilter(\DateTime::class));
    }
}
