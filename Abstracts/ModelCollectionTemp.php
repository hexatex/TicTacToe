<?php

abstract class ModelCollection implements ArrayAccess, Countable, Iterator
{
    /** @var Model[] */
    protected $associativeArray = [];

    /** @var Model[] */
    protected $indexedArray = [];

    /** @var int[] */
    protected $assocToIndexed = [];

    /** @var int[] */
    protected $indices = [];

    /** @var int */
    protected $currentIndex = 0;

    /*
     * Countable
     */
    public function count()
    {
        return count($this->indexedArray);
    }

    /*
     * ArrayAccess
     */
    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->collectionByOffsetType($offset));
    }

    public function offsetGet($offset)
    {
        return $this->collectionByOffsetType($offset)[$offset];
    }

    /**
     * @param mixed $offset
     * @param Model $model
     */
    public function offsetSet($offset, $model)
    {
        $arrayType = $this->arrayType($offset);

        $index = $this->currentIndex;
        if ($arrayType === ArrayTypes::indexed) {
            $index = $offset;

            if ($offset >= $this->currentIndex) {
                $this->currentIndex++;
            }
        } else {
            $this->currentIndex++;
        }

        $this->indices[$index] = $index;
        $this->indexedArray[$index] = $model;
        $this->associativeArray[$model->getCode()] = $model;
        $this->assocToIndexed[$model->getCode()] = $index;
    }

    public function offsetUnset($offset)
    {
        $arrayType = $this->arrayType($offset);
        if ($arrayType === ArrayTypes::indexed) {
            $model = $this->indexedArray[$offset];
            unset($this->associativeArray[$model->getCode()]);
            unset($this->indexedArray[$offset]);
        } else {
            $index = $this->assocToIndexed[$offset];
            unset($this->associativeArray[$offset]);
            unset($this->associativeArray[$index]);
        }
    }

    /*
     * Iterator
     */
    public function current()
    {

    }

    public function next()
    {

    }

    public function key()
    {

    }

    public function valid()
    {

    }

    public function rewind()
    {

    }

    /*
     * Private
     */
    private function arrayType($offset)
    {
        if (is_integer($offset)) {
            return ArrayTypes::indexed;
        }

        return ArrayTypes::associative;
    }

    private function &collectionByOffsetType($offset): array
    {
        if (is_integer($offset)) {
            return $this->indexedArray;
        }

        return $this->associativeArray;
    }
}
