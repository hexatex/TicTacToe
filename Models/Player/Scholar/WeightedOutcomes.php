<?php

class WeightedOutcomes extends Collection
{
    public function offsetGet($offset): Outcome
    {

    }

    /**
     * @param mixed $offset
     * @param Outcome $outcome
     */
    public function offsetSet($offset, $outcome)
    {
        parent::offsetSet($outcome->getBoardHash(), $outcome);
    }
}
