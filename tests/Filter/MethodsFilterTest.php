<?php

namespace test\carlosV2\Funnel\Filter;

use carlosV2\Funnel\Filter\MethodsFilter;

class MethodsFilterTest extends FilterTestCase
{
    public function setUp()
    {
        $this->filter = new MethodsFilter();
    }

    /** @test */
    public function itAcceptsObjectsIfTheMethodsReturnTheExpectedValues()
    {
        $this->assertTrue($this->executeFilter(array(
            'getPublicProperty' => 'public',
            'getPrivateProperty' => 'private'
        )));
    }

    /** @test */
    public function itRejectsObjectsIfTheMethodsDoNotReturnTheExpectedValues()
    {
        $this->assertFalse($this->executeFilter(array(
            'getPublicProperty' => 'public',
            'getPrivateProperty' => 'protected'
        )));
    }

    /** @test @expectedException \RunTimeException */
    public function itThrowsAnExceptionIfAMethodDoesNotExists()
    {
        $this->executeFilter(array(
            'getPublicProperty' => 'public',
            'getUnknownProperty' => 'unknown'
        ));
    }
}
