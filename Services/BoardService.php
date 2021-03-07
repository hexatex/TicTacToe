<?php

class BoardService
{
    /** @var SquareService */
    private $squareService;

    public function __construct()
    {
        $this->squareService = new SquareService;
    }

    public function get(Player $playerA, Player $playerB): Board
    {
        $board = new Board;
        $board->setPlayers($playerA, $playerB);

        foreach ($this->squareService->index() as $square) {
            $board->addAvailableSquare($square);
        }

        return $board;
    }
}
