<?php

trait IsPlayer
{
    /** @var Board */
    protected $board;

    /** @var Symbols|string */
    protected $symbol;

    public function setBoard(Board $board): void
    {
        $this->board = $board;
    }

    public function setSymbol(string $symbol): void
    {
        $this->symbol = $symbol;
    }

    public function getNextMark(): Mark
    {
        $square = Arr::randomElement($this->board->getAvailableSquares());

        return new Mark($this->symbol, $square);
    }
}
