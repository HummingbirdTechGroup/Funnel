<?php

namespace test\carlosV2\Funnel\Filter;

use carlosV2\Funnel\Filter\MethodFilter;

class MethodFilterTest extends FilterTestCase
{
    public function setUp()
    {
        $this->filter = new MethodFilter();
    }

    /** @test */
    public function itAcceptsObjectsIfTheMethodReturnsTheExpectedValue()
    {
        $this->assertTrue($this->executeFilter('getPublicProperty', 'public'));
    }

    /** @test */
    public function itRejectsObjectsIfTheMethodDoesNotReturnTheExpectedValue()
    {
        $this->assertFalse($this->executeFilter('getPublicProperty', 'private'));
    }

    /** @test @expectedException \RunTimeException */
    public function itThrowsAnExceptionIfTheMethodDoesNotExists()
    {
        $this->executeFilter('getUnknownProperty', 'unknown');
    }
}
