<?php

namespace test\carlosV2\Funnel\Filter;

use carlosV2\Funnel\Filter\PropertiesFilter;

class PropertiesFilterTest extends FilterTestCase
{
    public function setUp()
    {
        $this->filter = new PropertiesFilter();
    }

    /** @test */
    public function itAcceptsObjectsIfThePropertiesReturnTheExpectedValues()
    {
        $this->assertTrue($this->executeFilter([
            'publicProperty' => 'public',
            'privateProperty' => 'private'
        ]));
    }

    /** @test */
    public function itRejectsObjectsIfThePropertiesDoNotReturnTheExpectedValues()
    {
        $this->assertFalse($this->executeFilter([
            'publicProperty' => 'public',
            'privateProperty' => 'protected'
        ]));
    }

    /** @test @expectedException \RunTimeException */
    public function itThrowsAnExceptionIfAPropertiesDoesNotExists()
    {
        $this->executeFilter([
            'publicProperty' => 'public',
            'unknownProperty' => 'unknown'
        ]);
    }
}
