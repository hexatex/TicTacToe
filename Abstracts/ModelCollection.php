<?php

abstract class ModelCollection implements ArrayAccess, Countable, Iterator
{
    /** @var Model[]|ArrayObject */
    public $models;

    /** @var ArrayIterator */
    protected $iterator;

    public function __construct(array $models = [])
    {
        $this->models = new ArrayObject($models);
        $this->iterator = $this->models->getIterator();
    }

    public function isEmpty(): bool
    {
        return !!$this->current();
    }

    /*
     * Countable
     */
    public function count()
    {
        return count($this->models);
    }

    /*
     * ArrayAccess
     */
    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->models);
    }

    public function offsetGet($offset)
    {
        return $this->models[$offset];
    }

    /**
     * @param mixed $offset
     * @param Model $model
     */
    public function offsetSet($offset, $model)
    {
        $this->models[$model->getCode()] = $model;
    }

    public function offsetUnset($offset)
    {
        unset($this->models[$offset]);
    }

    /*
     * Iterator
     */
    public function current()
    {
        return $this->models->getIterator()->current();
    }

    public function next()
    {
        return $this->models->getIterator()->next();
    }

    public function key()
    {
        return $this->models->getIterator()->key();
    }

    public function valid()
    {
        return $this->models->getIterator()->valid();
    }

    public function rewind()
    {
        return $this->models->getIterator()->rewind();
    }
}
