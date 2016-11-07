<?php

namespace test\carlosV2\Funnel\Filter;

use carlosV2\Funnel\Filter\PropertyFilter;

class PropertyFilterTest extends FilterTestCase 
{
    public function setUp()
    {
        $this->filter = new PropertyFilter();
    }

    /** @test */
    public function itAcceptsObjectsIfThePropertyReturnsTheExpectedValue()
    {
        $this->assertTrue($this->executeFilter('publicProperty', 'public'));
        $this->assertTrue($this->executeFilter('protectedProperty', 'protected'));
        $this->assertTrue($this->executeFilter('privateProperty', 'private'));
    }

    /** @test */
    public function itRejectsObjectsIfThePropertyDoesNotReturnTheExpectedValue()
    {
        $this->assertFalse($this->executeFilter('publicProperty', 'private'));
    }

    /** @test @expectedException \RunTimeException */
    public function itThrowsAnExceptionIfThePropertyDoesNotExists()
    {
        $this->executeFilter('unknownProperty', 'unknown');
    }
}
