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
        $this->assertTrue($this->executeFilter(array(
            'publicProperty' => 'public',
            'privateProperty' => 'private',
            'dynamicProperty' => 'dynamic'
        )));
    }

    /** @test */
    public function itRejectsObjectsIfThePropertiesDoNotReturnTheExpectedValues()
    {
        $this->assertFalse($this->executeFilter(array(
            'publicProperty' => 'public',
            'privateProperty' => 'protected'
        )));
    }

    /** @test @expectedException \RunTimeException */
    public function itThrowsAnExceptionIfAPropertiesDoesNotExists()
    {
        $this->executeFilter(array(
            'publicProperty' => 'public',
            'unknownProperty' => 'unknown'
        ));
    }
}
