<?php

namespace carlosV2\Funnel\Repository;

use Everzet\PersistedObjects\Repository;
use LogicException;

final class FrozenRepository implements Repository
{
    /**
     * @var array
     */
    private $collection;

    /**
     * @param array $collection
     */
    public function __construct(array $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @inheritDoc
     */
    public function save($object)
    {
        throw new LogicException(sprintf('Impossible to call %s() on a frozen Repository.', __FUNCTION__));
    }

    /**
     * @inheritDoc
     */
    public function remove($object)
    {
        throw new LogicException(sprintf('Impossible to call %s() on a frozen Repository.', __FUNCTION__));
    }

    /**
     * @inheritDoc
     */
    public function findById($id)
    {
        throw new LogicException(sprintf('Impossible to call %s() on a frozen Repository.', __FUNCTION__));
    }

    /**
     * @inheritDoc
     */
    public function getAll()
    {
        return $this->collection;
    }

    /**
     * @inheritDoc
     */
    public function clear()
    {
        throw new LogicException(sprintf('Impossible to call %s() on a frozen Repository.', __FUNCTION__));
    }
}
