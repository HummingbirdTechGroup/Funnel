<?php

namespace test\carlosV2\Funnel\Filter;

use carlosV2\Funnel\Filter\AnyOfFilter;

class AnyOfFilterTest extends FilterTestCase
{
    public function setUp()
    {
        $this->filter = new AnyOfFilter();
    }

    /** @test */
    public function itRejectsObjectsIfNoFiltersAreGiven()
    {
        $this->assertFalse($this->executeFilter());
    }

    /** @test */
    public function itAcceptsObjectsIfAtLeastOneOfTheFiltersReportTrue()
    {
        $trueFilter = function () { return true; };
        $falseFilter = function () { return false; };

        $this->assertTrue($this->executeFilter($falseFilter, $trueFilter, $falseFilter));
    }

    /** @test */
    public function itRejectsObjectsIfAllTheFiltersReportFalse()
    {
        $falseFilter = function () { return false; };

        $this->assertFalse($this->executeFilter($falseFilter, $falseFilter, $falseFilter));
    }
}
