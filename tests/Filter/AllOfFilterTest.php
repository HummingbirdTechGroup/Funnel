<?php

namespace test\carlosV2\Funnel\Filter;

use carlosV2\Funnel\Filter\AllOfFilter;

class AllOfFilterTest extends FilterTestCase
{
    public function setUp()
    {
        $this->filter = new AllOfFilter();
    }

    /** @test */
    public function itAcceptsObjectsIfNoFiltersAreGiven()
    {
        $this->assertTrue($this->executeFilter());
    }

    /** @test */
    public function itAcceptsObjectsIfAllTheGivenFiltersReportTrue()
    {
        $trueFilter = function () { return true; };

        $this->assertTrue($this->executeFilter($trueFilter, $trueFilter, $trueFilter));
    }

    /** @test */
    public function itRejectsObjectsAtLeastOneOfTheFiltersReportFalse()
    {
        $trueFilter = function () { return true; };
        $falseFilter = function () { return false; };

        $this->assertFalse($this->executeFilter($trueFilter, $falseFilter, $trueFilter));
    }
}
