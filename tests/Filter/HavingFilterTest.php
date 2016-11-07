<?php

namespace test\carlosV2\Funnel\Filter;

use carlosV2\Funnel\Filter\HavingFilter;

class HavingFilterTest extends FilterTestCase
{
    public function setUp()
    {
        $this->filter = new HavingFilter();
    }

    /** @test */
    public function itAcceptsObjectsIfTheyHaveAGivenState()
    {
        $this->assertTrue($this->executeFilter('PublicPropertyPublic'));
    }

    /** @test */
    public function itAcceptsObjectsIfTheyHaveAGivenStateAndValue()
    {
        $this->assertTrue($this->executeFilter('PublicProperty', 'public'));
    }

    /** @test */
    public function itRejectsObjectsIfTheyHaveNotAGivenValue()
    {
        $this->assertFalse($this->executeFilter('PublicProperty', 'private'));
    }

    /** @test @expectedException \RunTimeException */
    public function itThrowsAnExceptionIfTheMethodDoesNotExists()
    {
        $this->executeFilter('UnknownProperty', 'unknown');
    }
}
