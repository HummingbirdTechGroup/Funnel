<?php

namespace test\carlosV2\Funnel;

use carlosV2\Funnel\Funnel;
use Everzet\PersistedObjects\Repository;
use Prophecy\Prophecy\ObjectProphecy;

class FunnelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ObjectProphecy
     */
    private $repository;

    /**
     * @var Funnel
     */
    private $funnel;

    public function setUp()
    {
        $this->repository = $this->prophesize(Repository::class);

        $this->funnel = new Funnel($this->repository->reveal());
    }

    /** @test */
    public function itIsARepository()
    {
        $this->assertInstanceOf(Repository::class, $this->funnel);
    }

    /** @test */
    public function itDecoratesTheSaveMethod()
    {
        $object = new TestObject('public', 'protected', 'private');

        $this->repository->save($object)->shouldBeCalled();

        $this->funnel->save($object);
    }

    /** @test */
    public function itDecoratesTheRemoveMethod()
    {
        $object = new TestObject('public', 'protected', 'private');

        $this->repository->remove($object)->shouldBeCalled();

        $this->funnel->remove($object);
    }

    /** @test */
    public function itDecoratesTheFindByIdMethod()
    {
        $object = new TestObject('public', 'protected', 'private');

        $this->repository->findById($object)->willReturn($object);

        $this->assertSame($object, $this->funnel->findById($object));
    }

    /** @test */
    public function itDecoratesTheGetAllMethod()
    {
        $object1 = new TestObject('public', 'protected', 'private');
        $object2 = new TestObject('public', 'protected', 'private');

        $this->repository->getAll()->willReturn([$object1, $object2]);

        $this->assertSame([$object1, $object2], $this->funnel->getAll());
    }

    /** @test */
    public function itDecoratesTheClearMethod()
    {
        $this->repository->clear()->shouldBeCalled();

        $this->funnel->clear();
    }

    /** @test */
    public function itReturnsAllTheObjects()
    {
        $object1 = new TestObject('publicA', 'protectedA', 'privateB');
        $object2 = new TestObject('publicA', 'protectedB', 'privateA');
        $object3 = new TestObject('publicB', 'protectedA', 'privateA');

        $this->repository->getAll()->willReturn([$object1, $object2, $object3]);

        $this->assertSame([$object1, $object2, $object3], $this->funnel->findAll());
    }

    /** @test */
    public function itReturnsAllTheObjectsThatMatchesTheCallback()
    {
        $object1 = new TestObject('publicA', 'protectedA', 'privateB');
        $object2 = new TestObject('publicA', 'protectedB', 'privateA');
        $object3 = new TestObject('publicB', 'protectedA', 'privateA');

        $this->repository->getAll()->willReturn([$object1, $object2, $object3]);

        $this->assertSame([$object1, $object3], $this->funnel->findBy(function (TestObject $object) {
            return $object->publicProperty === 'publicB' || $object->getPrivateProperty() === 'privateB';
        }));
    }

    /** @test */
    public function itCountsAllTheObjectsThatMatchesTheCallback()
    {
        $object1 = new TestObject('publicA', 'protectedA', 'privateB');
        $object2 = new TestObject('publicA', 'protectedB', 'privateA');
        $object3 = new TestObject('publicB', 'protectedA', 'privateA');

        $this->repository->getAll()->willReturn([$object1, $object2, $object3]);

        $this->assertSame(2, $this->funnel->countBy(function (TestObject $object) {
            return $object->publicProperty === 'publicB' || $object->getPrivateProperty() === 'privateB';
        }));
    }

    /** @test */
    public function itReturnsTheFirstObjectThatMatchesTheCallback()
    {
        $object1 = new TestObject('publicA', 'protectedA', 'privateB');
        $object2 = new TestObject('publicA', 'protectedB', 'privateA');
        $object3 = new TestObject('publicB', 'protectedA', 'privateA');

        $this->repository->getAll()->willReturn([$object1, $object2, $object3]);

        $this->assertSame($object1, $this->funnel->findOneBy(function (TestObject $object) {
            return $object->publicProperty === 'publicB' || $object->getPrivateProperty() === 'privateB';
        }));
    }

    /** @test */
    public function itReturnsNullIfNoObjectMatchesTheCallback()
    {
        $object1 = new TestObject('publicA', 'protectedA', 'privateB');
        $object2 = new TestObject('publicA', 'protectedB', 'privateA');
        $object3 = new TestObject('publicB', 'protectedA', 'privateA');

        $this->repository->getAll()->willReturn([$object1, $object2, $object3]);

        $this->assertNull($this->funnel->findOneBy(function (TestObject $object) {
            return $object->publicProperty === 'publicC';
        }));
    }

    /** @test */
    public function itUsesTheFiltersWhenRequired()
    {
        Funnel::addFilter(new TestingFilter());

        $object1 = new TestObject('publicA', 'protectedA', 'privateB');
        $object2 = new TestObject('publicA', 'protectedB', 'privateA');
        $object3 = new TestObject('publicB', 'protectedA', 'privateA');

        $this->repository->getAll()->willReturn([$object1, $object2, $object3]);

        $this->assertSame([$object1, $object2], $this->funnel->findByTesting('publicA'));
        $this->assertSame($object1, $this->funnel->findOneByTesting('publicA'));
        $this->assertSame(2, $this->funnel->countByTesting('publicA'));
    }

    /** @test */
    public function itUsesTheNegatedFiltersWhenRequired()
    {
        Funnel::addFilter(new TestingFilter());

        $object1 = new TestObject('publicA', 'protectedA', 'privateB');
        $object2 = new TestObject('publicA', 'protectedB', 'privateA');
        $object3 = new TestObject('publicB', 'protectedA', 'privateA');

        $this->repository->getAll()->willReturn([$object1, $object2, $object3]);

        $this->assertSame([$object3], $this->funnel->findByNotTesting('publicA'));
        $this->assertSame($object3, $this->funnel->findOneByNotTesting('publicA'));
        $this->assertSame(1, $this->funnel->countByNotTesting('publicA'));
    }

    /** @test @expectedException \RuntimeException */
    public function itThrowsExceptionIfTheFunctionIsNotFound()
    {
        Funnel::addFilter(new TestingFilter());

        $this->funnel->searchByTesting();
    }

    /** @test @expectedException \RuntimeException */
    public function itThrowsExceptionIfTheFilterIsNotFound()
    {
        $this->funnel->findByUnexisting();
    }

    /** @test */
    public function itReturnsTheTestingFilter()
    {
        $filter = new TestingFilter();
        Funnel::addFilter($filter);

        $callable = $filter->getFilter();
        $this->assertEquals($callable('test'), Funnel::testingFilter('test'));
    }
}
