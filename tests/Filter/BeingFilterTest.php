<?php

namespace test\carlosV2\Funnel\Filter;

use carlosV2\Funnel\Filter\BeingFilter;

class BeingFilterTest extends FilterTestCase
{
    public function setUp()
    {
        $this->filter = new BeingFilter();
    }

    /** @test */
    public function itAcceptsObjectsIfTheyAreAGivenState()
    {
        $this->assertTrue($this->executeFilter('PublicPropertyPublic'));
    }

    /** @test */
    public function itAcceptsObjectsIfTheyAreAGivenStateWithValue()
    {
        $this->assertTrue($this->executeFilter('PublicProperty', 'public'));
    }

    /** @test */
    public function itRejectsObjectsIfTheyAreNotAGivenValue()
    {
        $this->assertFalse($this->executeFilter('PublicProperty', 'private'));
    }

    /** @test @expectedException \RunTimeException */
    public function itThrowsAnExceptionIfTheMethodDoesNotExists()
    {
        $this->executeFilter('UnknownProperty', 'unknown');
    }
}
