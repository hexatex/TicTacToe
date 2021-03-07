<?php

class BoardService
{
    /** @var SquareService */
    private $squareService;

    public function __construct()
    {
        $this->squareService = new SquareService;
    }

    public function get(): Board
    {
        $board = new Board;

        foreach ($this->squareService->index() as $square) {
            $board->addAvailableSquare($square);
        }

        return $board;
    }
}
