<?php

class WackyInflatableTubeMan implements Player
{
    use IsPlayer;

    public function getNextMark(): Mark
    {
        // Todo Add weights to the squares and select a weighted random random
        // Different weight sets for each turn
        // try different weight sets at each turn, each time a weight set series wins, add weights to each turn collection
        // select weight set by turn and weighted random
        $square = Arr::randomElement($this->board->getAvailableSquares());

        return new Mark($this->symbol, $square);
    }

    public function learn(float $points): void // Maybe 1 === 3 in a row, 0.5 if blocking opponent row?
    {
        // Adjust weights (maybe only once at the end of the game) of squares array based on previous outcomes

        // Or maybe I should remove the $point param and have each player calculate their own points?
    }
}
