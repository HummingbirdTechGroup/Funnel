<?php

namespace carlosV2\Funnel;

use Everzet\PersistedObjects\Repository;

final class Funnel implements Repository
{
    /**
     * @var \Closure[]
     */
    private static $filters = array();

    /**
     * @var Repository
     */
    private $repository;

    /**
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function save($object)
    {
        $this->repository->save($object);
    }

    /**
     * @inheritDoc
     */
    public function remove($object)
    {
        $this->repository->remove($object);
    }

    /**
     * @inheritDoc
     */
    public function findById($id)
    {
        return $this->repository->findById($id);
    }

    /**
     * @inheritDoc
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * @inheritDoc
     */
    public function clear()
    {
        $this->repository->clear();
    }

    /**
     * @return object[]
     */
    public function findAll()
    {
        return $this->getAll();
    }

    /**
     * @param callable $callback
     *
     * @return object[]
     */
    public function findBy($callback)
    {
        return array_values(array_filter($this->repository->getAll(), $callback));
    }

    /**
     * @param callable $callback
     *
     * @return int
     */
    public function countBy($callback)
    {
        return count($this->findBy($callback));
    }

    /**
     * @param callable $callback
     *
     * @return object|null
     */
    public function findOneBy($callback)
    {
        $items = $this->findBy($callback);

        return @$items[0];
    }

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public function __call($name, array $arguments)
    {
        if (($matches = self::getMatches('/((?:find(?:One)?|count)By)(Not)?(.+)/i', $name)) === false) {
            throw new \RuntimeException(sprintf('Unable to compose filter for `%s`', $name));
        }

        $filter = strtolower($matches[3]);
        self::assertFilterExists($filter);

        $callable = call_user_func_array(self::$filters[$filter], $arguments);
        $callable = ($matches[2] !== '' ? self::negate($callable) : $callable);

        return call_user_func(array($this, $matches[1]), $callable);
    }

    /**
     * @param string $filter
     *
     * @throws \RuntimeException
     */
    private static function assertFilterExists($filter)
    {
        if (!array_key_exists($filter, self::$filters)) {
            throw new \RuntimeException(sprintf('Filter `%s` not found.', $filter));
        }
    }

    /**
     * @param callable $callback
     *
     * @return \Closure
     */
    private static function negate($callback)
    {
        return function ($object) use ($callback) {
            return !$callback($object);
        };
    }

    /**
     * @param string $regex
     * @param string $subject
     *
     * @return string[]|false
     */
    private static function getMatches($regex, $subject)
    {
        $matches = array();
        if (preg_match($regex, $subject, $matches) !== 1) {
            return false;
        }

        return $matches;
    }

    /**
     * @param FilterInterface $filter
     */
    public static function addFilter(FilterInterface $filter)
    {
        $name = strtolower($filter->getName());

        self::$filters[$name] = $filter->getFilter();
    }

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return callable
     */
    public static function __callStatic($name, array $arguments)
    {
        if (($matches = self::getMatches('/(.+)Filter/i', $name)) === false) {
            throw new \RuntimeException(sprintf('Unable to find filter `%s`', $name));
        }

        $filter = strtolower($matches[1]);
        self::assertFilterExists($filter);

        return call_user_func_array(self::$filters[$filter], $arguments);
    }
}
