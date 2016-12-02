<?php

namespace Repository;

use carlosV2\Funnel\Repository\FrozenRepository;
use Everzet\PersistedObjects\Repository;
use LogicException;

class FrozenRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Repository
     */
    private $repository;

    public function setUp()
    {
        $this->repository = new FrozenRepository(['elem1', 'elem2']);
    }

    /** @test */
    public function itDoesNotAllowSaving()
    {
        $this->setExpectedException(LogicException::class);

        $this->repository->save(['elem3']);
    }

    /** @test */
    public function itDoesNotAllowRemoving()
    {
        $this->setExpectedException(LogicException::class);

        $this->repository->remove(['elem3']);
    }

    /** @test */
    public function itDoesNotAllowFindingById()
    {
        $this->setExpectedException(LogicException::class);

        $this->repository->findById('elem');
    }

    /** @test */
    public function itReturnsTheGivenArray()
    {
        $this->assertEquals(['elem1', 'elem2'], $this->repository->getAll());
    }


    /** @test */
    public function itDoesNotAllowClearing()
    {
        $this->setExpectedException(LogicException::class);

        $this->repository->clear();
    }
}
