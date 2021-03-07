<?php

class Board
{
    /** @var Square[] */
    protected $availableSquares = [];

    /** @var Mark[] */
    protected $marks = [];

    /** @var bool */
    protected $isOver = false;

    protected $isDraw = false;

    /** @var Symbols|string */
    protected $winningSymbol;

    public function addAvailableSquare(Square $square): void
    {
        $this->availableSquares[] = $square;
    }

    /**
     * @return Square[]
     */
    public function getAvailableSquares(): array
    {
        return $this->availableSquares;
    }

    public function addMark(Mark $mark): void
    {
        $this->marks[$mark->getSquare()->getRow()][$mark->getSquare()->getColumn()] = $mark;

        $isDraw = true;
        foreach ($this->getLines() as $line) {
            if ($line->isWinningLine()) {
                $this->winningSymbol = $line->getMarkA()->getSymbol();
                $this->isOver = true;
            }

            if (!$line->isDraw()) {
                $isDraw = false;
            }
        }

        $this->isDraw = $isDraw;

        if ($this->isDraw) {
            $this->isOver = true;
        }
    }

    /**
     * @param Rows|int $row
     * @param Columns|int $column
     * @return Mark|null
     */
    public function getMark(int $row, int $column): ?Mark
    {
        return $this->marks[$row][$column] ?? null;
    }

    public function isOver(): bool
    {
        return $this->isOver;
    }

    public function isDraw(): bool
    {
        return $this->isDraw;
    }

    public function getSymbol(int $row, int $column): string
    {
        $mark = $this->getMark($row, $column);

        return $mark ? $mark->getSymbol() : ' ';
    }

    public function getWinningSymbol(): ?string
    {
        return $this->winningSymbol;
    }

    /*
     * Private
     */
    /**
     * @return Line[]
     */
    private function getLines(): array
    {
        return [
            new Line( // 1, 1 Horizontal
                $this->getMark(Rows::one, Columns::one),
                $this->getMark(Rows::one, Columns::two),
                $this->getMark(Rows::one, Columns::three)
            ),
            new Line( // 1, 1 Diagonal
                $this->getMark(Rows::one, Columns::one),
                $this->getMark(Rows::two, Columns::two),
                $this->getMark(Rows::three, Columns::three)
            ),
            new Line( // 1, 1 Vertical
                $this->getMark(Rows::one, Columns::one),
                $this->getMark(Rows::two, Columns::one),
                $this->getMark(Rows::three, Columns::one)
            ),
            new Line( // 2, 1 Horizontal
                $this->getMark(Rows::two, Columns::one),
                $this->getMark(Rows::two, Columns::two),
                $this->getMark(Rows::two, Columns::three)
            ),
            new Line( // 3, 1 Diagonal
                $this->getMark(Rows::three, Columns::one),
                $this->getMark(Rows::two, Columns::two),
                $this->getMark(Rows::one, Columns::three)
            ),
            new Line( // 3, 1 Horizontal
                $this->getMark(Rows::three, Columns::one),
                $this->getMark(Rows::three, Columns::two),
                $this->getMark(Rows::three, Columns::three)
            ),
            new Line( // 1, 2 Vertical
                $this->getMark(Rows::one, Columns::two),
                $this->getMark(Rows::two, Columns::two),
                $this->getMark(Rows::three, Columns::two)
            ),
            new Line( // 1, 3 Vertical
                $this->getMark(Rows::one, Columns::three),
                $this->getMark(Rows::two, Columns::three),
                $this->getMark(Rows::three, Columns::three)
            ),
        ];
    }
}
