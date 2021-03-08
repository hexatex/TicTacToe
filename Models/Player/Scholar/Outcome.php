<?php

class Outcome extends Model
{
    /** @var int */
    protected $turn;

    /** @var Board */
    protected $board;

    /** @var Mark */
    protected $mark;

    /** @var string */
    protected $boardHash = '';

    /** @var WeightedOutcomes */
    protected $nextOutcomes;

    public function __construct(int $turn, Board $board, Mark $mark)
    {
        parent::__construct();

        $this->turn = $turn;
        $this->board = $board;
        $this->mark = $mark;
        $this->hashBoard();
        $this->generateNextOutcomes();
    }

    public function hashBoard(): void
    {
        $this->boardHash = $this->turn;

        $rows = $this->board->getMarks();
        $rows[$this->mark->getSquare()->getRow()][$this->mark->getSquare()->getColumn()] = $this->mark;

        ksort($rows);
        foreach ($rows as &$row) {
            ksort($row);
        }

        foreach ($rows as $row) {
            /** @var Mark $mark */
            foreach ($row as $mark) {
                $this->boardHash .= $mark->getSymbol() . $mark->getSquare()->getRow() . $mark->getSquare()->getColumn();
            }
        }
    }

    public function getBoardHash(): string
    {
        return $this->boardHash;
    }

    public function getNextMark(): Mark
    {
        return $this->mark;
    }

    /*
     * Private
     */
    private function generateNextOutcomes(): void
    {
        $this->nextOutcomes = new WeightedOutcomes;

        $availableSquares = $this->board->getAvailableSquares();
    }
}
