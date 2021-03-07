<?php

class Outcome extends Model
{
    protected $boardHash;

    public function hashBoard(int $turn, Board $board, Mark $nextMark): void
    {
        $this->boardHash = $turn;

        $rows = $board->getMarks();
        $rows[$nextMark->getSquare()->getRow()][$nextMark->getSquare()->getColumn()] = $nextMark;

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
}
