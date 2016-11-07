<?php

namespace test\carlosV2\Funnel;

class TestObject
{
    /**
     * @var mixed
     */
    public $publicProperty;

    /**
     * @var mixed
     */
    protected $protectedProperty;

    /**
     * @var mixed
     */
    private $privateProperty;

    /**
     * @param mixed $publicProperty
     * @param mixed $protectedProperty
     * @param mixed $privateProperty
     */
    public function __construct($publicProperty, $protectedProperty, $privateProperty)
    {
        $this->publicProperty = $publicProperty;
        $this->protectedProperty = $protectedProperty;
        $this->privateProperty = $privateProperty;
    }

    /**
     * @return mixed
     */
    public function getPublicProperty()
    {
        return $this->publicProperty;
    }

    /**
     * @return mixed
     */
    public function getProtectedProperty()
    {
        return $this->protectedProperty;
    }

    /**
     * @return mixed
     */
    public function getPrivateProperty()
    {
        return $this->privateProperty;
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    public function isPublicProperty($value)
    {
        return $this->publicProperty === $value;
    }

    /**
     * @return bool
     */
    public function isPublicPropertyPublic()
    {
        return $this->isPublicProperty('public');
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    public function hasPublicProperty($value)
    {
        return $this->publicProperty === $value;
    }

    /**
     * @return bool
     */
    public function hasPublicPropertyPublic()
    {
        return $this->hasPublicProperty('public');
    }
}
