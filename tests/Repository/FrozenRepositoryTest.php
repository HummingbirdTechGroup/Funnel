<?php

namespace Repository;

use carlosV2\Funnel\Repository\FrozenRepository;
use Everzet\PersistedObjects\Repository;

class FrozenRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Repository
     */
    private $repository;

    public function setUp()
    {
        $this->repository = new FrozenRepository(array('elem1', 'elem2'));
    }

    /** @test */
    public function itDoesNotAllowSaving()
    {
        $this->setExpectedException('LogicException');

        $this->repository->save(array('elem3'));
    }

    /** @test */
    public function itDoesNotAllowRemoving()
    {
        $this->setExpectedException('LogicException');

        $this->repository->remove(array('elem3'));
    }

    /** @test */
    public function itDoesNotAllowFindingById()
    {
        $this->setExpectedException('LogicException');

        $this->repository->findById('elem');
    }

    /** @test */
    public function itReturnsTheGivenArray()
    {
        $this->assertEquals(array('elem1', 'elem2'), $this->repository->getAll());
    }


    /** @test */
    public function itDoesNotAllowClearing()
    {
        $this->setExpectedException('LogicException');

        $this->repository->clear();
    }
}
